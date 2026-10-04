<?php
namespace App\Controllers;

use App\Models\Profile;
use App\Models\ProfileMedia;
use App\Middleware\RoleMiddleware;

class ProfileMediaController
{
    private function authCheck()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }

    // Tampilkan semua media profil
    public function index()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $media = ProfileMedia::all();
        $profiles = Profile::all(); // agar bisa tampilkan nama profil terkait

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/profile-media/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Form tambah media
    public function create()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $profiles = Profile::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/profile-media/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Simpan data baru
    public function store()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $data = [
            'profile_id' => $_POST['profile_id'] ?? null,
            'type'       => $_POST['type'] ?? '',
            'title'      => $_POST['title'] ?? '',
            'url'        => $_POST['url'] ?? '',
            'thumbnail'  => $_FILES['thumbnail']['name'] ?? ''
        ];

        // Upload file thumbnail jika ada
        $uploadDir = __DIR__ . '/../../public/uploads/profile_media/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!empty($_FILES['thumbnail']['name'])) {
            $filePath = $uploadDir . basename($_FILES['thumbnail']['name']);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $filePath);
        }

        if ($data['profile_id'] && $data['type'] && $data['title']) {
            ProfileMedia::create($data);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Media profil berhasil ditambahkan!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Semua field wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/profile-media");
        exit;
    }

    // Form edit media
    public function edit($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $media = ProfileMedia::find($id);
        $profiles = Profile::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/profile-media/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Update media
    public function update($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $data = [
            'profile_id' => $_POST['profile_id'] ?? null,
            'type'       => $_POST['type'] ?? '',
            'title'      => $_POST['title'] ?? '',
            'url'        => $_POST['url'] ?? '',
            'thumbnail'  => $_POST['old_thumbnail'] ?? ''
        ];

        // Upload thumbnail baru jika ada
        $uploadDir = __DIR__ . '/../../public/uploads/profile_media/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!empty($_FILES['thumbnail']['name'])) {
            $filePath = $uploadDir . basename($_FILES['thumbnail']['name']);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $filePath);
            $data['thumbnail'] = $_FILES['thumbnail']['name'];
        }

        if ($data['profile_id'] && $data['type'] && $data['title']) {
            ProfileMedia::update($id, $data);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Media profil berhasil diperbarui!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Semua field wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/profile-media");
        exit;
    }

    // 🗑️ Hapus media
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            exit;
        }

        header('Content-Type: application/json');
        $deleted = ProfileMedia::delete($id);

        echo json_encode([
            'success' => (bool)$deleted,
            'message' => $deleted ? 'Media profil berhasil dihapus' : 'Gagal menghapus media profil'
        ]);
        exit;
    }
}
