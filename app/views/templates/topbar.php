<header class="bg-white border-b px-4 md:px-8 py-4 sticky top-0 z-30 flex items-center justify-between">
    <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" class="md:hidden text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        <div class="relative hidden sm:block w-64 lg:w-96">
            <input type="text" placeholder="Cari..." class="w-full bg-gray-50 border border-gray-200 rounded-full py-2 pl-10 pr-4 text-sm focus:outline-none">
        </div>
    </div>

    <div class="flex items-center gap-4">
        <img src="https://ui-avatars.com/api/?name=Fathan" class="w-8 h-8 rounded-full border">
    </div>
</header>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>