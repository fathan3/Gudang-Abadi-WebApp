<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Pengaturan Sistem</h2>
        <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Kelola tanggal penguncian transaksi dan hak akses akun pengguna</p>
    </div>
</div>

<!-- Settings Panel with Navigation Tabs -->
<div class="glass-panel rounded-2xl shadow-sm mb-8">
    <div class="flex border-b border-slate-200 dark:border-gray-700 overflow-x-auto no-scrollbar pt-2 px-6">
        <a href="<?= BASE_URL ?>settings/lock_date" class="px-6 py-4 font-semibold text-sm whitespace-nowrap border-b-2 text-primary border-primary dark:text-primary no-underline flex items-center gap-2">
            <i class="ph-bold ph-lock text-base"></i> Tanggal Penguncian
        </a>
        <a href="<?= BASE_URL ?>settings/users" class="px-6 py-4 font-semibold text-sm whitespace-nowrap border-b-2 text-slate-500 dark:text-gray-400 border-transparent hover:text-slate-700 dark:hover:text-gray-300 no-underline flex items-center gap-2">
            <i class="ph-bold ph-users text-base"></i> Manajemen Akun Pengguna
        </a>
    </div>

    <div class="p-6">
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'success_save'): ?>
                <div class="flex items-center justify-between p-4 mb-6 rounded-xl badge-success">
                    <p class="font-medium">Tanggal penguncian berhasil disimpan!</p>
                </div>
            <?php elseif ($_GET['msg'] == 'success_delete'): ?>
                <div class="flex items-center justify-between p-4 mb-6 rounded-xl badge-info">
                    <p class="font-medium">Tanggal penguncian berhasil dihapus!</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="max-w-2xl">
            <h3 class="text-lg font-bold text-slate-800 dark:text-gray-100 mb-2">Periode Penguncian Transaksi</h3>
            <p class="text-slate-500 dark:text-gray-400 text-sm mb-6">
                Semua transaksi pengiriman, penyesuaian stok, dan transfer pada dan sebelum tanggal penguncian tidak dapat diubah atau dihapus oleh pengguna.
            </p>

            <form action="<?= BASE_URL ?>settings/lock_date" method="POST" class="space-y-4 max-w-md">
                <div>
                    <label class="form-label text-danger flex items-center gap-1">
                        <i class="ph-bold ph-warning"></i> Batas Tanggal Terkunci
                    </label>
                    <input type="date" name="lock_date" value="<?= htmlspecialchars($current_lock_date) ?>" required class="form-control">
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="ph-bold ph-floppy-disk text-base"></i>
                    Simpan Penguncian
                </button>
            </form>
        </div>

        <hr class="my-8 border-slate-200 dark:border-gray-700">

        <div class="max-w-2xl">
            <h4 class="font-bold text-slate-800 dark:text-gray-100 mb-2">Hapus Penguncian</h4>
            <p class="text-slate-500 dark:text-gray-400 text-sm mb-4">Membuka kembali semua transaksi historis untuk dapat diedit jika diperlukan.</p>
            <form action="<?= BASE_URL ?>settings/lock_date" method="POST" onsubmit="return confirm('Yakin ingin menghapus tanggal penguncian? Data transaksi lama akan bisa diedit kembali.');">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn-danger btn-sm">
                    <i class="ph-bold ph-trash text-base"></i>
                    Hapus Tanggal Penguncian
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
