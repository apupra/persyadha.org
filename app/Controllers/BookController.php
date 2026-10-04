<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Figure;
use App\Middleware\RoleMiddleware;

class BookController
{
    private function authCheck()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }

    // ===========================
    // INDEX - List semua buku
    // ===========================
    public function index()
    {
        $this->authCheck();

        $data = Book::all();
        $figures = Figure::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/books/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // CREATE - Form tambah buku
    // ===========================
    public function create()
    {
        $this->authCheck();

        $figures = Figure::all(); // dropdown figure_id

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/books/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // STORE - Simpan buku baru
    // ===========================
    public function store()
    {
        $this->authCheck();

        $cover = $this->uploadCover();
        if ($cover === false) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Format file cover tidak diperbolehkan.'
            ];
            header("Location: /persyadha.org/manjadmin/book/create");
            exit;
        }

        $data = [
            'figure_id' => $_POST['figure_id'] ?? null,
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'cover' => $cover,
            'year' => $_POST['year'] ?? null,
        ];

        $result = Book::create($data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Buku berhasil ditambahkan!' : 'Gagal menambahkan buku.'
        ];

        header("Location: /persyadha.org/manjadmin/book");
        exit;
    }

    // ===========================
    // EDIT FORM
    // ===========================
    public function edit($id)
    {
        $this->authCheck();

        $book = Book::find($id);
        $figures = Figure::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/books/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // UPDATE - Simpan perubahan
    // ===========================
    public function update($id)
    {
        $this->authCheck();

        $book = Book::find($id);
        if (!$book) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Data tidak ditemukan'];
            header("Location: /persyadha.org/manjadmin/books");
            exit;
        }

        $data = [
            'figure_id' => $_POST['figure_id'] ?? $book['figure_id'],
            'title' => $_POST['title'] ?? $book['title'],
            'description' => $_POST['description'] ?? $book['description'],
            'year' => $_POST['year'] ?? $book['year'],
        ];

        // Cover baru?
        if (!empty($_FILES['cover']['name'])) {
            $newCover = $this->uploadCover();
            if ($newCover === false) {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Format cover tidak valid'];
                header("Location: /persyadha.org/manjadmin/books/edit/$id");
                exit;
            }

            // Hapus file lama
            if (!empty($book['cover'])) {
                $old = __DIR__ . '/../../' . ltrim($book['cover'], '/');
                if (file_exists($old))
                    unlink($old);
            }

            $data['cover'] = $newCover;
        } else {
            $data['cover'] = $book['cover']; // tetap
        }

        $result = Book::update($id, $data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Buku berhasil diperbarui!' : 'Gagal memperbarui buku.'
        ];

        header("Location: /persyadha.org/manjadmin/book");
        exit;
    }

    // ===========================
    // DELETE
    // ===========================
    public function destroy($id)
    {
        $this->authCheck();

        $book = Book::find($id);
        if (!$book) {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan!']);
            exit;
        }

        // hapus cover
        if (!empty($book['cover'])) {
            $path = __DIR__ . '/../../' . ltrim($book['cover'], '/');
            if (file_exists($path))
                unlink($path);
        }

        $deleted = Book::delete($id);

        echo json_encode([
            'success' => $deleted ? true : false,
            'message' => $deleted ? 'Buku berhasil dihapus!' : 'Gagal menghapus buku!'
        ]);
        exit;
    }

    // ===========================
    // SHOW
    // ===========================
    public function show($id)
    {
        $this->authCheck();

        $book = Book::find($id);
        $figure = Figure::find($book['figure_id']);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/books/show.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ===========================
    // UPLOAD COVER
    // ===========================
    private function uploadCover()
    {
        if (!empty($_FILES['cover']['name'])) {

            $targetDir = __DIR__ . '/../../public/uploads/books/';
            if (!is_dir($targetDir))
                mkdir($targetDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES['cover']['name']);
            $targetFile = $targetDir . $fileName;

            $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowedExt))
                return false;

            if (move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)) {
                return '/uploads/books/' . $fileName;
            }
        }

        return null;
    }
}
