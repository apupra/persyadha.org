<?php
namespace App\Controllers;

use App\Models\Post;
use App\Middleware\RoleMiddleware;

class PostController
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

    public function index()
    {
        $this->authCheck();
        
        $posts = Post::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/posts/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    public function create()
    {
        $this->authCheck();
        
        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/posts/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    public function store()
    {
        $this->authCheck();
        
        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $link = $_POST['link'] ?? '';
        $description = $_POST['description'] ?? '';

        if ($title && $link && $category) {
            Post::create([
                'title' => $title,
                'category' => $category,
                'link' => $link,
                'description' => $description
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Postingan berhasil ditambahkan!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Judul, kategori, dan link wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/posts");
        exit;
    }

    public function edit($id)
    {
        $this->authCheck();
        
        $post = Post::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/posts/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    public function update($id)
    {
        $this->authCheck();
        
        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $link = $_POST['link'] ?? '';
        $description = $_POST['description'] ?? '';

        if ($title && $link && $category) {
            Post::update($id, [
                'title' => $title,
                'category' => $category,
                'link' => $link,
                'description' => $description
            ]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Postingan berhasil diperbarui!'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Judul, kategori, dan link wajib diisi.'];
        }

        header("Location: /persyadha.org/manjadmin/posts");
        exit;
    }



    public function destroy($id)
    {
        $this->authCheck(); // tetap jaga login dulu

        header('Content-Type: application/json'); // penting!

        // Cek apakah data ada
        $post = Post::find($id);
        if (!$post) {
            echo json_encode([
                'success' => false,
                'message' => 'Postingan tidak ditemukan!'
            ]);
            exit;
        }

        // Hapus data
        $deleted = Post::delete($id);

        if ($deleted) {
            echo json_encode([
                'success' => true,
                'message' => 'Postingan berhasil dihapus!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus postingan!'
            ]);
        }
        exit;
    }

}
