<?php
$activeController = isset($_GET['controller']) ? $_GET['controller'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TabungFlow | Manajemen Logistik Tabung Gas</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (Play CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: { DEFAULT: '#4f46e5', hover: '#4338ca', glow: 'rgba(79, 70, 229, 0.15)' },
                        success: { DEFAULT: '#0d9488', bg: 'rgba(13, 148, 136, 0.15)' },
                        warning: { DEFAULT: '#f59e0b', bg: 'rgba(245, 158, 11, 0.15)' },
                        danger: { DEFAULT: '#ef4444', bg: 'rgba(239, 68, 68, 0.15)', glow: 'rgba(239, 68, 68, 0.2)' }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                @apply bg-slate-50 dark:bg-[#090d16] text-slate-900 dark:text-gray-100 min-h-screen flex transition-colors duration-300 overflow-x-hidden;
            }
            ::-webkit-scrollbar { width: 8px; height: 8px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { @apply bg-slate-400 dark:bg-gray-600 rounded-full; }
            ::-webkit-scrollbar-thumb:hover { @apply bg-slate-500 dark:bg-gray-500; }
        }
        @layer components {
            .glass-panel {
                @apply bg-white/70 dark:bg-gray-900/60 backdrop-blur-md border border-white/60 dark:border-white/10;
            }
            .btn {
                @apply inline-flex items-center justify-center gap-2 px-5 py-2.5 font-semibold text-sm rounded-xl transition-all no-underline cursor-pointer;
            }
            .btn-primary {
                @apply btn bg-primary text-white shadow-[0_4px_12px_rgba(79,70,229,0.15)] hover:bg-primary-hover hover:-translate-y-0.5;
            }
            .btn-secondary {
                @apply btn glass-panel text-slate-900 dark:text-gray-100 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 hover:text-primary dark:hover:text-primary hover:-translate-y-0.5;
            }
            .btn-danger {
                @apply btn bg-danger text-white hover:bg-red-600 hover:-translate-y-0.5;
            }
            .btn-sm {
                @apply px-3.5 py-1.5 text-xs rounded-lg;
            }
            .form-label {
                @apply block font-semibold text-sm mb-2 text-slate-600 dark:text-gray-400;
            }
            .form-control {
                @apply w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-slate-900 dark:text-gray-100 text-sm transition-all focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/10;
            }
            .badge {
                @apply inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold;
            }
            .badge-success { @apply bg-success-bg text-success border border-success/20; }
            .badge-warning { @apply bg-warning-bg text-warning border border-warning/20; }
            .badge-danger { @apply bg-danger-bg text-danger border border-danger/20; }
            .badge-info { @apply bg-indigo-50 dark:bg-indigo-500/10 text-primary border border-primary/20; }
        }
    </style>
</head>
<body>
    <div class="flex w-full relative">
        <!-- Mobile Overlay -->
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity" id="mobileOverlay"></div>
        
        <!-- Sidebar Navigation -->
        <aside class="w-[280px] h-screen fixed left-0 top-0 glass-panel border-r px-6 py-8 flex flex-col z-50 transition-transform duration-300 max-lg:-translate-x-full" id="sidebar">
            <div class="flex items-center gap-3 mb-12">
                <!-- Gas Cylinder Logo Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-primary drop-shadow-[0_0_8px_rgba(79,70,229,0.15)]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.283 8.283 0 013 6.3 8.284 8.284 0 003-6.3 8.287 8.287 0 002.962-2.386z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5h.008v.008H9V13.5zm3 0h.008v.008H12V13.5zm3 0h.008v.008H15V13.5z" />
                </svg>
                <h1 class="text-xl font-bold tracking-tight bg-gradient-to-br from-primary to-success bg-clip-text text-transparent">TabungFlow</h1>
            </div>
            
            <nav class="flex-grow">
                <ul class="flex flex-col gap-2">
                    <?php 
                    $menuItems = [
                        ['id' => 'dashboard', 'label' => 'Dashboard', 'url' => 'index.php?controller=dashboard&action=index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />'],
                        ['id' => 'pengiriman', 'label' => 'Log Pengiriman', 'url' => 'index.php?controller=pengiriman&action=index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 18.75a1.5 1.5 0 01-3 0m11.25 0a1.5 1.5 0 01-3 0m3 0h1.125v-1.5M16.5 18.75a1.5 1.5 0 00-3 0M16.5 18.75h-3.75m1.5-11.25h-3m3 3h-3m3 3h-3M6.75 2.25h10.5a2.25 2.25 0 012.25 2.25v13.5a2.25 2.25 0 01-2.25 2.25H6.75a2.25 2.25 0 01-2.25-2.25V4.25a2.25 2.25 0 012.25-2.25z" />'],
                        ['id' => 'relasi', 'label' => 'Stok Relasi / Mitra', 'url' => 'index.php?controller=relasi&action=index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.005 9.005 0 00-6-6.197V8.5a3.5 3.5 0 117 0v4.023a9.005 9.005 0 00-1 6.197zm-6-6.197a9.005 9.005 0 00-6 6.197V12.523A9.003 9.003 0 0012 8.5v4.023zm-6 6.197a9.003 9.003 0 001 6.197V18.72zm6 0v2.28c0 .248-.202.45-.45.45H10.45a.45.45 0 01-.45-.45v-2.28m6 0v2.28c0 .248-.202.45-.45.45h-1.1c-.248 0-.45-.202-.45-.45v-2.28M6 18.72v2.28c0 .248.202.45.45.45h1.1a.45.45 0 00.45-.45v-2.28" />'],
                        ['id' => 'gudang', 'label' => 'Stok Gudang', 'url' => 'index.php?controller=gudang&action=index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h18v3H3V3z" />'],
                        ['id' => 'evaluasi', 'label' => 'Evaluasi Repurchase', 'url' => 'index.php?controller=evaluasi&action=index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />']
                    ];
                    
                    foreach ($menuItems as $item):
                        $isActive = $activeController === $item['id'];
                        $activeClasses = $isActive ? 'bg-primary text-white shadow-[0_4px_14px_rgba(79,70,229,0.3)]' : 'text-slate-500 dark:text-gray-400 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 hover:text-primary dark:hover:text-primary';
                    ?>
                    <li>
                        <a href="<?= $item['url'] ?>" class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition-all <?= $activeClasses ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <?= $item['icon'] ?>
                            </svg>
                            <span><?= $item['label'] ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="pt-6 border-t border-slate-200 dark:border-gray-700 flex flex-col gap-4 mt-auto">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-success flex items-center justify-center text-white font-semibold shadow-md">
                            <?= isset($_SESSION['user_name']) ? strtoupper(substr($_SESSION['user_name'], 0, 1)) : 'A' ?>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-sm text-slate-800 dark:text-gray-200"><?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Admin' ?></span>
                            <span class="text-xs text-slate-500 dark:text-gray-400">Sistem Gudang</span>
                        </div>
                    </div>
                    <button class="p-2 rounded-full glass-panel text-slate-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-500/10 hover:text-primary transition-all" id="themeToggleBtn" title="Ganti Tema">
                        <!-- Sun Icon -->
                        <svg id="theme-icon-light" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 hidden dark:block">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m0 13.5V21M5.22 5.22l1.59 1.59m10.38 10.38l1.59 1.59M12 6a6 6 0 110 12 6 6 0 010-12zM3 12h2.25m13.5 0H21m-15.78 5.78l1.59-1.59m10.38-10.38l1.59-1.59" />
                        </svg>
                        <!-- Moon Icon -->
                        <svg id="theme-icon-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 block dark:hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                        </svg>
                    </button>
                </div>
                <a href="index.php?controller=auth&action=logout" class="btn btn-secondary btn-sm w-full !text-danger hover:!bg-danger-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Keluar / Logout
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow w-full lg:ml-[280px] min-h-screen p-6 lg:p-10 transition-all duration-300 flex flex-col min-w-0">
            <!-- Mobile Header -->
            <div class="lg:hidden flex items-center justify-between mb-8 glass-panel p-4 rounded-2xl">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.283 8.283 0 013 6.3 8.284 8.284 0 003-6.3 8.287 8.287 0 002.962-2.386z" />
                    </svg>
                    <h1 class="text-lg font-bold bg-gradient-to-br from-primary to-success bg-clip-text text-transparent">TabungFlow</h1>
                </div>
                <button id="mobileMenuToggle" class="btn btn-secondary btn-sm !p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>

            <!-- Global Flash Messages -->
            <?php if (isset($_GET['msg'])): ?>
                <?php 
                $msgConfig = [
                    'success_create' => ['type' => 'success', 'text' => 'Data berhasil disimpan!'],
                    'success_update' => ['type' => 'success', 'text' => 'Data berhasil diperbarui!'],
                    'success_delete' => ['type' => 'info', 'text' => 'Data berhasil dihapus!'],
                    'error_delete' => ['type' => 'danger', 'text' => 'Gagal menghapus data. Periksa ketergantungan relasi.']
                ];
                
                if (isset($msgConfig[$_GET['msg']])):
                    $msgInfo = $msgConfig[$_GET['msg']];
                    $iconPaths = [
                        'success' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'info' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
                        'danger' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'
                    ];
                ?>
                <div class="flex items-center justify-between p-4 mb-8 rounded-xl badge-<?= $msgInfo['type'] ?> animate-[slideDown_0.4s_ease-out]">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="<?= $iconPaths[$msgInfo['type']] ?>" />
                        </svg>
                        <p class="font-medium"><?= $msgInfo['text'] ?></p>
                    </div>
                    <button class="hover:opacity-75 transition-opacity alert-close-btn">&times;</button>
                </div>
                <script>
                    document.querySelector('.alert-close-btn')?.addEventListener('click', function() {
                        this.closest('div').remove();
                    });
                </script>
                <?php endif; ?>
            <?php endif; ?>

