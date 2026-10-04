<?php
$userRole = $_SESSION['admin']['role'] ?? null;
$currentPath = $_SERVER['REQUEST_URI'];
?>

<!-- SIDEBAR -->
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="#">
                        <img src="/persyadha.org/assets/frontend/images/logo kiri.png" alt="Logo"
                            style="width: 200px; height: auto;">
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/dashboard') ? 'active' : '' ?>">
                    <a href="/persyadha.org/manjadmin/dashboard" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <hr class="my-2 text-secondary opacity-25">

                <!-- KONTEN UTAMA -->
                <?php if (in_array($userRole, ['admin', 'operator'])): ?>

                    <!-- KONTEN UTAMA -->
                    <li class="sidebar-title">Konten Utama</li>

                    <!-- Profile (semua role bisa akses) -->
                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/profile') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/profile" class="sidebar-link">
                            <i class="bi bi-person"></i>
                            <span>Profil</span>
                        </a>
                    </li>

                    <!-- Event (admin & operator) -->

                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/events') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/events" class="sidebar-link">
                            <i class="bi bi-calendar-event"></i>
                            <span>Event</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Kategori Berita (admin saja) -->
                <?php if ($userRole === 'admin'): ?>
                    <li
                        class="sidebar-item <?= str_contains($currentPath, '/manjadmin/berita-categories') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/berita-categories" class="sidebar-link">
                            <i class="bi bi-tags"></i>
                            <span>Kategori Berita</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Berita (admin & operator) -->
                <?php if (in_array($userRole, ['penulis', 'operator'])): ?>
                    <li
                        class="sidebar-item <?= str_contains($currentPath, '/manjadmin/berita') && !str_contains($currentPath, '/manjadmin/berita-categories') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/berita" class="sidebar-link">
                            <i class="bi bi-newspaper"></i>
                            <span>Berita</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Posts (admin & operator) -->
                <?php if (in_array($userRole, ['penulis', 'operator'])): ?>
                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/posts') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/posts" class="sidebar-link">
                            <i class="bi bi-megaphone"></i>
                            <span>Posts</span>
                        </a>
                    </li>
                <?php endif; ?>

                <hr class="my-2 text-secondary opacity-25">

                <!-- ARTIKEL & MAJALAH -->
                <li class="sidebar-title">Artikel</li>

                <!-- Kategori Artikel (admin saja) -->
                <?php if ($userRole === 'admin'): ?>
                    <li
                        class="sidebar-item <?= str_contains($currentPath, '/manjadmin/kategori-artikel') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/kategori-artikel" class="sidebar-link">
                            <i class="bi bi-tags"></i>
                            <span>Kategori Artikel</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Artikel (admin & penulis) -->
                <?php if (in_array($userRole, ['admin', 'penulis'])): ?>
                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/artikel') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/artikel" class="sidebar-link">
                            <i class="bi bi-journal-text"></i>
                            <span>Artikel</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Majalah (admin & penulis) -->
                <?php if (in_array($userRole, ['admin', 'penulis'])): ?>
                   <!-- <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/majalah') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/majalah" class="sidebar-link">
                            <i class="bi bi-book-half"></i>
                            <span>Majalah</span>
                        </a>
                    </li> -->
                <?php endif; ?>

                <hr class="my-2 text-secondary opacity-25">

                <!-- MEDIA (admin & operator) -->
                <?php if (in_array($userRole, ['admin', 'penulis'])): ?>
                    <li class="sidebar-title">Media</li>
                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/videos') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/videos" class="sidebar-link">
                            <i class="bi bi-youtube"></i>
                            <span>Video</span>
                        </a>
                    </li>
                <?php endif; ?>

                <hr class="my-2 text-secondary opacity-25">

                <!-- DATA PENDUKUNG (admin & operator) -->
                <?php if (in_array($userRole, ['admin', 'operator'])): ?>
                    <li class="sidebar-title">Data Pendukung</li>

                    <li
                        class="sidebar-item <?= str_contains($currentPath, '/manjadmin/jenis-pendidikan') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/jenis-pendidikan" class="sidebar-link">
                            <i class="bi bi-list-task"></i>
                            <span>Jenis Pendidikan</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item <?= str_contains($currentPath, '/manjadmin/poster-pendidikan') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/poster-pendidikan" class="sidebar-link">
                            <i class="bi bi-images"></i>
                            <span>Poster Pendidikan</span>
                        </a>
                    </li>

                    <li
                        class="sidebar-item <?= str_contains($currentPath, '/manjadmin/lembaga-pendidikan') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/lembaga-pendidikan" class="sidebar-link">
                            <i class="bi bi-building"></i>
                            <span>Lembaga Pendidikan</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/lembaga-cabang') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/lembaga-cabang" class="sidebar-link">
                            <i class="bi bi-building"></i>
                            <span>Unit Kerja</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/figures') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/figures" class="sidebar-link">
                            <i class="bi bi-people"></i>
                            <span>Figures</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/book') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/book" class="sidebar-link">
                            <i class="bi bi-book"></i>
                            <span>Book</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/gallery') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/gallery" class="sidebar-link">
                            <i class="bi bi-images"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                

                <hr class="my-2 text-secondary opacity-25">

                <?php endif; ?>

                <!-- Penambahan Users -->
                <?php if ($userRole === 'admin'): ?>
                    <li class="sidebar-title">Users</li>
                    <li class="sidebar-item <?= str_contains($currentPath, '/manjadmin/users') ? 'active' : '' ?>">
                        <a href="/persyadha.org/manjadmin/users" class="sidebar-link">
                            <i class="bi bi-people"></i>
                            <span>Users</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- SISTEM (semua role) -->
                <li class="sidebar-title">Sistem</li>
                <li class="sidebar-item">
                    <a href="/persyadha.org/manjadmin/logout" class="sidebar-link text-danger">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>