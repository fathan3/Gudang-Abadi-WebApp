<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Penyesuaian Stok Gudang</h2>
        <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Catat penambahan tabung baru, pengurangan/kerusakan, atau koreksi stok manual</p>
    </div>
    <div>
        <a href="<?= BASE_URL ?>gudang" class="btn-secondary">Kembali</a>
    </div>
</div>

<?php if (isset($error)): ?>
    <div class="flex items-center justify-between p-4 mb-8 rounded-xl badge-danger animate-[slideDown_0.4s_ease-out]">
        <div class="flex items-center gap-3">
            <i class="ph-fill ph-warning-circle text-xl"></i>
            <p class="font-medium"><?= htmlspecialchars($error) ?></p>
        </div>
        <button class="hover:opacity-75 transition-opacity alert-close-btn">&times;</button>
    </div>
<?php endif; ?>

<div class="glass-panel p-6 rounded-2xl shadow-sm max-w-4xl">
    <form action="<?= BASE_URL ?>gudang/adjust" method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-group">
                <label class="form-label block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2" for="tanggal">Tanggal Penyesuaian</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            
            <div class="form-group">
                <label class="form-label block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2" for="barang_id">Jenis Tabung Gas</label>
                <select id="barang_id" name="barang_id" class="form-control choices-select" required>
                    <option value="" disabled selected>-- Pilih Jenis Tabung --</option>
                    <?php foreach ($barangList as $b): ?>
                        <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['nama_barang']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="form-group">
                <label class="form-label block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2" for="tipe_transaksi">Tipe Penyesuaian</label>
                <select id="tipe_transaksi" name="tipe_transaksi" class="form-control" required>
                    <option value="beli_baru">Pembelian / Tambah Tabung Baru (+)</option>
                    <option value="jual_rusak">Penjualan / Pemusnahan / Rusak (-)</option>
                    <option value="koreksi">Koreksi Manual (+ / -)</option>
                </select>
                <span class="form-help block text-xs text-slate-500 mt-2">Pilih sifat dari penyesuaian stok ini.</span>
            </div>
            
            <div class="form-group">
                <label class="form-label block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2" for="jumlah">Jumlah (Tabung)</label>
                <input type="number" id="jumlah" name="jumlah" class="form-control" value="1" required>
                <span class="form-help block text-xs text-slate-500 mt-2">Masukkan nilai positif (atau negatif khusus untuk koreksi minus).</span>
            </div>
        </div>

        <div class="form-group mt-6">
            <label class="form-label block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2" for="keterangan">Keterangan / Catatan Tambahan</label>
            <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Contoh: Beli 10 tabung baru dari Supplier X, atau Afkir 2 tabung rusak">
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <a href="<?= BASE_URL ?>gudang" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary" <?= empty($barangList) ? 'disabled' : '' ?>>Simpan Penyesuaian</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
