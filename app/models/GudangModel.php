<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/AuditLogModel.php';

class GudangModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getWarehouseStock() {
        $sql = "SELECT sg.*, b.nama_barang, b.deskripsi 
                FROM stok_gudang sg
                JOIN barang b ON sg.barang_id = b.id
                ORDER BY b.nama_barang ASC";
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll();
        foreach ($rows as &$r) {
            $r['stok'] = (int)($r['stok'] ?? ((int)$r['stok_ready'] + (int)$r['stok_kosong']));
            $r['stok_ready'] = $r['stok'];
            $r['stok_kosong'] = 0;
        }
        return $rows;
    }

    public function getWarehouseStockAtDate($date) {
        // 1. Get current stock
        $currentStocks = $this->getWarehouseStock();
        $stockMap = [];
        foreach ($currentStocks as $s) {
            $stockMap[$s['barang_id']] = [
                'barang_id' => $s['barang_id'],
                'nama_barang' => $s['nama_barang'],
                'deskripsi' => $s['deskripsi'],
                'stok' => (int)$s['stok'],
                'stok_ready' => (int)$s['stok'],
                'stok_kosong' => 0
            ];
        }

        // 2. Reverse 'pengiriman' that occurred AFTER the date
        // Kirim (masuk ke mitra) keluar dari gudang -> balikkan dengan menambah stok gudang
        // Kembali (keluar dari mitra) masuk ke gudang -> balikkan dengan mengurangi stok gudang
        $stmt_pengiriman = $this->db->prepare("SELECT barang_id, jumlah_masuk, jumlah_keluar FROM pengiriman WHERE tanggal > ?");
        $stmt_pengiriman->execute([$date]);
        $pengirimans = $stmt_pengiriman->fetchAll();

        foreach ($pengirimans as $p) {
            $b_id = $p['barang_id'];
            if (!isset($stockMap[$b_id])) continue;

            $stockMap[$b_id]['stok'] += (int)$p['jumlah_masuk'];
            $stockMap[$b_id]['stok'] -= (int)$p['jumlah_keluar'];
            $stockMap[$b_id]['stok_ready'] = $stockMap[$b_id]['stok'];
        }

        // 3. Reverse 'gudang_transaksi' that occurred AFTER the date
        $stmt_gt = $this->db->prepare("SELECT barang_id, tipe_transaksi, jumlah, keterangan FROM gudang_transaksi WHERE tanggal > ?");
        $stmt_gt->execute([$date]);
        $gts = $stmt_gt->fetchAll();

        foreach ($gts as $gt) {
            $b_id = $gt['barang_id'];
            if (!isset($stockMap[$b_id])) continue;

            $qty = (int)$gt['jumlah'];

            if ($gt['tipe_transaksi'] == 'beli_baru' || $gt['tipe_transaksi'] == 'pembelian') {
                $stockMap[$b_id]['stok'] -= $qty;
            } elseif ($gt['tipe_transaksi'] == 'jual_rusak' || $gt['tipe_transaksi'] == 'penjualan' || $gt['tipe_transaksi'] == 'rusak') {
                $stockMap[$b_id]['stok'] += $qty;
            } elseif ($gt['tipe_transaksi'] == 'koreksi') {
                $stockMap[$b_id]['stok'] -= $qty;
            }
            // 'refill' does not change total cylinders in warehouse
            $stockMap[$b_id]['stok_ready'] = $stockMap[$b_id]['stok'];
        }

        return array_values($stockMap);
    }

    public function getTransactions($limit = 100, $offset = 0) {
        $sql = "SELECT gt.*, b.nama_barang 
                FROM gudang_transaksi gt
                JOIN barang b ON gt.barang_id = b.id
                ORDER BY gt.tanggal DESC, gt.id DESC
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addAdjustment($tanggal, $barang_id, $tipe_transaksi, $jumlah, $keterangan = '') {
        try {
            $this->db->beginTransaction();
            
            $jumlah = (int)$jumlah;
            $delta = 0;

            if ($tipe_transaksi === 'beli_baru' || $tipe_transaksi === 'pembelian') {
                $delta = abs($jumlah);
            } elseif ($tipe_transaksi === 'jual_rusak' || $tipe_transaksi === 'penjualan' || $tipe_transaksi === 'rusak') {
                $delta = -abs($jumlah);
            } elseif ($tipe_transaksi === 'koreksi') {
                $delta = $jumlah;
            } else {
                $delta = $jumlah;
            }

            // Insert log into gudang_transaksi
            $stmt = $this->db->prepare(
                "INSERT INTO gudang_transaksi (tanggal, barang_id, tipe_transaksi, jumlah, keterangan) 
                 VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([$tanggal, $barang_id, $tipe_transaksi, $jumlah, $keterangan]);
            
            // Update stok_gudang
            $stmt_stock = $this->db->prepare("UPDATE stok_gudang SET stok = stok + ?, stok_ready = stok WHERE barang_id = ?");
            $stmt_stock->execute([$delta, $barang_id]);
            
            $this->db->commit();
            
            AuditLogModel::log('Penyesuaian Stok', "Tipe: {$tipe_transaksi}, Jumlah: {$jumlah}", $tanggal);
            
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function transferStock($tanggal, $barang_asal_id, $barang_tujuan_id, $jumlah, $keterangan) {
        try {
            $this->db->beginTransaction();
            
            $jumlah = (int)$jumlah;
            if ($jumlah <= 0) {
                throw new Exception("Jumlah transfer harus lebih dari 0.");
            }

            // Check stock availability on origin
            $stmt_check = $this->db->prepare("SELECT stok FROM stok_gudang WHERE barang_id = ?");
            $stmt_check->execute([$barang_asal_id]);
            $stok_asal = $stmt_check->fetch();
            
            if (!$stok_asal) {
                throw new Exception("Barang asal tidak ditemukan di gudang.");
            }
            
            if ((int)$stok_asal['stok'] < $jumlah) {
                throw new Exception("Stok barang asal (" . (int)$stok_asal['stok'] . ") tidak mencukupi untuk transfer sebanyak " . $jumlah . " tabung.");
            }

            // 1. Deduct from origin
            $stmt_kurang = $this->db->prepare("UPDATE stok_gudang SET stok = stok - ?, stok_ready = stok WHERE barang_id = ?");
            $stmt_kurang->execute([$jumlah, $barang_asal_id]);
            
            // 2. Add to destination
            $stmt_tambah = $this->db->prepare("UPDATE stok_gudang SET stok = stok + ?, stok_ready = stok WHERE barang_id = ?");
            $stmt_tambah->execute([$jumlah, $barang_tujuan_id]);
            
            // 3. Log transactions
            $stmt_log_out = $this->db->prepare(
                "INSERT INTO gudang_transaksi (tanggal, barang_id, tipe_transaksi, jumlah, keterangan) 
                 VALUES (?, ?, 'koreksi', ?, ?)"
            );
            $ket_out = "Transfer Keluar: " . $keterangan;
            $stmt_log_out->execute([$tanggal, $barang_asal_id, -$jumlah, $ket_out]);
            
            if ($barang_asal_id != $barang_tujuan_id) {
                $stmt_log_in = $this->db->prepare(
                    "INSERT INTO gudang_transaksi (tanggal, barang_id, tipe_transaksi, jumlah, keterangan) 
                     VALUES (?, ?, 'koreksi', ?, ?)"
                );
                $ket_in = "Transfer Masuk: " . $keterangan;
                $stmt_log_in->execute([$tanggal, $barang_tujuan_id, $jumlah, $ket_in]);
            }
            
            $this->db->commit();
            
            AuditLogModel::log('Transfer Stok', "Jumlah: {$jumlah}", $tanggal);
            
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getTransactionById($id) {
        $stmt = $this->db->prepare("SELECT * FROM gudang_transaksi WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function deleteTransaction($id) {
        try {
            $this->db->beginTransaction();
            
            $gt = $this->getTransactionById($id);
            if (!$gt) throw new Exception("Transaksi tidak ditemukan.");
            
            $qty = (int)$gt['jumlah'];
            $b_id = $gt['barang_id'];
            
            // Reverse stock
            if ($gt['tipe_transaksi'] == 'beli_baru' || $gt['tipe_transaksi'] == 'pembelian') {
                $stmt = $this->db->prepare("UPDATE stok_gudang SET stok = stok - ?, stok_ready = stok WHERE barang_id = ?");
                $stmt->execute([$qty, $b_id]);
            } elseif ($gt['tipe_transaksi'] == 'jual_rusak' || $gt['tipe_transaksi'] == 'penjualan' || $gt['tipe_transaksi'] == 'rusak') {
                $stmt = $this->db->prepare("UPDATE stok_gudang SET stok = stok + ?, stok_ready = stok WHERE barang_id = ?");
                $stmt->execute([abs($qty), $b_id]);
            } elseif ($gt['tipe_transaksi'] == 'koreksi') {
                $stmt = $this->db->prepare("UPDATE stok_gudang SET stok = stok - ?, stok_ready = stok WHERE barang_id = ?");
                $stmt->execute([$qty, $b_id]);
            }
            
            $stmt = $this->db->prepare("DELETE FROM gudang_transaksi WHERE id = ?");
            $stmt->execute([$id]);
            
            $this->db->commit();
            
            AuditLogModel::log('Hapus Transaksi Gudang', "Tipe: {$gt['tipe_transaksi']}, Jumlah: {$qty}", $gt['tanggal']);
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updateTransaction($id, $tanggal, $keterangan) {
        try {
            $this->db->beginTransaction();
            $gt = $this->getTransactionById($id);
            if (!$gt) throw new Exception("Transaksi tidak ditemukan.");
            
            $stmt = $this->db->prepare("UPDATE gudang_transaksi SET tanggal = ?, keterangan = ? WHERE id = ?");
            $stmt->execute([$tanggal, $keterangan, $id]);
            
            $this->db->commit();
            AuditLogModel::log('Edit Transaksi Gudang', "Tanggal/Keterangan diubah", $tanggal);
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
