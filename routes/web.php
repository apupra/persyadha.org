<?php

use App\Controllers\FrontendController;
use App\Controllers\ProfilController;
use App\Controllers\PendidikanController;
use App\Controllers\ArtikelController;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Controllers\EventController;
use App\Controllers\ArtikelAdminController;
use App\Controllers\ArtikelCategoryController;
use App\Controllers\VideoController;
use App\Controllers\PostController;
use App\Controllers\BeritaController;
use App\Controllers\BeritaCategoryController;
use App\Controllers\LembagaPendidikanController;
use App\Controllers\JenisPendidikanController;
use App\Controllers\PosterPendidikanController;

use App\Controllers\ProfileController;
use App\Controllers\LembagaCabangController;
use App\Controllers\BeritaFrontController;

use App\Controllers\FigureController;
use App\Controllers\BookController;
use App\Controllers\GalleryController;
use App\Controllers\DownloadController;

use App\Controllers\FrontFigureController;
use App\Controllers\FrontDownloadController;


//=== ADMIN ===
// Login
$router->get('/manjadmin/login', [AuthController::class, 'showLogin']);
$router->post('/manjadmin/login', [AuthController::class, 'doLogin']);
$router->get('/manjadmin/logout', [AuthController::class, 'logout']);
$router->get('/manjadmin/dashboard', [AdminController::class, 'dashboard']);

// =========================
// USER (OPERATOR / PENULIS)
// =========================

// LIST USER (admin/operator/penulis)
$router->get('/manjadmin/users', [AdminController::class, 'userIndex']);

// STORE USER (create)
// Modal tambah memakai: action="/persyadha.org/manjadmin/users/store"
$router->post('/manjadmin/users/store', [AdminController::class, 'userStore']);

// UPDATE USER
// Modal edit memakai: /persyadha.org/manjadmin/users/update/{id}
$router->post('/manjadmin/users/update/{id}', [AdminController::class, 'userUpdate']);

// DELETE USER (harus POST)
$router->post('/manjadmin/users/delete/{id}', [AdminController::class, 'userDelete']);

$router->get('/manjadmin/forbidden', function() {
    require __DIR__ . '/../views/admin/forbidden.php';
});


// === EVENT ===
$router->get('/manjadmin/events', [EventController::class, 'index']);      // List semua event
$router->get('/manjadmin/events/create', [EventController::class, 'create']); // Form tambah event
$router->post('/manjadmin/events/store', [EventController::class, 'store']);  // Simpan event baru
$router->get('/manjadmin/events/edit/{id}', [EventController::class, 'edit']); // Form edit event
$router->post('/manjadmin/events/update/{id}', [EventController::class, 'update']); // Update event
$router->post('/manjadmin/events/destroy/{id}', [EventController::class, 'destroy']); // Hapus event
$router->get('/manjadmin/events/show/{id}', [EventController::class, 'show']); // Detail event

// === Berita ===
$router->get('/manjadmin/berita', [BeritaController::class, 'index']);
$router->get('/manjadmin/berita/create', [BeritaController::class, 'create']);
$router->post('/manjadmin/berita/store', [BeritaController::class, 'store']);
$router->get('/manjadmin/berita/edit/{id}', [BeritaController::class, 'edit']);
$router->post('/manjadmin/berita/update/{id}', [BeritaController::class, 'update']);
$router->post('/manjadmin/berita/destroy/{id}', [BeritaController::class, 'destroy']);
$router->get('/manjadmin/berita/show/{id}', [BeritaController::class, 'show']);

// === KATEGORI BERITA ===
$router->get('/manjadmin/berita-categories', [BeritaCategoryController::class, 'index']);
$router->post('/manjadmin/berita-categories/store', [BeritaCategoryController::class, 'store']);
$router->post('/manjadmin/berita-categories/update/{id}', [BeritaCategoryController::class, 'update']);
$router->post('/manjadmin/berita-categories/destroy/{id}', [BeritaCategoryController::class, 'destroy']);

