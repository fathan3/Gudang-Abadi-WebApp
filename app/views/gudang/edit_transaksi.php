<?php
$title = "Edit Transaksi Gudang";
require_once __DIR__ . '/../layout/header.php';
?>

<div class="bg-white rounded-lg shadow-sm border border-slate-200">
    <div class="p-6 border-b border-slate-200">
        <h2 class="text-2xl font-bold text-slate-800">Edit Transaksi Gudang</h2>
    </div>

    <div class="p-6">
        <?php if (isset($error)): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6 flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 mt-0.5" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <span><?= $error ?></span>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>gudang/edit_transaksi?id=<?= $id ?>" method="POST" class="max-w-xl">
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Tipe Transaksi (Hanya Baca)</label>
                <input type="text" value="<?= htmlspecialchars($transaksi['tipe_transaksi']) ?>" disabled class="w-full border border-slate-300 bg-slate-100 text-slate-500 rounded px-3 py-2 cursor-not-allowed">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Jumlah (Hanya Baca)</label>
                <input type="text" value="<?= htmlspecialchars($transaksi['jumlah']) ?>" disabled class="w-full border border-slate-300 bg-slate-100 text-slate-500 rounded px-3 py-2 cursor-not-allowed">
                <p class="text-xs text-slate-500 mt-1">Untuk mengubah Tipe atau Jumlah, harap hapus transaksi ini dan buat baru.</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Transaksi</label>
                <input type="date" name="tanggal" value="<?= htmlspecialchars($transaksi['tanggal']) ?>" required class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full border border-slate-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"><?= htmlspecialchars($transaksi['keterangan']) ?></textarea>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded shadow-sm">
                    Simpan Perubahan
                </button>
                <a href="<?= BASE_URL ?>gudang?tab=transactions" class="text-slate-500 hover:text-slate-700 font-medium">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
