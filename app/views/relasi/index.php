<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Mitra &amp; Relasi Pelanggan</h2>
        <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Monitor stok tabung yang dipinjam oleh masing-masing mitra di setiap lokasi</p>
    </div>
<?php
$exportParams = [];
if (!empty($_GET['search'])) $exportParams['search'] = $_GET['search'];
if (!empty($_GET['date'])) $exportParams['date'] = $_GET['date'];
$exportUrl = BASE_URL . 'relasi/export' . (!empty($exportParams) ? '?' . http_build_query($exportParams) : '');
?>
    <div class="flex items-center gap-3">
        <a href="<?= $exportUrl ?>" class="btn-secondary !text-success border border-success/20 hover:!bg-success/10" target="_blank">
            <i class="ph-bold ph-file-csv text-base"></i>
            Export Excel
        </a>
        <a href="<?= BASE_URL ?>relasi/create" class="btn-primary">
            <i class="ph-bold ph-plus text-base"></i>
            Tambah Mitra Baru
        </a>
    </div>
</div>

<!-- Stock Matrix Table Card -->
<div class="glass-panel p-6 rounded-2xl shadow-sm">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-gray-100">
                <?= !empty($_GET['date']) ? 'Stok Relasi per Tanggal: ' . date('d-m-Y', strtotime($_GET['date'])) : 'Matriks Saldo Tabung Relasi' ?>
            </h3>
            <div class="text-xs text-slate-500 dark:text-gray-400 italic mt-1">
                <?php if (!empty($_GET['date'])): ?>
                    <span class="text-warning font-semibold">*Mode Histori: Menampilkan proyeksi saldo stok mitra pada akhir hari tersebut.</span>
                <?php else: ?>
                    *Angka menunjukkan jumlah tabung yang dipinjam (MP) di lokasi relasi
                <?php endif; ?>
            </div>
        </div>
        <form method="GET" action="<?= BASE_URL ?>relasi" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 w-full lg:w-auto" id="searchForm">
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="ph-bold ph-magnifying-glass text-slate-400 dark:text-slate-500"></i>
                </div>
                <input type="text" name="search" id="searchMitra" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" class="w-full pl-10 py-2 text-sm bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-600 focus:border-primary dark:focus:border-primary focus:outline-none ring-0 ring-transparent focus:ring-4 focus:ring-primary/10 dark:focus:ring-primary/20 rounded-xl text-slate-800 dark:text-gray-100 placeholder-slate-400 dark:placeholder-gray-500 transition-colors duration-200 shadow-sm" placeholder="Cari nama mitra...">
            </div>
            <div class="flex items-center gap-2">
                <input type="date" name="date" value="<?= htmlspecialchars($_GET['date'] ?? '') ?>" class="form-control py-2 text-sm w-[150px]" title="Pilih Tanggal Stok">
                <button type="submit" class="btn-primary py-2 px-4 text-sm whitespace-nowrap">Cek Histori</button>
                <?php if (!empty($_GET['date']) || !empty($_GET['search'])): ?>
                    <a href="<?= BASE_URL ?>relasi" class="btn-secondary py-2 px-4 text-sm whitespace-nowrap">Reset</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <?php 
    $totals = [];
    $grandTotal = 0;
    foreach ($barangList as $b) {
        $totals[$b['id']] = 0;
    }
    if (!empty($clients)) {
        foreach ($clients as $c) {
            foreach ($c['stocks'] as $st) {
                if (isset($totals[$st['barang_id']])) {
                    $totals[$st['barang_id']] += $st['stok_akhir'];
                    $grandTotal += $st['stok_akhir'];
                }
            }
        }
    }
    ?>
    <?php if (!empty($clients)): ?>
    <div class="flex flex-wrap items-center gap-3 mb-6 bg-indigo-50/50 dark:bg-indigo-500/10 px-5 py-3 rounded-xl border border-primary/20 shadow-sm">
        <span class="text-sm font-bold text-slate-700 dark:text-gray-300 mr-2">TOTAL TABUNG BEREDAR:</span>
        <?php foreach ($barangList as $b): ?>
            <?php $bTotal = $totals[$b['id']]; ?>
            <div class="flex items-center gap-2 bg-white dark:bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 shadow-sm hover:-translate-y-0.5 transition-transform">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400"><?= htmlspecialchars($b['nama_barang']) ?></span>
                <?php if ($bTotal > 0): ?>
                    <span class="inline-flex items-center justify-center min-w-[24px] h-6 px-1.5 rounded-full bg-emerald-500/15 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-bold border border-emerald-500/20 backdrop-blur-sm"><?= $bTotal ?></span>
                <?php elseif ($bTotal < 0): ?>
                    <span class="inline-flex items-center justify-center min-w-[24px] h-6 px-1.5 rounded-full bg-rose-500/15 dark:bg-rose-500/20 text-rose-600 dark:text-rose-400 text-xs font-bold border border-rose-500/20 backdrop-blur-sm"><?= $bTotal ?></span>
                <?php else: ?>
                    <span class="text-xs font-bold text-slate-400 dark:text-slate-500">0</span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    
    <div class="overflow-x-auto border border-slate-200 dark:border-gray-700 rounded-xl">
        <table class="w-full text-sm text-left whitespace-nowrap">
            <thead class="bg-slate-50/50 dark:bg-gray-800/50 text-slate-500">
                <tr>
                    <th class="static md:sticky left-0 z-20 bg-slate-50 dark:bg-gray-800 shadow-[4px_0_6px_-2px_rgba(0,0,0,0.05)] px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Nama Relasi</th>
                    <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Lokasi</th>
                    <?php foreach ($barangList as $b): ?>
                        <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700 text-center"><?= htmlspecialchars($b['nama_barang']) ?></th>
                    <?php endforeach; ?>
                    <th class="static md:sticky right-0 z-20 bg-slate-50 dark:bg-gray-800 shadow-[-4px_0_6px_-2px_rgba(0,0,0,0.05)] px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clients)): ?>
                    <tr>
                        <td colspan="<?= count($barangList) + 4 ?>" class="px-5 py-8 text-center text-slate-500">
                            Belum ada data relasi. Klik tombol di atas untuk menambah mitra baru.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($clients as $c): ?>
                        <tr class="mitra-row group hover:bg-slate-50 dark:hover:bg-gray-800/50 transition-colors">
                            <td class="mitra-nama static md:sticky left-0 z-10 bg-white dark:bg-gray-900 group-hover:bg-slate-50 dark:group-hover:bg-[#1a2333] shadow-[4px_0_6px_-2px_rgba(0,0,0,0.05)] px-5 py-4 border-b border-slate-200 dark:border-gray-700 font-bold text-slate-800 dark:text-gray-200"><?= htmlspecialchars($c['nama_relasi']) ?></td>
                            <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-800 dark:text-gray-200"><?= htmlspecialchars($c['lokasi'] ?: '-') ?></td>
                            
                            <!-- Dynamic Cylinder Stock columns -->
                            <?php foreach ($barangList as $b): ?>
                                <?php 
                                // Find stock for this specific barang in client stocks
                                $stockVal = 0;
                                foreach ($c['stocks'] as $st) {
                                    if ($st['barang_id'] == $b['id']) {
                                        $stockVal = $st['stok_akhir'];
                                        break;
                                    }
                                }
                                ?>
                                <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-center text-sm font-bold">
                                    <?php if ($stockVal > 0): ?>
                                        <span class="inline-flex items-center justify-center min-w-[34px] h-8 px-2.5 rounded-full bg-emerald-500/10 dark:bg-emerald-400/15 text-emerald-600 dark:text-emerald-400 font-bold border border-emerald-500/20 backdrop-blur-sm shadow-xs"><?= $stockVal ?></span>
                                    <?php elseif ($stockVal < 0): ?>
                                        <span class="inline-flex items-center justify-center min-w-[34px] h-8 px-2.5 rounded-full bg-rose-500/10 dark:bg-rose-400/15 text-rose-600 dark:text-rose-400 font-bold border border-rose-500/20 backdrop-blur-sm shadow-xs"><?= $stockVal ?></span>
                                    <?php else: ?>
                                        <span class="text-slate-400 dark:text-gray-500 font-medium">0</span>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                            
                            <!-- Action Links -->
                            <td class="static md:sticky right-0 z-10 bg-white dark:bg-gray-900 group-hover:bg-slate-50 dark:group-hover:bg-[#1a2333] shadow-[-4px_0_6px_-2px_rgba(0,0,0,0.05)] px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?= BASE_URL ?>relasi/detail/<?= $c['id'] ?>" class="btn-sm bg-slate-100 text-slate-700 dark:bg-gray-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-gray-600 transition-colors inline-block no-underline" title="Detail Profil &amp; History">
                                        Detail
                                    </a>
                                    <a href="<?= BASE_URL ?>relasi/edit/<?= $c['id'] ?>" class="btn-sm bg-indigo-50 text-primary dark:bg-indigo-500/20 hover:bg-indigo-100 transition-colors inline-block no-underline" title="Edit Mitra">
                                        Edit
                                    </a>
                                    <a href="<?= BASE_URL ?>relasi/delete/<?= $c['id'] ?>" class="btn-sm bg-red-50 text-danger dark:bg-red-500/20 hover:bg-red-100 transition-colors inline-block no-underline" onclick="return confirmAction(event, 'Apakah Anda yakin ingin menghapus relasi <?= htmlspecialchars($c['nama_relasi'], ENT_QUOTES) ?>? Semua data transaksi dan stok terkait akan terhapus.', this.href, 'Hapus Mitra');" title="Hapus">
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <?php if (isset($totalPages) && $totalPages > 1): ?>
        <div class="flex justify-center items-center gap-1 mt-8">
            <?php 
            $queryParams = [];
            if (!empty($_GET['search'])) $queryParams['search'] = $_GET['search'];
            if (!empty($_GET['date'])) $queryParams['date'] = $_GET['date'];
            $searchParam = !empty($queryParams) ? '&' . http_build_query($queryParams) : ''; 
            ?>
            
            <!-- Prev -->
            <?php if ($page > 1): ?>
                <a href="<?= BASE_URL ?>relasi/index?p=<?= $page - 1 ?><?= $searchParam ?>" class="btn-sm bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                    <i class="ph-bold ph-caret-left"></i>
                </a>
            <?php endif; ?>

            <?php 
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $page + 2);

            if ($startPage > 1) {
                echo '<a href="' . BASE_URL . 'relasi/index?p=1' . $searchParam . '" class="btn-sm bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">1</a>';
                if ($startPage > 2) {
                    echo '<span class="px-2 text-slate-400">...</span>';
                }
            }

            for ($i = $startPage; $i <= $endPage; $i++): 
            ?>
                <a href="<?= BASE_URL ?>relasi/index?p=<?= $i ?><?= $searchParam ?>" class="btn-sm <?= $page == $i ? 'btn-primary' : 'bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php 
            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    echo '<span class="px-2 text-slate-400">...</span>';
                }
                echo '<a href="' . BASE_URL . 'relasi/index?p=' . $totalPages . $searchParam . '" class="btn-sm bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">' . $totalPages . '</a>';
            }
            ?>

            <!-- Next -->
            <?php if ($page < $totalPages): ?>
                <a href="<?= BASE_URL ?>relasi/index?p=<?= $page + 1 ?><?= $searchParam ?>" class="btn-sm bg-white dark:bg-gray-800 border border-slate-200 dark:border-gray-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                    <i class="ph-bold ph-caret-right"></i>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchMitra');
    const searchForm = document.getElementById('searchForm');
    let timeout = null;

    if (searchInput) {
        // Auto-submit form when typing stops (debounce)
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                searchForm.submit();
            }, 500); // 500ms delay
        });

        // Move cursor to end of input text after reload
        if (searchInput.value) {
            const length = searchInput.value.length;
            searchInput.focus();
            searchInput.setSelectionRange(length, length);
        }
    }
});
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
