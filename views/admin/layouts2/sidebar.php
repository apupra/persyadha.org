<!-- SIDEBAR TAILWIND -->
<aside id="sidebar" class="sidebar w-64 bg-[#013220] text-white flex flex-col min-h-screen">
    <!-- Header Logo -->
    <div class="flex items-center justify-between h-16 border-b border-green-700 px-4">
        <a href="#" class="flex items-center gap-2">
            <img src="/persyadha.org/assets/frontend/images/logo kiri.png" alt="Logo" class="h-10 w-auto">
            <span class="text-lg font-semibold sidebar-text">Al-Haromain</span>
        </a>
        <button id="toggleSidebar" class="text-white text-2xl xl:hidden">
            <i class="bi bi-x"></i>
        </button>
    </div>

    <?php $currentPath = $_SERVER['REQUEST_URI']; ?>

    <!-- MENU -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-4">

        <!-- Dashboard -->
        <div>
            <h2 class="text-green-400 uppercase text-xs font-semibold mb-2 tracking-wider">Menu</h2>
            <a href="/persyadha.org/manjadmin/dashboard"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/dashboard') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-grid-fill"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </div>

        <hr class="border-green-700/40">

        <!-- Konten Utama -->
        <div>
            <h2 class="text-green-400 uppercase text-xs font-semibold mb-2 tracking-wider">Konten Utama</h2>

            <a href="/persyadha.org/manjadmin/events"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/events') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-calendar-event"></i>
                <span class="sidebar-text">Event</span>
            </a>

            <?php
            $isBeritaCategory = str_contains($currentPath, '/manjadmin/berita-categories');
            $isBerita = str_contains($currentPath, '/manjadmin/berita') && !$isBeritaCategory;
            ?>

            <a href="/persyadha.org/manjadmin/berita-categories"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= $isBeritaCategory ? 'bg-green-800' : '' ?>">
                <i class="bi bi-tags"></i>
                <span class="sidebar-text">Kategori Berita</span>
            </a>

            <a href="/persyadha.org/manjadmin/berita"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= $isBerita ? 'bg-green-800' : '' ?>">
                <i class="bi bi-newspaper"></i>
                <span class="sidebar-text">Berita</span>
            </a>

            <a href="/persyadha.org/manjadmin/posts"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/posts') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-megaphone"></i>
                <span class="sidebar-text">Posts</span>
            </a>
        </div>

        <hr class="border-green-700/40">

        <!-- Artikel & Majalah -->
        <div>
            <h2 class="text-green-400 uppercase text-xs font-semibold mb-2 tracking-wider">Artikel & Majalah</h2>

            <a href="/persyadha.org/manjadmin/kategori-artikel"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/kategori-artikel') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-tags"></i>
                <span class="sidebar-text">Kategori Artikel</span>
            </a>

            <a href="/persyadha.org/manjadmin/artikel"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/artikel') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-journal-text"></i>
                <span class="sidebar-text">Artikel</span>
            </a>

            <a href="/persyadha.org/manjadmin/majalah"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/majalah') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-book-half"></i>
                <span class="sidebar-text">Majalah</span>
            </a>
        </div>

        <hr class="border-green-700/40">

        <!-- Media -->
        <div>
            <h2 class="text-green-400 uppercase text-xs font-semibold mb-2 tracking-wider">Media</h2>

            <a href="/persyadha.org/manjadmin/videos"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/videos') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-youtube"></i>
                <span class="sidebar-text">Video</span>
            </a>
        </div>

        <hr class="border-green-700/40">

        <!-- Data Pendukung -->
        <div>
            <h2 class="text-green-400 uppercase text-xs font-semibold mb-2 tracking-wider">Data Pendukung</h2>

            <a href="/persyadha.org/manjadmin/jenis-pendidikan"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/jenis-pendidikan') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-list-task"></i>
                <span class="sidebar-text">Jenis Pendidikan</span>
            </a>

            <a href="/persyadha.org/manjadmin/poster-pendidikan"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/poster-pendidikan') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-images"></i>
                <span class="sidebar-text">Poster Pendidikan</span>
            </a>

            <a href="/persyadha.org/manjadmin/lembaga-pendidikan"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-green-700 <?= str_contains($currentPath, '/manjadmin/lembaga') ? 'bg-green-800' : '' ?>">
                <i class="bi bi-building"></i>
                <span class="sidebar-text">Lembaga Pendidikan</span>
            </a>
        </div>

        <hr class="border-green-700/40">

        <!-- Sistem -->
        <div>
            <h2 class="text-green-400 uppercase text-xs font-semibold mb-2 tracking-wider">Sistem</h2>
            <a href="/persyadha.org/manjadmin/logout"
                class="flex items-center gap-3 p-3 rounded-xl hover:bg-red-700 text-red-400 hover:text-white">
                <i class="bi bi-box-arrow-right"></i>
                <span class="sidebar-text">Logout</span>
            </a>
        </div>

    </nav>
</aside>
