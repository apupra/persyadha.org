<?php

namespace App\Controllers;

use App\Models\Berita;
use App\Models\BeritaCategory;
use App\Middleware\RoleMiddleware;

class BeritaController
{
    private function authCheck()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }

    public function index()
    {
        $this->authCheck();

        // Ambil semua berita dan kategori
        $beritas = Berita::all();
        $categories = BeritaCategory::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/berita/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    public function store()
    {
        $this->authCheck();

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $link = $_POST['link'] ?? '';
        $category_id = $_POST['category_id'] ?? null;

        $image = null;
        if (!empty($_FILES['image']['name'])) {
            $targetDir = __DIR__ . '/../../public/uploads/berita/';
            if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = $fileName;
            }
        }

        if ($title && $description && $image && $category_id) {
            Berita::create([
                'title' => $title,
                'description' => $description,
                'image' => $image,
                'link' => $link,
                'category_id' => (int)$category_id
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Berita berhasil ditambahkan!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Semua field wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/berita");
        exit;
    }

    public function update($id)
    {
        $this->authCheck();

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $link = $_POST['link'] ?? '';
        $category_id = $_POST['category_id'] ?? null;
        $image = $_POST['old_image'] ?? '';

        if (!empty($_FILES['image']['name'])) {
            $targetDir = __DIR__ . '/../../public/uploads/berita/';
            if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = $fileName;

                $oldPath = __DIR__ . '/../../public/uploads/berita/' . $_POST['old_image'];
                if (file_exists($oldPath)) unlink($oldPath);
            }
        }

        if ($title && $description && $category_id) {
            Berita::update($id, [
                'title' => $title,
                'description' => $description,
                'image' => $image,
                'link' => $link,
                'category_id' => (int)$category_id
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Berita berhasil diperbarui!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Semua field wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/berita");
        exit;
    }

    public function destroy($id)
    {
        $this->authCheck();
        header('Content-Type: application/json');

        $berita = Berita::find($id);
        if (!$berita) {
            echo json_encode(['success' => false, 'message' => 'Data berita tidak ditemukan!']);
            exit;
        }

        $path = __DIR__ . '/../../public/uploads/berita/' . $berita->image;
        if (file_exists($path)) unlink($path);

        $deleted = Berita::delete($id);
        echo json_encode([
            'success' => $deleted,
            'message' => $deleted ? 'Berita berhasil dihapus!' : 'Gagal menghapus berita!'
        ]);
        exit;
    }
}
