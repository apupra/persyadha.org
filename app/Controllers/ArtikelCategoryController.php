<?php
namespace App\Controllers;

use App\Middleware\RoleMiddleware;
use App\Models\Category;

class ArtikelCategoryController
{
    private function slugify($text)
    {
        // Ubah ke lowercase, ganti spasi dengan "-", hilangkan karakter non-alfanumerik
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
        return trim($text, '-');
    }

    private function authCheck()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }


    // List semua kategori
    public function index()
    {
        RoleMiddleware::onlyAdmin();
        $categories = Category::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/kategori-artikel/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Tampilkan form tambah
    public function create()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();
        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/kategori-artikel/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Simpan data baru
    public function store()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $name = $_POST['name'] ?? '';
        $slug = $_POST['slug'] ?? '';

        if ($name) {
            if (empty($slug)) {
                $slug = $this->slugify($name);
            }

            Category::create([
                'name' => $name,
                'slug' => $slug
            ]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Kategori berhasil ditambahkan!'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Nama kategori wajib diisi.'
            ];
        }

        header("Location: /persyadha.org/manjadmin/kategori-artikel");
        exit;
    }

    // Tampilkan form edit
    public function edit($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();
        $category = Category::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/kategori-artikel/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Update data
    public function update($id)
    {
       // $this->authCheck();
        RoleMiddleware::onlyAdmin();
        $name = $_POST['name'] ?? '';
        $slug = $_POST['slug'] ?? '';

        if ($name) {
            if (empty($slug)) {
                $slug = $this->slugify($name);
            }

            Category::update($id, [
                'name' => $name,
                'slug' => $slug
            ]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Kategori berhasil diperbarui!'
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Nama kategori wajib diisi.'
            ];
        }

        header("Location: /persyadha.org/manjadmin/kategori-artikel");
        exit;
    }

    // Hapus kategori
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            exit;
        }

        header('Content-Type: application/json');

        $deleted = Category::delete($id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => 'Kategori berhasil dihapus']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus kategori']);
        }
        exit;
    }

}