// Kategori Artikel
$router->get('/manjadmin/kategori-artikel', [ArtikelCategoryController::class, 'index']);
$router->get('/manjadmin/kategori-artikel/create', [ArtikelCategoryController::class, 'create']);
$router->post('/manjadmin/kategori-artikel/store', [ArtikelCategoryController::class, 'store']);
$router->get('/manjadmin/kategori-artikel/edit/{id}', [ArtikelCategoryController::class, 'edit']);
$router->post('/manjadmin/kategori-artikel/update/{id}', [ArtikelCategoryController::class, 'update']);
$router->post('/manjadmin/kategori-artikel/delete/{id}', [ArtikelCategoryController::class, 'delete']);

// === ARTIKEL ADMIN CRUD ===
$router->get('/manjadmin/artikel', [ArtikelAdminController::class, 'index']);
$router->get('/manjadmin/artikel/create', [ArtikelAdminController::class, 'create']);
$router->post('/manjadmin/artikel/store', [ArtikelAdminController::class, 'store']);
$router->get('/manjadmin/artikel/show/{id}', [ArtikelAdminController::class, 'show']);
$router->get('/manjadmin/artikel/edit/{id}', [ArtikelAdminController::class, 'edit']);
$router->post('/manjadmin/artikel/update/{id}', [ArtikelAdminController::class, 'update']);
$router->post('/manjadmin/artikel/destroy/{id}', [ArtikelAdminController::class, 'destroy']);

// === VIDEO ADMIN CRUD ===
$router->get('/manjadmin/videos', [VideoController::class, 'index']);
$router->get('/manjadmin/videos/create', [VideoController::class, 'create']);
$router->post('/manjadmin/videos/store', [VideoController::class, 'store']);
$router->get('/manjadmin/videos/edit/{id}', [VideoController::class, 'edit']);
$router->post('/manjadmin/videos/update/{id}', [VideoController::class, 'update']);
$router->post('/manjadmin/videos/destroy/{id}', [VideoController::class, 'destroy']);

// === POST ADMIN CRUD ===
$router->get('/manjadmin/posts', [PostController::class, 'index']);
$router->get('/manjadmin/posts/create', [PostController::class, 'create']);
$router->post('/manjadmin/posts/store', [PostController::class, 'store']);
$router->get('/manjadmin/posts/edit/{id}', [PostController::class, 'edit']);
$router->post('/manjadmin/posts/update/{id}', [PostController::class, 'update']);
$router->post('/manjadmin/posts/destroy/{id}', [PostController::class, 'destroy']);

// === Jenis Pendidikan ===
$router->get('/manjadmin/jenis-pendidikan', [JenisPendidikanController::class, 'index']);
$router->post('/manjadmin/jenis-pendidikan/simpan', [JenisPendidikanController::class, 'store']);
$router->post('/manjadmin/jenis-pendidikan/update/{id}', [JenisPendidikanController::class, 'update']);
$router->post('/manjadmin/jenis-pendidikan/hapus/{id}', [JenisPendidikanController::class, 'destroy']);

// === Lembaga Pendidikan ===
$router->get('/manjadmin/lembaga-pendidikan', [LembagaPendidikanController::class, 'index']);
$router->post('/manjadmin/lembaga-pendidikan/simpan', [LembagaPendidikanController::class, 'simpan']);
$router->post('/manjadmin/lembaga-pendidikan/update/{id}', [LembagaPendidikanController::class, 'update']);
$router->post('/manjadmin/lembaga-pendidikan/hapus/{id}', [LembagaPendidikanController::class, 'hapus']);

// === Poster Pendidikan ===
$router->get('/manjadmin/poster-pendidikan', [PosterPendidikanController::class, 'index']);
$router->post('/manjadmin/poster-pendidikan/simpan', [PosterPendidikanController::class, 'simpan']);
$router->post('/manjadmin/poster-pendidikan/update/{id}', [PosterPendidikanController::class, 'update']);
$router->post('/manjadmin/poster-pendidikan/hapus/{id}', [PosterPendidikanController::class, 'hapus']);

// === Profile ===
$router->get('/manjadmin/profile', [ProfileController::class, 'index']);
$router->get('/manjadmin/profile/create', [ProfileController::class, 'create']);
$router->post('/manjadmin/profile/store', [ProfileController::class, 'store']);
$router->get('/manjadmin/profile/edit/{id}', [ProfileController::class, 'edit']);
$router->post('/manjadmin/profile/update/{id}', [ProfileController::class, 'update']);
$router->post('/manjadmin/profile/delete/{id}', [ProfileController::class, 'delete']);

