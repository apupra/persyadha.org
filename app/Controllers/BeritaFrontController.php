<?php

namespace App\Controllers;

use App\Models\Berita;
use App\Models\BeritaCategory;

class BeritaFrontController extends BaseController
{
    // ===============================
    // Halaman utama daftar berita
    // ===============================
    public function index()
    {
        $conn = $this->getDB();

        // Ambil berita utama (paling baru)
        $latestResult = mysqli_query($conn, "
        SELECT b.*, c.name AS category_name 
        FROM berita AS b
        LEFT JOIN berita_categories AS c ON b.category_id = c.id
        ORDER BY b.created_at DESC 
        LIMIT 1
    ");
        $mainBerita = mysqli_fetch_assoc($latestResult);
        $mainId = $mainBerita['id']; // <-- INI YANG PENTING

        // Pagination
        $perPage = 5;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;

        // Hitung total berita selain berita utama
        $countResult = mysqli_query($conn, "
        SELECT COUNT(*) AS total 
        FROM berita 
        WHERE id != $mainId
    ");
        $totalRows = mysqli_fetch_assoc($countResult)['total'] ?? 0;

        $totalPages = ceil($totalRows / $perPage);

        $offset = ($page - 1) * $perPage;

        // Ambil berita lainnya, EXCLUDE berita utama
        $sql = "
        SELECT b.*, c.name AS category_name 
        FROM berita AS b
        LEFT JOIN berita_categories AS c ON b.category_id = c.id
        WHERE b.id != $mainId
        ORDER BY b.created_at DESC
        LIMIT $offset, $perPage
    ";

        $result = mysqli_query($conn, $sql);
        $beritas = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $this->render('berita/index', [
            'mainBerita' => $mainBerita,
            'beritas' => $beritas,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ]);
    }

    // ===============================
    // Halaman berita per kategori
    // ===============================
    public function kategori($id)
    {
        $conn = $this->getDB();

        // Semua kategori untuk sidebar
        $categoriesResult = mysqli_query($conn, "SELECT id, name FROM berita_categories ORDER BY name ASC");
        $categories = mysqli_fetch_all($categoriesResult, MYSQLI_ASSOC);

        // Ambil kategori berdasarkan id
        $stmt = mysqli_prepare($conn, "SELECT * FROM berita_categories WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $category = mysqli_fetch_assoc($result);

        if (!$category) {
            http_response_code(404);
            echo "Kategori tidak ditemukan";
            exit;
        }

        // Pagination
        $perPage = 5;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $perPage;

        // Hitung total berita
        $countStmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM berita WHERE category_id = ?");
        mysqli_stmt_bind_param($countStmt, 'i', $category['id']);
        mysqli_stmt_execute($countStmt);
        $countResult = mysqli_stmt_get_result($countStmt);
        $totalRows = mysqli_fetch_assoc($countResult)['total'] ?? 0;

        $totalPages = ceil($totalRows / $perPage);

        // Ambil berita
        $sql = "
        SELECT b.*, c.name AS category_name 
        FROM berita AS b
        LEFT JOIN berita_categories AS c ON b.category_id = c.id
        WHERE b.category_id = ?
        ORDER BY b.created_at DESC
        LIMIT ?, ?
    ";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'iii', $category['id'], $offset, $perPage);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $beritas = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $this->render('berita/kategori', [
            'category' => $category,
            'beritas' => $beritas,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'categories' => $categories, // kirim ke sidebar
        ]);
    }

    // ===============================
    // Halaman detail berita
    // ===============================
    public function show($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            http_response_code(404);
            echo "Berita tidak ditemukan.";
            return;
        }

        $this->render('berita/detail', [
            'berita' => $berita,
        ]);
    }

    // ===============================
    // Helper koneksi DB (bisa pindah ke BaseController juga)
    // ===============================
    protected function getDB()
    {
        include __DIR__ . "/../../app/config/database.php";
        return $db;
    }
}
