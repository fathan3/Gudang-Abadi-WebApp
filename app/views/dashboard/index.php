<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Dashboard Ringkasan</h2>
        <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Pantau status stok gudang, pinjaman tabung relasi, dan alert repurchasing</p>
    </div>
    <div>
        <a href="index.php?controller=pengiriman&action=create" class="btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Catat Pengiriman
        </a>
    </div>
</div>

<!-- Alert Banner if Inactivity warnings exist -->
<?php if ($activeAlertCount > 0): ?>
    <div class="flex items-center justify-between p-4 mb-8 rounded-xl badge-danger animate-[slideDown_0.4s_ease-out]">
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <p class="font-medium"><strong>Perhatian:</strong> Ada <?= $activeAlertCount ?> mitra/relasi yang sudah lebih dari 30 hari tidak melakukan transaksi atau pengisian ulang tabung!</p>
        </div>
        <a href="index.php?controller=evaluasi&action=index" class="btn-sm bg-white dark:bg-gray-800 border border-danger/30 text-danger hover:bg-danger-bg transition-colors font-bold">Evaluasi Sekarang</a>
    </div>
<?php endif; ?>

<!-- Metrics Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="glass-panel p-6 rounded-2xl flex justify-between items-center relative overflow-hidden group hover:-translate-y-1 transition-all shadow-sm before:absolute before:top-0 before:left-0 before:w-full before:h-1 before:bg-gradient-to-r before:from-primary before:to-success">
        <div>
            <h3 class="text-xs uppercase font-bold text-slate-500 tracking-wider mb-2">Mitra Relasi</h3>
            <div class="text-3xl font-extrabold text-slate-800 dark:text-gray-100"><?= $totalClients ?></div>
        </div>
        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.005 9.005 0 00-6-6.197V8.5a3.5 3.5 0 117 0v4.023a9.005 9.005 0 00-1 6.197zm-6-6.197a9.005 9.005 0 00-6 6.197V12.523A9.003 9.003 0 0012 8.5v4.023zm-6 6.197a9.003 9.003 0 001 6.197V18.72zm6 0v2.28c0 .248-.202.45-.45.45H10.45a.45.45 0 01-.45-.45v-2.28m6 0v2.28c0 .248-.202.45-.45.45h-1.1c-.248 0-.45-.202-.45-.45v-2.28M6 18.72v2.28c0 .248.202.45.45.45h1.1a.45.45 0 00.45-.45v-2.28" />
            </svg>
        </div>
    </div>
    
    <div class="glass-panel p-6 rounded-2xl flex justify-between items-center relative overflow-hidden group hover:-translate-y-1 transition-all shadow-sm before:absolute before:top-0 before:left-0 before:w-full before:h-1 before:bg-gradient-to-r before:from-primary before:to-success">
        <div>
            <h3 class="text-xs uppercase font-bold text-slate-500 tracking-wider mb-2">Jenis Tabung</h3>
            <div class="text-3xl font-extrabold text-slate-800 dark:text-gray-100"><?= $totalCylinderTypes ?></div>
        </div>
        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.283 8.283 0 013 6.3 8.284 8.284 0 003-6.3 8.287 8.287 0 002.962-2.386z" />
            </svg>
        </div>
    </div>
    
    <div class="glass-panel p-6 rounded-2xl flex justify-between items-center relative overflow-hidden group hover:-translate-y-1 transition-all shadow-sm before:absolute before:top-0 before:left-0 before:w-full before:h-1 before:bg-danger">
        <div>
            <h3 class="text-xs uppercase font-bold text-slate-500 tracking-wider mb-2">Alert Inaktif</h3>
            <div class="text-3xl font-extrabold text-danger"><?= $activeAlertCount ?></div>
        </div>
        <div class="w-12 h-12 rounded-xl bg-danger-bg text-danger flex items-center justify-center animate-[pulse_2s_infinite]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>
    </div>

    <div class="glass-panel p-6 rounded-2xl flex justify-between items-center relative overflow-hidden group hover:-translate-y-1 transition-all shadow-sm before:absolute before:top-0 before:left-0 before:w-full before:h-1 before:bg-success">
        <div>
            <h3 class="text-xs uppercase font-bold text-slate-500 tracking-wider mb-2">Total Ready</h3>
            <div class="text-3xl font-extrabold text-success">
                <?php 
                $sumReady = 0;
                foreach ($warehouseStocks as $w) $sumReady += $w['stok_ready'];
                echo $sumReady;
                ?>
            </div>
        </div>
        <div class="w-12 h-12 rounded-xl bg-success-bg text-success flex items-center justify-center group-hover:scale-110 transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>
