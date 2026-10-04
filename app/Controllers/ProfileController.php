<?php
namespace App\Controllers;

use App\Models\Profile;
use App\Middleware\RoleMiddleware;

class ProfileController
{
    private function authCheck()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }

    // Tampilkan semua data profil
    public function index()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $profiles = Profile::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/profile/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Form tambah profil
    public function create()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/profile/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Simpan data baru
    public function store()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $data = [
            'title' => $_POST['title'] ?? '',
            'subtitle' => $_POST['subtitle'] ?? '',
            'description' => $_POST['description'] ?? '',
            'vision' => $_POST['vision'] ?? '',
            'mission' => $_POST['mission'] ?? '',
            'values' => $_POST['values'] ?? '',
            'leader_message' => $_POST['leader_message'] ?? '',
            'leader_name' => $_POST['leader_name'] ?? '',
            'structure_image' => $_FILES['structure_image']['name'] ?? '',
            'activity_image' => $_FILES['activity_image']['name'] ?? '',
            'profile_video' => $_POST['profile_video'] ?? '' // bisa link youtube
        ];

        $uploadDir = __DIR__ . '/../../public/uploads/profile/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Upload gambar jika ada
        foreach (['structure_image', 'activity_image'] as $field) {
            if (!empty($_FILES[$field]['name'])) {
                $filePath = $uploadDir . basename($_FILES[$field]['name']);
                move_uploaded_file($_FILES[$field]['tmp_name'], $filePath);
            }
        }

        // Upload video hanya jika memang ada file, bukan URL
        if (!empty($_FILES['profile_video']['name'])) {
            $filePath = $uploadDir . basename($_FILES['profile_video']['name']);
            move_uploaded_file($_FILES['profile_video']['tmp_name'], $filePath);
            $data['profile_video'] = $_FILES['profile_video']['name'];
        }

        if ($data['title']) {
            Profile::create($data);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Profil berhasil ditambahkan!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Judul profil wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/profile");
        exit;
    }

    // Form edit profil
    public function edit($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $profile = Profile::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/profile/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Update data profil
    public function update($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $data = [
            'title' => $_POST['title'] ?? '',
            'subtitle' => $_POST['subtitle'] ?? '',
            'description' => $_POST['description'] ?? '',
            'vision' => $_POST['vision'] ?? '',
            'mission' => $_POST['mission'] ?? '',
            'values' => $_POST['values'] ?? '',
            'leader_message' => $_POST['leader_message'] ?? '',
            'leader_name' => $_POST['leader_name'] ?? '',
            'structure_image' => $_POST['old_structure_image'] ?? '',
            'activity_image' => $_POST['old_activity_image'] ?? '',
            'profile_video' => $_POST['profile_video'] ?? $_POST['old_profile_video'] ?? '' // URL atau file lama
        ];

        $uploadDir = __DIR__ . '/../../public/uploads/profile/';
        foreach (['structure_image', 'activity_image', 'profile_video'] as $field) {
            if (!empty($_FILES[$field]['name'])) {
                $filePath = $uploadDir . basename($_FILES[$field]['name']);
                move_uploaded_file($_FILES[$field]['tmp_name'], $filePath);
                $data[$field] = $_FILES[$field]['name'];
            }
        }

        if ($data['title']) {
            Profile::update($id, $data);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Profil berhasil diperbarui!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Judul profil wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/profile");
        exit;
    }

    // 🗑️ Hapus profil
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            exit;
        }

        header('Content-Type: application/json');
        $deleted = Profile::delete($id);

        echo json_encode([
            'success' => (bool) $deleted,
            'message' => $deleted ? 'Profil berhasil dihapus' : 'Gagal menghapus profil'
        ]);
        exit;
    }
}
