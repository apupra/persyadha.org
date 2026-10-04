<?php
namespace App\Controllers;

use App\Models\Artikel;
use App\Models\Category;

class ArtikelController extends BaseController
{
    public function index()
    {
        // --- ARTIKEL UTAMA (selalu tampil, tidak ikut pagination) ---
        $artikelUtama = Artikel::latestOne();

        // --- PAGINATION untuk artikel lainnya ---
        $perPage = 4; // karena artikel utama sudah dipisah
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1) $page = 1;

        // Hitung total artikel KECUALI artikel utama
        $totalRows = Artikel::countAll() - 1;
        if ($totalRows < 0) $totalRows = 0;

        $totalPages = ceil($totalRows / $perPage);
        $offset = ($page - 1) * $perPage;

        // Ambil artikel selain artikel utama
        $artikels = Artikel::latestExceptOne($perPage, $offset);

        // Ambil kategori beserta jumlah artikel
        $categories = Category::withArticleCount();

        // Populer
        $popularToday = Artikel::popularToday(3);
        $popularAllTime = Artikel::mostPopular(1);

        // Populer per kategori
        $popularByCategory = [];
        foreach ($categories as $category) {
            $popularByCategory[$category['name']] = Artikel::popularByCategory($category['id'], 1);
        }

        // Render view
        $this->render('artikel/index', [
            'artikelUtama' => $artikelUtama,
            'artikels' => $artikels,
            'categories' => $categories,
            'popularToday' => $popularToday,
            'popularAllTime' => $popularAllTime,
            'popularByCategory' => $popularByCategory,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }

    public function show($slug)
    {
        $artikel = Artikel::findBySlug($slug);

        if (!$artikel) {
            http_response_code(404);
            echo "Artikel tidak ditemukan";
            return;
        }

        // Tambah view count
        Artikel::addView($artikel['id']);

        $this->render('artikel/show', compact('artikel'));
    }

    public function kategori($slug)
    {
        $category = Category::findBySlug($slug);
        if (!$category) {
            http_response_code(404);
            echo "Kategori tidak ditemukan";
            return;
        }

        $articles = Artikel::byCategory($category['id']);
        $allCategories = Category::all();

        $this->render('artikel/artikel-kategori', compact('category', 'articles', 'allCategories'));
    }
}
