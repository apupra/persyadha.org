<?php

namespace App\Controllers;

use App\Models\Figure;
use App\Middleware\RoleMiddleware;

class FigureController
{
    private function slugify($text)
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
        return trim($text, '-');
    }

    private function authCheck()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }

    // ===========================
    // INDEX - Tampilkan semua figure
    // ===========================
    public function index()
    {
       //$this->authCheck();
       RoleMiddleware::onlyAdmin();

        $data = Figure::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/figures/index.php';
    }

    // ===========================
    // CREATE - Form tambah figure
    // ===========================
    public function create()
    {
        $this->authCheck();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/figures/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // STORE - Simpan figure baru
    // ===========================
    public function store()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        // Upload photo
        $photo = $this->uploadPhoto();
        if ($photo === false) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Format file foto tidak diperbolehkan.'
            ];
            header('Location: /persyadha.org/manjadmin/figures/create');
            exit;
        }

        $name  = $_POST['name'] ?? '';
        $slug  = $this->slugify($name);

        $data = [
            'name'       => $name,
            'slug'       => $slug,
            'photo'      => $photo,
            'biography'  => $_POST['biography'] ?? ''
        ];

        $result = Figure::create($data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Profil berhasil ditambahkan!' : 'Gagal menambahkan profil.'
        ];

        header('Location: /persyadha.org/manjadmin/figures');
        exit;
    }

    // ===========================
    // EDIT - Form edit figure
    // ===========================
    public function edit($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $figure = Figure::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/figures/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // UPDATE - Proses update figure
    // ===========================
    public function update($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();
        $figure = Figure::find($id);

        if (!$figure) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data tidak ditemukan.'
            ];
            header('Location: /persyadha.org/manjadmin/figures');
            exit;
        }

        $name = $_POST['name'] ?? '';
        $slug = $this->slugify($name);

        $data = [
            'name'      => $name,
            'slug'      => $slug,
            'biography' => $_POST['biography'] ?? '',
        ];

        // Foto baru?
        if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {

            $newPhoto = $this->uploadPhoto();
            if ($newPhoto === false) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Format file foto tidak diperbolehkan.'
                ];
                header("Location: /persyadha.org/manjadmin/figures/edit/$id");
                exit;
            }

            // Hapus foto lama
            if (!empty($figure['photo'])) {
                $oldFile = __DIR__ . '/../../' . ltrim($figure['photo'], '/');
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $data['photo'] = $newPhoto;
        } else {
            // Gunakan foto lama
            $data['photo'] = $figure['photo'];
        }

        $result = Figure::update($id, $data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Profil berhasil diperbarui!' : 'Gagal memperbarui profil.'
        ];

        header('Location: /persyadha.org/manjadmin/figures');
        exit;
    }

    // ===========================
    // DELETE - Hapus figure
    // ===========================
    public function destroy($id)
    {
       // $this->authCheck();
       RoleMiddleware::onlyAdmin();
        $figure = Figure::find($id);

        if (!$figure) {
            echo json_encode([
                'success' => false,
                'message' => 'Data tidak ditemukan!'
            ]);
            exit;
        }

        // Hapus foto
        if (!empty($figure['photo'])) {
            $filePath = __DIR__ . '/../../' . ltrim($figure['photo'], '/');
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $deleted = Figure::delete($id);

        echo json_encode([
            'success' => $deleted ? true : false,
            'message' => $deleted ? 'Profil berhasil dihapus!' : 'Gagal menghapus profil!'
        ]);
        exit;
    }

    // ===========================
    // SHOW - Detail figure
    // ===========================
    public function show($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();
        $figure = Figure::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/figures/show.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // UPLOAD FOTO
    // ===========================
    private function uploadPhoto()
    {
        if (!empty($_FILES['photo']['name'])) {

            $targetDir = __DIR__ . '/../../public/uploads/figures/';
            if (!is_dir($targetDir))
                mkdir($targetDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES['photo']['name']);
            $targetFile = $targetDir . $fileName;

            $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowedExt))
                return false;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
                return '/uploads/figures/' . $fileName;
            }
        }

        return null;
    }
}
