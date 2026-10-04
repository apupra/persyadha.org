<?php
namespace App\Controllers;

use App\Models\Artikel;
use App\Models\Category;
use App\Middleware\RoleMiddleware;

class ArtikelAdminController
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

    // List semua artikel
    public function index()
    {
        $this->authCheck();

        $artikels = Artikel::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/artikel/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Form tambah artikel
    public function create()
    {
        $this->authCheck();

        $categories = Category::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/artikel/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Simpan artikel baru
    public function store()
    {
        $this->authCheck();

        // Generate slug unik dari judul
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['title'])));

        $data = [
            'title' => $_POST['title'],
            'slug' => $slug,
            'content' => $_POST['content'],
            'author_id' => $_SESSION['admin']['id'],
            'category_id' => $_POST['category_id'] ?? null,
            'poster' => null,
            'status' => $_POST['status'] ?? 'pending'
        ];

        // Upload poster
        if (!empty($_FILES['poster']['tmp_name'])) {
            $filename = time() . '_' . basename($_FILES['poster']['name']); // biar unik
            $target = __DIR__ . '/../../public/uploads/' . $filename;
            move_uploaded_file($_FILES['poster']['tmp_name'], $target);
            $data['poster'] = '/uploads/' . $filename;
        }

        if (Artikel::create($data)) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Artikel berhasil ditambahkan'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal menambahkan artikel'];
        }

        header("Location: /persyadha.org/manjadmin/artikel");
        exit;
    }

    // Detail artikel
    public function show($id)
    {
        $this->authCheck();

        $artikel = Artikel::find($id);

        if (!$artikel) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Artikel tidak ditemukan.'];
            header("Location: /persyadha.org/manjadmin/artikel");
            exit;
        }

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/artikel/show.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Form edit artikel
    public function edit($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $categories = Category::all();
        $artikel = Artikel::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/artikel/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Update artikel
    public function update($id)
    {
        $artikel = Artikel::find($id);

        if (!$artikel) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Artikel tidak ditemukan'];
            header("Location: /persyadha.org/manjadmin/artikel");
            exit;
        }

        $title = !empty($_POST['title']) ? $_POST['title'] : $artikel['title'];
        $content = !empty($_POST['content']) ? $_POST['content'] : $artikel['content'];
        $category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : $artikel['category_id'];
        $status = !empty($_POST['status']) ? $_POST['status'] : $artikel['status'];

        // Kalau judul berubah, update slug juga
        if ($title !== $artikel['title']) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        } else {
            $slug = $artikel['slug'];
        }

        // Upload poster baru kalau ada
        if (!empty($_FILES['poster']['name'])) {
            $filename = time() . '_' . basename($_FILES['poster']['name']);
            $poster = '/uploads/' . $filename;
            move_uploaded_file($_FILES['poster']['tmp_name'], __DIR__ . '/../../public' . $poster);
        } else {
            $poster = $_POST['old_poster'] ?? $artikel['poster'];
        }

        $updated = Artikel::update($id, [
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'author_id' => $artikel['author_id'], // tetap sama
            'category_id' => $category_id,
            'poster' => $poster,
            'status' => $status,
        ]);

        if ($updated) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Artikel berhasil diperbarui'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal memperbarui artikel'];
        }

        header("Location: /persyadha.org/manjadmin/artikel");
        exit;
    }

    // Hapus artikel
    public function destroy($id)
    {
        RoleMiddleware::onlyAdmin();
        $artikel = Artikel::find($id);

        if (!$artikel) {
            echo json_encode(['success' => false, 'message' => 'Artikel tidak ditemukan!']);
            exit;
        }

        if (!empty($artikel['poster'])) {
            $filePath = __DIR__ . '/../../' . ltrim($artikel['poster'], '/');
            if (file_exists($filePath))
                unlink($filePath);
        }

        $deleted = Artikel::delete($id);

        echo json_encode([
            'success' => $deleted,
            'message' => $deleted ? 'Artikel berhasil dihapus!' : 'Gagal menghapus artikel!'
        ]);
        exit;
    }
}
