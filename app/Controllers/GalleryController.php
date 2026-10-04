<?php

namespace App\Controllers;

use App\Models\Gallery;
use App\Models\Figure;
use App\Middleware\RoleMiddleware;

class GalleryController
{
    private function authCheck()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }

    // ===========================
    // INDEX
    // ===========================
    public function index()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $data = Gallery::all();
        $figures = Figure::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/gallery/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // CREATE FORM
    // ===========================
    public function create()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $figures = Figure::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/gallery/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // STORE
    // ===========================
    public function store()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $image = $this->uploadImage();
        if ($image === false) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Format file tidak diperbolehkan.'];
            header("Location: /persyadha.org/manjadmin/gallery/create");
            exit;
        }

        $data = [
            'figure_id'   => $_POST['figure_id'] ?? null,
            'title'       => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'image'       => $image
        ];

        $result = Gallery::create($data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Foto galeri berhasil ditambahkan!' : 'Gagal menambahkan data.'
        ];

        header("Location: /persyadha.org/manjadmin/gallery");
        exit;
    }

    // ===========================
    // EDIT
    // ===========================
    public function edit($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $gallery = Gallery::find($id);
        $figures = Figure::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/gallery/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // UPDATE
    // ===========================
    public function update($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $gallery = Gallery::find($id);
        if (!$gallery) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Data tidak ditemukan'];
            header("Location: /persyadha.org/manjadmin/gallery");
            exit;
        }

        $data = [
            'figure_id'   => $_POST['figure_id'] ?? $gallery['figure_id'],
            'title'       => $_POST['title'] ?? $gallery['title'],
            'description' => $_POST['description'] ?? $gallery['description'],
        ];

        // Jika upload gambar baru
        if (!empty($_FILES['image']['name'])) {
            $newImage = $this->uploadImage();

            if ($newImage === false) {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Format gambar tidak valid'];
                header("Location: /persyadha.org/manjadmin/gallery/edit/$id");
                exit;
            }

            // Hapus gambar lama
            if (!empty($gallery['image'])) {
                $old = __DIR__ . '/../../public' . $gallery['image'];
                if (file_exists($old)) unlink($old);
            }

            $data['image'] = $newImage;
        } else {
            $data['image'] = $gallery['image'];
        }

        $result = Gallery::update($id, $data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Galeri berhasil diperbarui!' : 'Gagal memperbarui data.'
        ];

        header("Location: /persyadha.org/manjadmin/gallery");
        exit;
    }

    // ===========================
    // DELETE
    // ===========================
    public function destroy($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $gallery = Gallery::find($id);
        if (!$gallery) {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan!']);
            exit;
        }

        if (!empty($gallery['image'])) {
            $path = __DIR__ . '/../../public' . $gallery['image'];
            if (file_exists($path)) unlink($path);
        }

        $deleted = Gallery::delete($id);

        echo json_encode([
            'success' => $deleted ? true : false,
            'message' => $deleted ? 'Berhasil menghapus foto!' : 'Gagal menghapus data!'
        ]);
        exit;
    }

    // ===========================
    // SHOW (OPSIONAL)
    // ===========================
    public function show($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $gallery = Gallery::find($id);
        $figure = Figure::find($gallery['figure_id']);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/gallery/show.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // UPLOAD IMAGE FUNCTION
    // ===========================
    private function uploadImage()
    {
        if (!empty($_FILES['image']['name'])) {

            $targetDir = __DIR__ . '/../../public/uploads/gallery/';
            if (!is_dir($targetDir))
                mkdir($targetDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $fileName;

            $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowedExt))
                return false;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                return '/uploads/gallery/' . $fileName;
            }
        }

        return null;
    }
}
