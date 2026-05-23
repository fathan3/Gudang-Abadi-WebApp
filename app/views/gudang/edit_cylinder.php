<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
    <div>
        <h2 class="text-2xl font-bold tracking-tight">Edit Katalog Tabung Gas</h2>
        <p class="text-slate-500 dark:text-gray-400 text-sm mt-1">Ubah nama atau deskripsi spesifikasi tabung</p>
    </div>
    <div>
        <a href="index.php?controller=gudang&action=index&tab=cylinders" class="btn-secondary">Kembali</a>
    </div>
</div>

<?php if (isset($error)): ?>
    <div class="flex items-center justify-between p-4 mb-8 rounded-xl badge-danger animate-[slideDown_0.4s_ease-out]">
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <p class="font-medium"><?= htmlspecialchars($error) ?></p>
        </div>
        <button class="hover:opacity-75 transition-opacity alert-close-btn">&times;</button>
    </div>
<?php endif; ?>

<div class="glass-panel p-6 rounded-2xl shadow-sm max-w-3xl">
    <form action="index.php?controller=gudang&action=edit_cylinder&id=<?= $barang['id'] ?>" method="POST">
        
        <div class="form-group">
            <label class="form-label block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2" for="nama_barang">Nama Tabung (Kode Barang)</label>
            <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?= htmlspecialchars($barang['nama_barang']) ?>" required>
        </div>
        
        <div class="form-group mt-4">
            <label class="form-label block text-sm font-semibold text-slate-700 dark:text-gray-300 mb-2" for="deskripsi">Deskripsi Detail</label>
            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($barang['deskripsi'] ?: '') ?></textarea>
        </div>

        <div class="flex justify-end gap-3 mt-8">
            <a href="index.php?controller=gudang&action=index&tab=cylinders" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
