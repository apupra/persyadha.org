<?php
// ===================== NAV ACTIVE LOGIC (Emerald Elegant Refined) =====================
$currentPath = $_SERVER['REQUEST_URI'];

// Fungsi untuk menentukan status aktif nav
function isActive($path, $currentPath)
{
    // Warna biru muda elegan
    $activeClass = 'text-sky-400 font-semibold after:w-full after:bg-sky-300';
    $inactiveClass = 'hover:text-sky-300 hover:after:w-full hover:after:bg-sky-300';

    // Beranda cocok sempurna
    if ($path === '/persyadha.org/' || $path === '/persyadha.org') {
        return ($currentPath === $path) ? $activeClass : $inactiveClass;
    }

    // Lainnya cocok sebagian
    return (strpos($currentPath, $path) !== false) ? $activeClass : $inactiveClass;
}
?>

<!-- ===================== HEADER + NAVIGASI ===================== -->
<div class="fixed w-full z-50 top-0 left-0 bg-white dark:bg-gray-800 transition-colors duration-500 shadow-lg">
    <!-- HEADER -->
    <header class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
        <div class="container mx-auto px-4 py-2 flex items-center justify-between">
            <!-- Logo kiri -->
            <div class="flex justify-start w-1/3">
                <img src="/persyadha.org/assets/frontend/images/logo kiri.png" alt="Logo Al-Haromain"
                    class="h-10 sm:h-12 md:h-14 w-auto object-contain transition-all duration-300">
            </div>

            <!-- Teks Arab tengah -->
            <div class="flex justify-center w-1/3">
                <img src="/persyadha.org/assets/frontend/images/masya.png" alt="Masha Allah"
                    class="h-10 sm:h-12 md:h-14 w-auto object-contain transition-all duration-300">
            </div>

            <!-- Tagar kanan -->
            <div class="flex justify-end w-1/3">
                <img src="/persyadha.org/assets/frontend/images/jis.png" alt="Tagar Logo"
                    class="h-10 sm:h-12 md:h-14 w-auto object-contain transition-all duration-300">
            </div>
        </div>
    </header>

    <!-- ===================== NAVIGASI ===================== -->
    <nav class="bg-green-main dark:bg-gray-900 text-gray-100 shadow-md relative">
        <div class="container mx-auto flex items-center justify-between px-4 lg:px-6 py-3">

            <!-- ===================== MENU DESKTOP ===================== -->
            <div class="hidden md:flex items-center space-x-8 text-[15px] font-medium">

                <!-- Beranda -->
                <a href="/persyadha.org/" class="relative transition-all duration-300 ease-in-out <?= isActive('/persyadha.org/', $currentPath) ?>
                          after:absolute after:-bottom-1 after:left-0 after:h-[2px]
                          after:w-0 after:transition-all after:duration-300 after:rounded-full">
                    Beranda
                </a>

                <!-- Profil -->
                <a href="/persyadha.org/profil" class="relative transition-all duration-300 ease-in-out <?= isActive('/persyadha.org/profil', $currentPath) ?>
                          after:absolute after:-bottom-1 after:left-0 after:h-[2px]
                          after:w-0 after:transition-all after:duration-300 after:rounded-full">
                    Profil
                </a>

                <!-- Pendidikan -->
                <div class="relative group">
                    <!-- Link utama Pendidikan -->
                    <a href="/persyadha.org/pendidikan" class="flex items-center relative transition-all duration-300 ease-in-out <?= isActive('/persyadha.org/pendidikan', $currentPath) ?>
              after:absolute after:-bottom-1 after:left-0 after:h-[2px]
              after:w-0 after:transition-all after:duration-300 after:rounded-full">
                        Pendidikan
                        <i
                            class="fas fa-chevron-down text-xs ml-1 transition-transform duration-200 group-hover:rotate-180"></i>
                    </a>

                    <!-- Dropdown menu -->
                    <div
                        class="absolute left-0 mt-2 hidden group-hover:block bg-white dark:bg-gray-700
                text-gray-800 dark:text-gray-200 rounded-xl shadow-lg w-56 overflow-hidden border border-gray-100 dark:border-gray-600">

                        <!-- Link Semua Pendidikan -->
                        <a href="/persyadha.org/pendidikan"
                            class="block px-4 py-2 font-semibold text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                            Semua Pendidikan
                        </a>
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <!-- Loop jenis pendidikan -->
                        <?php foreach ($jenisPendidikan as $jp): ?>
                            <a href="/persyadha.org/pendidikan/jenis/<?= htmlspecialchars($jp['id']) ?>"
                                class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                                <?= htmlspecialchars($jp['nama_jenis']) ?>
                            </a>
                        <?php endforeach; ?>

                    </div>
                </div>

                <!-- ===================== BERITA (DESKTOP) ===================== -->
                <div class="relative group">
                    <a href="/persyadha.org/berita" class="flex items-center relative transition-all duration-300 ease-in-out <?= isActive('/persyadha.org/berita', $currentPath) ?>
               after:absolute after:-bottom-1 after:left-0 after:h-[2px] after:w-0
               after:transition-all after:duration-300 after:rounded-full group-hover:after:w-full">
                        Berita
                        <i
                            class="fas fa-chevron-down text-xs ml-1 transition-transform duration-200 group-hover:rotate-180"></i>
                    </a>

                    <!-- Dropdown Kategori -->
                    <div class="absolute left-0 mt-2 hidden group-hover:block bg-white dark:bg-gray-700
               text-gray-800 dark:text-gray-200 rounded-xl shadow-lg w-56 overflow-hidden border
               border-gray-100 dark:border-gray-600 z-50">
                        <?php if (!empty($beritaCategories)): ?>
                            <!-- Tambahkan link utama di atas dropdown -->
                            <a href="/persyadha.org/berita"
                                class="block px-4 py-2 font-semibold text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                                Semua Berita
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <?php foreach ($beritaCategories as $cat): ?>
                                <a href="/persyadha.org/berita/kategori/<?= htmlspecialchars($cat['id']) ?>"
                                    class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                                    <?= htmlspecialchars($cat['name']) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="block px-4 py-2 text-gray-400">Belum ada kategori</span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Artikel -->
                <div class="relative group">
                    <a href="/persyadha.org/artikel" class="flex items-center relative transition-all duration-300 ease-in-out <?= isActive('/persyadha.org/artikel', $currentPath) ?>
                              after:absolute after:-bottom-1 after:left-0 after:h-[2px]
                              after:w-0 after:transition-all after:duration-300 after:rounded-full">
                        Artikel
                        <i
                            class="fas fa-chevron-down text-xs ml-1 transition-transform duration-200 group-hover:rotate-180"></i>
                    </a>
                    <div
                        class="absolute left-0 mt-2 hidden group-hover:block bg-white dark:bg-gray-700
                                text-gray-800 dark:text-gray-200 rounded-xl shadow-lg w-56 overflow-hidden border border-gray-100 dark:border-gray-600">
                        <?php if (!empty($categories)): ?>
                            <!-- Tambahkan link utama di atas dropdown -->
                            <a href="/persyadha.org/artikel"
                                class="block px-4 py-2 font-semibold text-emerald-600 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                                Semua Artikel
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <?php foreach ($categories as $cat): ?>
                                <a href="/persyadha.org/artikel/kategori/<?= htmlspecialchars($cat['slug']) ?>"
                                    class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                                    <?= htmlspecialchars($cat['name']) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="block px-4 py-2 text-gray-400">Belum ada kategori</span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Menu Tambahan -->
                <a href="#"
                    class="relative <?= isActive('/persyadha.org/majalah', $currentPath) ?>
                   transition duration-300 after:absolute after:-bottom-1 after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:rounded-full">
                    Majalah
                </a>
                <!-- ===================== ABI IHYAA' (DESKTOP DROPDOWN) ===================== -->
                <div class="relative group">
                    <a href="#" class="flex items-center relative transition-all duration-300 ease-in-out
       <?= isActive('/persyadha.org/figure/abi-ihya', $currentPath) ?>
       after:absolute after:-bottom-1 after:left-0 after:h-[2px] after:w-0
       after:transition-all after:duration-300 after:rounded-full group-hover:after:w-full">
                        Abi Ihya'
                        <i
                            class="fas fa-chevron-down text-xs ml-1 transition-transform duration-200 group-hover:rotate-180"></i>
                    </a>

                    <div class="absolute left-0 mt-2 hidden group-hover:block bg-white dark:bg-gray-700
        text-gray-800 dark:text-gray-200 rounded-xl shadow-lg w-48 overflow-hidden border
        border-gray-100 dark:border-gray-600 z-50">

                        <a href="/persyadha.org/figure/abi-ihya"
                            class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                            Profil
                        </a>

                        <a href="/persyadha.org/figure/abi-ihya/kitab"
                            class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                            Kitab
                        </a>

                        <a href="/persyadha.org/figure/abi-ihya/galeri"
                            class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                            Galeri
                        </a>
                    </div>
                </div>



                <!-- ===================== ABUYA (DESKTOP DROPDOWN) ===================== -->
                <div class="relative group">
                    <a href="#" class="flex items-center relative transition-all duration-300 ease-in-out
       <?= isActive('/persyadha.org/figure/abuya', $currentPath) ?>
       after:absolute after:-bottom-1 after:left-0 after:h-[2px] after:w-0
       after:transition-all after:duration-300 after:rounded-full group-hover:after:w-full">
                        Abuya
                        <i
                            class="fas fa-chevron-down text-xs ml-1 transition-transform duration-200 group-hover:rotate-180"></i>
                    </a>

                    <div class="absolute left-0 mt-2 hidden group-hover:block bg-white dark:bg-gray-700
        text-gray-800 dark:text-gray-200 rounded-xl shadow-lg w-48 overflow-hidden border
        border-gray-100 dark:border-gray-600 z-50">

                        <a href="/persyadha.org/figure/abuya"
                            class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                            Profil
                        </a>

                        <a href="/persyadha.org/figure/abuya/kitab"
                            class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                            Kitab
                        </a>

                        <a href="/persyadha.org/figure/abuya/galeri"
                            class="block px-4 py-2 hover:bg-emerald-50 dark:hover:bg-gray-600 transition">
                            Galeri
                        </a>
                    </div>
                </div>




                <a href="/persyadha.org/figures" class="relative <?= isActive('/persyadha.org/figures', $currentPath) ?>
    transition duration-300 after:absolute after:-bottom-1 after:left-0 after:h-[2px] 
    after:w-0 after:transition-all after:duration-300 after:rounded-full">
                    Tokoh
                </a>


                <a href="/persyadha.org/download"
                    class="relative <?= isActive('/persyadha.org/download', $currentPath) ?>
                   transition duration-300 after:absolute after:-bottom-1 after:left-0 after:h-[2px] after:w-0 after:transition-all after:duration-300 after:rounded-full">
                    Download
                </a>
            </div>

            <!-- ===================== HAMBURGER MOBILE ===================== -->
            <button id="hamburger-btn" class="md:hidden text-2xl focus:outline-none">
                <i class="fas fa-bars text-emerald-400 dark:text-gray-100"></i>
            </button>
        </div>

        <!-- ===================== MENU MOBILE (Refined + Active Highlight) ===================== -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-gray-100 dark:bg-gray-800 px-4 py-3 space-y-2 text-gray-800 dark:text-gray-100 text-left overflow-y-auto max-h-[80vh] transition-all duration-300 ease-in-out rounded-b-xl border-t border-gray-300 dark:border-gray-700">

            <!-- Beranda -->
            <a href="/persyadha.org/"
                class="block py-2 px-2 border-b border-gray-300 dark:border-gray-700 rounded transition-all duration-200 <?= isActive('/persyadha.org/', $currentPath) ?> hover:bg-gray-200 dark:hover:bg-gray-700">
                Beranda
            </a>

            <!-- Profil -->
            <a href="/persyadha.org/profil"
                class="block py-2 px-2 border-b border-gray-300 dark:border-gray-700 rounded transition-all duration-200 <?= isActive('/persyadha.org/profil', $currentPath) ?> hover:bg-gray-200 dark:hover:bg-gray-700">
                Profil
            </a>

            <!-- Pendidikan -->
            <button
                class="w-full flex justify-between items-center py-2 px-2 border-b border-gray-300 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 rounded toggle-submenu <?= isActive('/persyadha.org/pendidikan', $currentPath) ?>">
                <span>Pendidikan</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <div class="submenu hidden pl-4 mt-1 space-y-1 transition-all duration-300 ease-in-out">

                <!-- Link Semua Pendidikan -->
                <a href="/persyadha.org/pendidikan"
                    class="block py-1 text-sm font-semibold text-sky-500 dark:text-sky-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition">
                    Semua Pendidikan
                </a>

                <div class="border-t border-gray-300 dark:border-gray-600 my-1"></div>

                <p class="font-semibold text-sky-400 dark:text-sky-300 text-sm">Kategori Pendidikan:</p>

                <?php if (!empty($jenisPendidikan)): ?>
                    <!-- Loop jenis pendidikan (SAMA seperti versi desktop) -->
                    <?php foreach ($jenisPendidikan as $jp): ?>
                        <a href="/persyadha.org/pendidikan/jenis/<?= htmlspecialchars($jp['id']) ?>"
                            class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition">
                            <?= htmlspecialchars($jp['nama_jenis']) ?>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="block text-sm text-gray-400">Belum ada kategori</span>
                <?php endif; ?>

            </div>

            <!-- ===================== Berita (dengan "Semua Berita") ===================== -->
            <button
                class="w-full flex justify-between items-center py-2 px-2 border-b border-gray-300 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 rounded toggle-submenu <?= isActive('/persyadha.org/berita', $currentPath) ?>">
                <span>Berita</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <div class="submenu hidden pl-4 mt-1 space-y-1 transition-all duration-300 ease-in-out">
                <?php if (!empty($beritaCategories)): ?>
                    <!-- Link utama -->
                    <a href="/persyadha.org/berita"
                        class="block py-1 text-sm font-semibold text-sky-500 dark:text-sky-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition">
                        Semua Berita
                    </a>
                    <div class="border-t border-gray-300 dark:border-gray-600 my-1"></div>

                    <p class="font-semibold text-sky-400 dark:text-sky-300 text-sm">Kategori Berita:</p>
                    <?php foreach ($beritaCategories as $cat): ?>
                        <a href="/persyadha.org/berita/kategori/<?= htmlspecialchars($cat['id']) ?>"
                            class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition">
                            <?= htmlspecialchars($cat['name']) ?>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="block text-sm text-gray-400">Belum ada kategori</span>
                <?php endif; ?>
            </div>


            <!-- Artikel -->
            <button
                class="w-full flex justify-between items-center py-2 px-2 border-b border-gray-300 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 rounded toggle-submenu <?= isActive('/persyadha.org/artikel', $currentPath) ?>">
                <span>Artikel</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>
            <div class="submenu hidden pl-4 mt-1 space-y-1 transition-all duration-300 ease-in-out">
                <?php if (!empty($categories)): ?>
                    <!-- Link utama -->
                    <a href="/persyadha.org/artikel"
                        class="block py-1 text-sm font-semibold text-sky-500 dark:text-sky-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition">
                        Semua Artikel
                    </a>
                    <div class="border-t border-gray-300 dark:border-gray-600 my-1"></div>

                    <p class="font-semibold text-sky-400 dark:text-sky-300 text-sm">Kategori Artikel:</p>
                    <?php foreach ($categories as $cat): ?>
                        <a href="/persyadha.org/artikel/kategori/<?= htmlspecialchars($cat['slug']) ?>"
                            class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition">
                            <?= htmlspecialchars($cat['name']) ?>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="block text-sm text-gray-400">Belum ada kategori</span>
                <?php endif; ?>
            </div>

            <!-- ===================== Abi Ihya' (MOBILE) ===================== -->
            <button class="w-full flex justify-between items-center py-2 px-2 border-b border-gray-300
           dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 rounded toggle-submenu">
                <span>Abi Ihya'</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <div class="submenu hidden pl-4 mt-1 space-y-1">

                <a href="/persyadha.org/figure/abi-ihya"
                    class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                    Profil
                </a>

                <a href="/persyadha.org/figure/abi-ihya/kitab"
                    class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                    Kitab
                </a>

                <a href="/persyadha.org/figure/abi-ihya/galeri"
                    class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                    Galeri
                </a>
            </div>


            <!-- ===================== Abuya (MOBILE) ===================== -->
            <button class="w-full flex justify-between items-center py-2 px-2 border-b border-gray-300
           dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-700 rounded toggle-submenu">
                <span>Abuya</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <div class="submenu hidden pl-4 mt-1 space-y-1">

                <a href="/persyadha.org/figure/abuya"
                    class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                    Profil
                </a>

                <a href="/persyadha.org/figure/abuya/kitab"
                    class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                    Kitab
                </a>

                <a href="/persyadha.org/figure/abuya/galeri"
                    class="block py-1 text-sm hover:bg-gray-200 dark:hover:bg-gray-700 rounded">
                    Galeri
                </a>
            </div>


            <a href="/persyadha.org/figures"
                class="block py-2 px-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition <?= isActive('/persyadha.org/figures', $currentPath) ?>">
                Tokoh
            </a>

            <a href="/persyadha.org/download"
                class="block py-2 px-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded transition <?= isActive('/persyadha.org/download', $currentPath) ?>">Download</a>
        </div>

        <script>
            document.querySelectorAll('.toggle-submenu').forEach(button => {
                button.addEventListener('click', () => {
                    const submenu = button.nextElementSibling;
                    const icon = button.querySelector('i');
                    submenu.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            });
        </script>


    </nav>
</div>