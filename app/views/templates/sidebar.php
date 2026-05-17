<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#050533] text-white transition-transform duration-300 transform -translate-x-full md:translate-x-0 flex flex-col h-full">
    <div class="p-6 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="https://img.icons8.com/fluency/48/gas-cylinder.png" class="w-8 h-8">
            <h1 class="font-bold text-lg">CylindrTrack</h1>
        </div>
        <button onclick="toggleSidebar()" class="md:hidden text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <nav class="flex-1 px-4 space-y-2">
        <a href="#" class="sidebar-active flex items-center gap-3 p-3 rounded-lg text-sm">Dashboard</a>
        <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-sm opacity-60">Transaksi</a>
        <a href="#" class="flex items-center gap-3 p-3 rounded-lg text-sm opacity-60">Mitra</a>
    </nav>

    <div class="p-4 border-t border-white/10 space-y-4">
        <button class="w-full py-3 bg-[#00F2FF] text-[#050533] rounded-lg font-bold text-xs uppercase">Transaksi Cepat</button>
    </div>
</aside>

<div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black opacity-50 z-40 hidden md:hidden"></div>