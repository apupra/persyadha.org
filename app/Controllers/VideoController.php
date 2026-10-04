<?php
namespace App\Controllers;

use App\Models\Video;
use App\Middleware\RoleMiddleware;

class VideoController
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
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }

    // List semua video
    public function index()
    {
        $this->authCheck();

        $videos = Video::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/videos/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Tampilkan form tambah
    public function create()
    {
        $this->authCheck();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/videos/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Simpan data baru
    public function store()
    {
        $this->authCheck();

        $title = $_POST['title'] ?? '';
        $link = $_POST['link'] ?? '';
        $description = $_POST['description'] ?? '';

        if ($title && $link) {
            Video::create([
                'title' => $title,
                'link' => $link,
                'description' => $description
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Video berhasil ditambahkan!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Judul dan link wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/videos");
        exit;
    }

    // Tampilkan form edit
    public function edit($id)
    {
       $this->authCheck();

        $video = Video::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/videos/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Update data
    public function update($id)
    {
        $this->authCheck();
        
        $title = $_POST['title'] ?? '';
        $link = $_POST['link'] ?? '';
        $description = $_POST['description'] ?? '';

        if ($title && $link) {
            Video::update($id, [
                'title' => $title,
                'link' => $link,
                'description' => $description
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Video berhasil diperbarui!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Judul dan link wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/videos");
        exit;
    }

    // Hapus video
    public function destroy($id)
    {
        $this->authCheck(); // tetap jaga login dulu

        header('Content-Type: application/json'); // penting!

        // Cek apakah data ada
        $post = Video::find($id);
        if (!$post) {
            echo json_encode([
                'success' => false,
                'message' => 'Video tidak ditemukan!'
            ]);
            exit;
        }

        // Hapus data
        $deleted = Video::delete($id);

        if ($deleted) {
            echo json_encode([
                'success' => true,
                'message' => 'Video berhasil dihapus!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus video!'
            ]);
        }
        exit;
    }
}
