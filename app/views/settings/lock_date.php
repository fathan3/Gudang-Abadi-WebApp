<?php
$title = "Tanggal Penguncian";
require_once __DIR__ . '/../layout/header.php';
?>

<div class="bg-white rounded-lg shadow-sm border border-slate-200">
    <div class="p-6 border-b border-slate-200">
        <h2 class="text-2xl font-bold text-slate-800">Tanggal Penguncian</h2>
    </div>

    <div class="p-6">
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'success_save'): ?>
                <div class="bg-emerald-100 text-emerald-700 p-4 rounded mb-6">Tanggal penguncian berhasil disimpan.</div>
            <?php elseif ($_GET['msg'] == 'success_delete'): ?>
                <div class="bg-emerald-100 text-emerald-700 p-4 rounded mb-6">Tanggal penguncian berhasil dihapus.</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="mb-8">
            <p class="text-slate-600 mb-6">
                Dengan tanggal penguncian maka semua transaksi pada dan sebelum tanggal penguncian tidak dapat diubah, dihapus dan ditambah. Kamu bisa mengubah tanggal penguncian setiap saat.
            </p>

            <form action="<?= BASE_URL ?>settings/lock_date" method="POST" class="max-w-md">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-red-500 mb-1">
                        * Cegah semua pengguna untuk membuat perubahan pada tanggal dan sebelum tanggal <span class="text-slate-400 cursor-help" title="Data sebelum tanggal ini tidak bisa dimanipulasi">?</span>
                    </label>
                    <input type="date" name="lock_date" value="<?= htmlspecialchars($current_lock_date) ?>" required class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded shadow-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                        <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                    </svg>
                    Simpan
                </button>
            </form>
        </div>

        <hr class="my-8 border-slate-200">

        <div>
            <p class="text-slate-600 mb-4">Klik tombol di bawah untuk menghapus tanggal penguncian</p>
            <form action="<?= BASE_URL ?>settings/lock_date" method="POST" onsubmit="return confirm('Yakin ingin menghapus tanggal penguncian? Data sebelumnya akan bisa diakses kembali.');">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded shadow-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    Hapus Tanggal Penguncian
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
