<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Profil Mitra &amp; Detail Saldo</h2>
        <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Lihat detail inventaris tabung, riwayat pengiriman, dan log tindakan evaluasi</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="index.php?controller=relasi&action=index" class="btn-secondary">Kembali</a>
        <a href="index.php?controller=relasi&action=edit&id=<?= $relasi['id'] ?>" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.83 20.013a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            Edit Profil
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Profile Card & Summary -->
    <div class="lg:col-span-1 space-y-6">
        <div class="glass-panel rounded-2xl shadow-sm overflow-hidden">
            <div class="w-24 h-24 mx-auto mt-8 mb-4 bg-gradient-to-br from-primary to-cyan-500 rounded-full flex items-center justify-center text-4xl font-black text-white shadow-xl shadow-primary/30">
                <?= strtoupper(substr($relasi['nama_relasi'], 0, 1)) ?>
            </div>
            
            <div class="text-center p-6 border-b border-slate-200 dark:border-gray-700">
                <h3 class="text-xl font-bold text-slate-800 dark:text-gray-100"><?= htmlspecialchars($relasi['nama_relasi']) ?></h3>
                <div class="mt-2"><span class="badge badge-info">Kode: <?= htmlspecialchars($relasi['kode_relasi']) ?></span></div>
                <p class="text-sm text-slate-500 dark:text-gray-400 mt-3 flex items-center justify-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25gA7.5 7.5 0 1119.5 10.5z" /></svg> 
                    <?= htmlspecialchars($relasi['lokasi'] ?: 'Tidak ada alamat') ?>
                </p>
            </div>
            
            <div class="p-6 space-y-4 text-sm">
                <div class="flex justify-between items-center py-2 border-b border-slate-100 dark:border-gray-700/50">
                    <span class="text-slate-500 dark:text-gray-400">Pengiriman Terakhir:</span>
                    <span class="font-bold text-slate-800 dark:text-gray-200"><?= $last_delivery['tanggal_terakhir'] ? date('d-m-Y', strtotime($last_delivery['tanggal_terakhir'])) : '<span class="text-slate-400 font-normal">Belum pernah</span>' ?></span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-100 dark:border-gray-700/50">
                    <span class="text-slate-500 dark:text-gray-400">Waktu Sejak Pengiriman:</span>
                    <span>
                        <?php if ($last_delivery['hari_sejak_pengiriman'] === null): ?>
                            <span class="badge badge-warning">Baru / Inaktif</span>
                        <?php else: ?>
                            <strong class="text-slate-800 dark:text-gray-200"><?= $last_delivery['hari_sejak_pengiriman'] ?> Hari</strong>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="text-slate-500 dark:text-gray-400">Status Alert:</span>
                    <span>
                        <?php if ($last_delivery['hari_sejak_pengiriman'] === null || $last_delivery['hari_sejak_pengiriman'] > 30): ?>
                            <span class="badge badge-danger animate-[pulse_2s_infinite]">Peringatan Inaktif (>30 Hari)</span>
                        <?php else: ?>
                            <span class="badge badge-success">Mitra Aktif</span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Evaluation Action Box -->
        <?php if ($last_delivery['hari_sejak_pengiriman'] === null || $last_delivery['hari_sejak_pengiriman'] > 30): ?>
            <div class="glass-panel p-6 rounded-2xl shadow-sm border border-danger/20 bg-danger/5 dark:bg-danger/10">
                <h4 class="font-bold text-danger flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
                    Evaluasi Repurchase
                </h4>
                <p class="text-xs text-danger/80 mb-4">
                    Klien sudah tidak memesan selama lebih dari 1 bulan. Catat status negosiasi atau keputusan lanjut/putus di sini.
                </p>
                <form action="index.php?controller=evaluasi&action=create" method="POST" class="space-y-4">
                    <input type="hidden" name="relasi_id" value="<?= $relasi['id'] ?>">
                    <input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>">
                    
                    <div>
                        <label class="block text-xs font-semibold text-danger/90 mb-1" for="status_lanjut">Status Keputusan</label>
                        <select name="status_lanjut" id="status_lanjut" class="form-control bg-white/50 border-danger/30 text-sm" required>
                            <option value="lanjut">Lanjut (Mau Refill/Pesan Lagi)</option>
                            <option value="putus">Putus (Tarik Kembali Semua Tabung)</option>
                            <option value="negosiasi">Sedang Dihubungi / Negosiasi</option>
                            <option value="tidak_ada_respon">Tidak Ada Respon / Macet</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-semibold text-danger/90 mb-1" for="catatan">Catatan Tindakan</label>
                        <textarea name="catatan" id="catatan" rows="3" class="form-control bg-white/50 border-danger/30 text-sm" placeholder="Tulis hasil hubungi client..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-sm bg-danger text-white w-full justify-center hover:bg-red-600">Simpan Evaluasi</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Right Column: Audit Stock & Logs -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Cylinder Audit Breakdown Card -->
        <div class="glass-panel p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold">Audit Saldo Tabung</h3>
            </div>
            <div class="overflow-x-auto border border-slate-200 dark:border-gray-700 rounded-xl">
                <table class="w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-slate-50/50 dark:bg-gray-800/50 text-slate-500">
                        <tr>
                            <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Jenis Tabung</th>
                            <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700 text-center">Stok Awal</th>
                            <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700 text-center">Kirim (Isi)</th>
                            <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700 text-center">Kembali (Kosong)</th>
                            <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700 text-center bg-indigo-50/50 dark:bg-indigo-900/10">Stok Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barangList as $b): ?>
                            <?php 
                            $init = isset($stokAwal[$b['id']]) ? $stokAwal[$b['id']] : 0;
                            $masuk = isset($sums[$b['id']]) ? $sums[$b['id']]['masuk'] : 0;
                            $keluar = isset($sums[$b['id']]) ? $sums[$b['id']]['keluar'] : 0;
                            $akhir = $init + $masuk - $keluar;
                            ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 font-bold text-slate-800 dark:text-gray-200"><?= htmlspecialchars($b['nama_barang']) ?></td>
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-center text-slate-500 dark:text-gray-400"><?= $init ?></td>
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-center text-success font-medium">+<?= $masuk ?></td>
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-center text-warning font-medium">-<?= $keluar ?></td>
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-center font-bold text-base bg-indigo-50/30 dark:bg-indigo-900/5">
                                    <?php if ($akhir > 0): ?>
                                        <span class="text-warning"><?= $akhir ?></span>
                                    <?php elseif ($akhir < 0): ?>
                                        <span class="text-danger"><?= $akhir ?></span>
                                    <?php else: ?>
                                        <span class="text-slate-300 dark:text-slate-600">0</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab Panel: Transactions & Evaluations -->
        <div class="glass-panel rounded-2xl shadow-sm mb-8">
            <div class="flex border-b border-slate-200 dark:border-gray-700 overflow-x-auto no-scrollbar pt-2 px-6">
                <button class="px-6 py-4 font-semibold text-sm whitespace-nowrap border-b-2 transition-colors tab-btn text-primary border-primary dark:text-primary" data-tab="tab-deliveries">Riwayat Pengiriman</button>
                <button class="px-6 py-4 font-semibold text-sm whitespace-nowrap border-b-2 transition-colors tab-btn text-slate-500 border-transparent hover:text-slate-700" data-tab="tab-evaluations">Riwayat Evaluasi</button>
            </div>
            
            <!-- Deliveries Tab -->
            <div class="tab-content p-6 block" id="tab-deliveries">
                <div class="overflow-x-auto border border-slate-200 dark:border-gray-700 rounded-xl">
                    <table class="w-full text-sm text-left whitespace-nowrap">
                        <thead class="bg-slate-50/50 dark:bg-gray-800/50 text-slate-500">
                            <tr>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Tanggal</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Barang</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Kirim (Isi)</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Kembali (Kosong)</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($deliveries)): ?>
                                <tr>
                                    <td colspan="5" class="px-5 py-8 text-center text-slate-500">Belum ada riwayat pengiriman untuk mitra ini.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($deliveries as $d): ?>
                                    <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5 transition-colors">
                                        <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200"><?= date('d-m-Y', strtotime($d['tanggal'])) ?></td>
                                        <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 font-bold text-slate-800 dark:text-gray-200"><?= htmlspecialchars($d['nama_barang']) ?></td>
                                        <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-success font-bold">+<?= $d['jumlah_masuk'] ?></td>
                                        <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-warning font-bold">-<?= $d['jumlah_keluar'] ?></td>
                                        <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200"><?= htmlspecialchars($d['keterangan'] ?: '-') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Evaluations Tab -->
            <div class="tab-content p-6 hidden" id="tab-evaluations">
                <div class="overflow-x-auto border border-slate-200 dark:border-gray-700 rounded-xl">
                    <table class="w-full text-sm text-left whitespace-nowrap">
                        <thead class="bg-slate-50/50 dark:bg-gray-800/50 text-slate-500">
                            <tr>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Tanggal Tindakan</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Status Keputusan</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Catatan Hasil Hubungi Klien</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($evalHistory)): ?>
                                <tr>
                                    <td colspan="3" class="px-5 py-8 text-center text-slate-500">Belum ada riwayat tindakan evaluasi.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($evalHistory as $ev): ?>
                                    <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5 transition-colors">
                                        <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200"><?= date('d-m-Y', strtotime($ev['tanggal'])) ?></td>
                                        <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700">
                                            <?php if ($ev['status_lanjut'] === 'lanjut'): ?>
                                                <span class="badge badge-success">Lanjut</span>
                                            <?php elseif ($ev['status_lanjut'] === 'putus'): ?>
                                                <span class="badge badge-danger">Putus</span>
                                            <?php elseif ($ev['status_lanjut'] === 'negosiasi'): ?>
                                                <span class="badge badge-warning">Negosiasi</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Tidak Respon</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200"><?= htmlspecialchars($ev['catatan'] ?: '-') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