// === Lemabaga Cabang ===
$router->get('/manjadmin/lembaga-cabang', [LembagaCabangController::class, 'index']);
$router->post('/manjadmin/lembaga-cabang/simpan', [LembagaCabangController::class, 'simpan']);
$router->post('/manjadmin/lembaga-cabang/update/{id}', [LembagaCabangController::class, 'update']);
$router->post('/manjadmin/lembaga-cabang/hapus/{id}', [LembagaCabangController::class, 'hapus']);

// === Figures ===
$router->get('/manjadmin/figures', [FigureController::class, 'index']);
$router->get('/manjadmin/figures/create', [FigureController::class, 'create']);
$router->post('/manjadmin/figures/store', [FigureController::class, 'store']);
$router->get('/manjadmin/figures/edit/{id}', [FigureController::class, 'edit']);
$router->post('/manjadmin/figures/update/{id}', [FigureController::class, 'update']);
$router->post('/manjadmin/figures/destroy/{id}', [FigureController::class, 'destroy']);

// === Book ===
$router->get('/manjadmin/book', [BookController::class, 'index']);
$router->post('/manjadmin/book/store', [BookController::class, 'store']);
$router->post('/manjadmin/book/update/{id}', [BookController::class, 'update']);
$router->post('/manjadmin/book/destroy/{id}', [BookController::class, 'destroy']);

// === Gallery ===
$router->get('/manjadmin/gallery', [GalleryController::class, 'index']);
$router->post('/manjadmin/gallery/store', [GalleryController::class, 'store']);
$router->post('/manjadmin/gallery/update/{id}', [GalleryController::class, 'update']);
$router->post('/manjadmin/gallery/destroy/{id}', [GalleryController::class, 'destroy']);

// BACKEND DOWNLOAD CRUD
$router->get('/manjadmin/downloads', [DownloadController::class, 'index']);
$router->get('/manjadmin/downloads/create', [DownloadController::class, 'create']);
$router->post('/manjadmin/downloads/store', [DownloadController::class, 'store']);
$router->get('/manjadmin/downloads/edit/{id}', [DownloadController::class, 'edit']);
$router->post('/manjadmin/downloads/update/{id}', [DownloadController::class, 'update']);
$router->post('/manjadmin/downloads/delete/{id}', [DownloadController::class, 'delete']);



// ===== FRONTEND =====
$router->get('/', [FrontendController::class, 'index']);

// ===== PROFIL =====
$router->get('/profil', [ProfilController::class, 'index']);

// Pendidikan
$router->get('/pendidikan', [PendidikanController::class, 'index']);
$router->get('/pendidikan/jenis/{id}', [PendidikanController::class, 'byJenis']);

// ===== ARTIKEL =====
$router->get('/artikel', [ArtikelController::class, 'index']);
$router->get('/artikel/{slug}', [ArtikelController::class, 'show']);
$router->get('/artikel/kategori/{slug}', [ArtikelController::class, 'kategori']);

//======= Berita =====
$router->get('/berita', [BeritaFrontController::class, 'index']);
$router->get('/berita/detail/{id}', [BeritaFrontController::class, 'show']);

$router->get('/berita/kategori/{id}', [BeritaFrontController::class, 'kategori']);

// ===== FIGURES =====
$router->get('/figures', [FrontFigureController::class, 'index']);
$router->get('/figure/{slug}', [FrontFigureController::class, 'detail']);
$router->get('/figure/{slug}/kitab', [FrontFigureController::class, 'books']);
$router->get('/figure/{slug}/galeri', [FrontFigureController::class, 'gallery']);

// FRONTEND DOWNLOAD

// Halaman utama listing semua download
$router->get('/download', [FrontDownloadController::class, 'index']);

// Download satu file
$router->get('/download/file/{id}', [FrontDownloadController::class, 'download']);

// Download semua file berdasarkan tipe
$router->get('/download/{type}/all', [FrontDownloadController::class, 'downloadAll']);

// Detail download (opsional)
$router->get('/download/show/{id}', [FrontDownloadController::class, 'show']);









