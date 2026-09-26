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
        <a href="<?= BASE_URL ?>settings/lock_date" class="px-6 py-4 font-semibold text-sm whitespace-nowrap border-b-2 text-slate-500 dark:text-gray-400 border-transparent hover:text-slate-700 dark:hover:text-gray-300 no-underline flex items-center gap-2">
            <i class="ph-bold ph-lock text-base"></i> Tanggal Penguncian
        </a>
        <a href="<?= BASE_URL ?>settings/users" class="px-6 py-4 font-semibold text-sm whitespace-nowrap border-b-2 text-primary border-primary dark:text-primary no-underline flex items-center gap-2">
            <i class="ph-bold ph-users text-base"></i> Manajemen Akun Pengguna
        </a>
    </div>

    <div class="p-6">
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] == 'success_user_create'): ?>
                <div class="flex items-center justify-between p-4 mb-6 rounded-xl badge-success animate-[slideDown_0.4s_ease-out]">
                    <p class="font-medium">Akun pengguna baru berhasil dibuat!</p>
                </div>
            <?php elseif ($_GET['msg'] == 'success_user_delete'): ?>
                <div class="flex items-center justify-between p-4 mb-6 rounded-xl badge-info animate-[slideDown_0.4s_ease-out]">
                    <p class="font-medium">Akun pengguna berhasil dihapus!</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="flex items-center justify-between p-4 mb-6 rounded-xl badge-danger">
                <p class="font-medium"><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Table Users -->
            <div class="lg:col-span-2">
                <h3 class="text-lg font-bold text-slate-800 dark:text-gray-100 mb-4">Daftar Akun Pengguna</h3>
                <div class="overflow-x-auto border border-slate-200 dark:border-gray-700 rounded-xl">
                    <table class="w-full text-xs sm:text-sm text-left whitespace-nowrap">
                        <thead class="bg-slate-50/50 dark:bg-gray-800/50 text-slate-500">
                            <tr>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Nama Lengkap</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Username</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700">Hak Akses / Role</th>
                                <th class="px-5 py-4 font-semibold border-b border-slate-200 dark:border-gray-700 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usersList as $u): ?>
                                <tr class="hover:bg-slate-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 font-bold text-slate-800 dark:text-gray-200"><?= htmlspecialchars($u['nama_lengkap']) ?></td>
                                    <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-slate-600 dark:text-gray-400">@<?= htmlspecialchars($u['username']) ?></td>
                                    <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700">
                                        <?php if ($u['role'] === 'stok_harian'): ?>
                                            <span class="badge badge-warning">Input Stok Harian</span>
                                        <?php else: ?>
                                            <span class="badge badge-info">Admin Utama</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 border-b border-slate-200 dark:border-gray-700 text-center">
                                        <?php if ($u['id'] != $_SESSION['user_id']): ?>
                                            <a href="<?= BASE_URL ?>settings/delete_user?id=<?= $u['id'] ?>" class="btn-sm bg-red-50 text-danger dark:bg-red-500/20 hover:bg-red-100 transition-colors inline-block no-underline" onclick="return confirm('Hapus akun pengguna <?= htmlspecialchars($u['username'], ENT_QUOTES) ?>?');">Hapus</a>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400 italic">Akun Anda</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Add User -->
            <div class="lg:col-span-1">
                <div class="bg-indigo-50/30 dark:bg-indigo-500/5 border border-indigo-100 dark:border-indigo-500/10 rounded-2xl p-6">
                    <h4 class="font-bold text-lg mb-4 text-slate-800 dark:text-gray-100">Tambah Akun Admin Baru</h4>
                    <form action="<?= BASE_URL ?>settings/users" method="POST" class="space-y-4">
                        <div>
                            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="mis: Staff Stok Harian" required>
                        </div>
                        <div>
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="mis: admin_stok2" required>
                        </div>
                        <div>
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Kata sandi..." required>
                        </div>
                        <div>
                            <label class="form-label" for="role">Hak Akses / Peran</label>
                            <select id="role" name="role" class="form-control" required>
                                <option value="stok_harian">Input Stok Harian (Hanya Pengiriman & Gudang)</option>
                                <option value="admin">Admin Utama (Akses Penuh)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-primary w-full justify-center mt-2">
                            <i class="ph-bold ph-user-plus text-base"></i>
                            Buat Akun Admin
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