</div>

<!-- Charts & Stock Status -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Stock Gudang Chart Card -->
    <div class="lg:col-span-2 glass-panel p-6 rounded-2xl shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold">Ketersediaan Tabung Gudang</h3>
        </div>
        <div class="relative h-[300px] w-full">
            <canvas id="warehouseChart"></canvas>
        </div>
    </div>
    
    <!-- Mini Stock Summary List -->
    <div class="lg:col-span-1 glass-panel p-6 rounded-2xl shadow-sm flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold">Detail Gudang</h3>
            </div>
            <div class="overflow-x-auto border border-slate-200 dark:border-gray-700 rounded-xl">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50/50 dark:bg-gray-800/50 text-slate-500">
                        <tr>
                            <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Jenis</th>
                            <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Ready</th>
                            <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Kosong</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($warehouseStocks as $w): ?>
                            <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5">
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 font-bold text-slate-800 dark:text-gray-200"><?= htmlspecialchars($w['nama_barang']) ?></td>
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-success font-bold"><?= $w['stok_ready'] ?></td>
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-warning font-bold"><?= $w['stok_kosong'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="index.php?controller=gudang&action=index" class="btn-secondary w-full justify-center mt-4">Kelola Gudang</a>
    </div>
</div>

<!-- Recent Deliveries Section -->
<div class="glass-panel p-6 rounded-2xl shadow-sm">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold">Pengiriman Terbaru</h3>
        <a href="index.php?controller=pengiriman&action=index" class="btn-secondary btn-sm">Lihat Semua</a>
    </div>
    
    <div class="overflow-x-auto border border-slate-200 dark:border-gray-700 rounded-xl">
        <table class="w-full text-sm text-left whitespace-nowrap">
            <thead class="bg-slate-50/50 dark:bg-gray-800/50 text-slate-500">
                <tr>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Tanggal</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Relasi</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Jenis Tabung</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Dikirim (Isi)</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Kembali (Kosong)</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($recentDeliveries)): ?>
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-slate-500">Belum ada riwayat pengiriman.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($recentDeliveries as $d): ?>
                        <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5">
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200"><?= date('d-m-Y', strtotime($d['tanggal'])) ?></td>
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200">
                                <strong>[<?= htmlspecialchars($d['kode_relasi']) ?>]</strong> 
                                <?= htmlspecialchars($d['nama_relasi']) ?>
                            </td>
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200"><?= htmlspecialchars($d['nama_barang']) ?></td>
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

<!-- Load Chart.js for premium graphics -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('warehouseChart').getContext('2d');
    
    // PHP variables mapped to JSON
    const labels = <?= json_encode(array_column($warehouseStocks, 'nama_barang')) ?>;
    const readyData = <?= json_encode(array_map('intval', array_column($warehouseStocks, 'stok_ready'))) ?>;
    const emptyData = <?= json_encode(array_map('intval', array_column($warehouseStocks, 'stok_kosong'))) ?>;
    
    // Style settings for dark/light mode integration
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#f3f4f6' : '#1f2937';
    const gridColor = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.05)';

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Ready / Full',
                    data: readyData,
                    backgroundColor: 'rgba(13, 148, 136, 0.7)',
                    borderColor: 'rgb(13, 148, 136)',
                    borderWidth: 1,
                    borderRadius: 8
                },
                {
                    label: 'Kosong (Refill Queue)',
                    data: emptyData,
                    backgroundColor: 'rgba(245, 158, 11, 0.7)',
                    borderColor: 'rgb(245, 158, 11)',
                    borderWidth: 1,
                    borderRadius: 8
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: textColor,
                        font: {
                            family: 'Outfit'
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: gridColor
                    },
                    ticks: {
                        color: textColor,
                        font: {
                            family: 'Outfit'
                        }
                    }
                },
                y: {
                    grid: {
                        color: gridColor
                    },
                    ticks: {
                        color: textColor,
                        font: {
                            family: 'Outfit'
                        }
                    },
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
