<?php

namespace App\Controllers;

use App\Models\BeritaCategory;
use App\Middleware\RoleMiddleware;

class BeritaCategoryController
{
    public function __construct()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }

        include __DIR__ . "/../../app/Models/BeritaCategory.php";
    }

    // ====================== INDEX ======================
    public function index()
    {
        RoleMiddleware::onlyAdmin();
        $categories = BeritaCategory::all();
        require __DIR__ . '/../../views/admin/layouts/header.php';
        include __DIR__ . "/../../views/admin/berita_categories/index.php";
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ====================== STORE ======================
    public function store()
    {
        RoleMiddleware::onlyAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');

            if (empty($name)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Nama kategori tidak boleh kosong.'
                ];
                header('Location: /persyadha.org/manjadmin/berita-categories');
                exit;
            }

            $data = ['name' => $name];
            $success = BeritaCategory::create($data);

            $_SESSION['flash'] = [
                'type' => $success ? 'success' : 'error',
                'message' => $success ? 'Kategori berhasil ditambahkan!' : 'Gagal menambahkan kategori.'
            ];

            header('Location: /persyadha.org/manjadmin/berita-categories');
            exit;
        }
    }

    // ====================== UPDATE ======================
    public function update($id)
    {
        RoleMiddleware::onlyAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');

            if (empty($name)) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Nama kategori tidak boleh kosong.'
                ];
                header('Location: /persyadha.org/manjadmin/berita-categories');
                exit;
            }

            $data = ['name' => $name];
            $success = BeritaCategory::update($id, $data);

            $_SESSION['flash'] = [
                'type' => $success ? 'success' : 'error',
                'message' => $success ? 'Kategori berhasil diperbarui!' : 'Gagal memperbarui kategori.'
            ];

            header('Location: /persyadha.org/manjadmin/berita-categories');
            exit;
        }
    }

    // ====================== DELETE ======================
    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $success = BeritaCategory::delete($id);

            // Jika request dari AJAX
            if (
                isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
            ) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => $success,
                    'message' => $success ? 'Kategori berhasil dihapus!' : 'Gagal menghapus kategori.'
                ]);
                exit;
            }

            // Jika request biasa
            $_SESSION['flash'] = [
                'type' => $success ? 'success' : 'error',
                'message' => $success ? 'Kategori berhasil dihapus!' : 'Gagal menghapus kategori.'
            ];

            header('Location: /persyadha.org/manjadmin/berita-categories');
            exit;
        }
    }
}
