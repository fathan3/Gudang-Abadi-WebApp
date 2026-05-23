<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Evaluasi &amp; Alert Repurchasing</h2>
        <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Monitor relasi yang sudah lebih dari 30 hari tidak ada pergerakan transaksi</p>
    </div>
    <div>
        <a href="index.php?controller=relasi&action=index" class="btn-secondary">Semua Relasi</a>
    </div>
</div>

<?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] === 'success_eval'): ?>
        <div class="flex items-center justify-between p-4 mb-8 rounded-xl badge-success animate-[slideDown_0.4s_ease-out]">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="font-medium">Log tindakan evaluasi berhasil disimpan!</p>
            </div>
            <button class="hover:opacity-75 transition-opacity alert-close-btn">&times;</button>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="glass-panel p-6 rounded-2xl shadow-sm">
    <div class="flex justify-between items-center mb-6">
        <h3 class="flex items-center gap-2 text-lg font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-danger"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            Daftar Mitra Inaktif (Butuh Tindakan)
        </h3>
    </div>

    <div class="overflow-x-auto border border-slate-200 dark:border-gray-700 rounded-xl">
        <table class="w-full text-sm text-left whitespace-nowrap">
            <thead class="bg-slate-50/50 dark:bg-gray-800/50 text-slate-500">
                <tr>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Kode Relasi</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Nama Relasi / Mitra</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Lokasi</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Tgl Pengiriman Terakhir</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Inaktif Selama</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700 text-center">Tindakan Evaluasi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($inactiveClients)): ?>
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-4 opacity-50">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Hebat! Semua mitra aktif bertransaksi dalam 30 hari terakhir.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($inactiveClients as $c): ?>
                        <tr class="bg-red-50/50 dark:bg-red-900/10 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700"><span class="badge badge-info"><strong><?= htmlspecialchars($c['kode_relasi']) ?></strong></span></td>
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200 font-bold"><?= htmlspecialchars($c['nama_relasi']) ?></td>
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200"><?= htmlspecialchars($c['lokasi'] ?: '-') ?></td>
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200">
                                <?= $c['tanggal_terakhir'] ? date('d M Y', strtotime($c['tanggal_terakhir'])) : '<span class="text-slate-400">Belum pernah</span>' ?>
                            </td>
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700">
                                <?php if ($c['hari_sejak_pengiriman'] === null): ?>
                                    <strong class="text-danger">Belum ada transaksi</strong>
                                <?php else: ?>
                                    <strong class="text-danger"><?= $c['hari_sejak_pengiriman'] ?> Hari</strong>
                                <?php endif; ?>
                            </td>
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-center">
                                <a href="index.php?controller=relasi&action=detail&id=<?= $c['id'] ?>" class="btn-sm bg-danger text-white hover:bg-red-600 transition-colors inline-block no-underline">
                                    Catat Evaluasi Klien
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
