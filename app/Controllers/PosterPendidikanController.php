<?php
namespace App\Controllers;

use App\Models\PosterPendidikan;
use App\Middleware\RoleMiddleware;

class PosterPendidikanController
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
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $data = PosterPendidikan::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        include __DIR__ . "/../../views/admin/poster/index.php";
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    public function simpan()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        // Pastikan folder upload ada
        $uploadDir = __DIR__ . '/../../public/uploads/poster/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $judul = $_POST['judul'] ?? '';
        $tautan = $_POST['tautan'] ?? '';
        $aktif = isset($_POST['aktif']) ? 1 : 0;
        $gambar = '';

        // === Proses Upload Gambar ===
        if (!empty($_FILES['gambar']['name'])) {
            $fileName = time() . '_' . basename($_FILES['gambar']['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
                $gambar = $fileName;
            } else {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal mengupload gambar!'];
                header("Location: /persyadha.org/admin/poster-pendidikan");
                exit;
            }
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gambar wajib diunggah!'];
            header("Location: /persyadha.org/manjadmin/poster-pendidikan");
            exit;
        }

        // Simpan ke database
        $data = [
            'gambar' => $gambar,
            'judul' => $judul,
            'tautan' => $tautan,
            'aktif' => $aktif
        ];

        $simpan = PosterPendidikan::create($data);

        $_SESSION['flash'] = [
            'type' => $simpan ? 'success' : 'error',
            'message' => $simpan ? 'Poster berhasil ditambahkan!' : 'Gagal menambahkan poster.'
        ];

        header("Location: /persyadha.org/manjadmin/poster-pendidikan");
        exit;
    }

    public function update($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $uploadDir = __DIR__ . '/../../public/uploads/poster/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $judul = $_POST['judul'] ?? '';
        $tautan = $_POST['tautan'] ?? '';
        $aktif = isset($_POST['aktif']) ? 1 : 0;
        $gambar = $_POST['gambar_lama'] ?? '';

        // Jika user upload gambar baru
        if (!empty($_FILES['gambar']['name'])) {
            $fileName = time() . '_' . basename($_FILES['gambar']['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
                $gambar = $fileName;
            } else {
                $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal mengupload gambar baru!'];
                header("Location: /persyadha.org/manjadmin/poster-pendidikan");
                exit;
            }
        }

        $data = [
            'gambar' => $gambar,
            'judul' => $judul,
            'tautan' => $tautan,
            'aktif' => $aktif
        ];

        $update = PosterPendidikan::update($id, $data);

        $_SESSION['flash'] = [
            'type' => $update ? 'success' : 'error',
            'message' => $update ? 'Poster berhasil diperbarui!' : 'Gagal memperbarui poster.'
        ];

        header("Location: /persyadha.org/manjadmin/poster-pendidikan");
        exit;
    }

    public function hapus($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();
        
        header('Content-Type: application/json');
        $hapus = PosterPendidikan::delete($id);

        echo json_encode([
            'success' => $hapus,
            'message' => $hapus
                ? 'Poster berhasil dihapus!'
                : 'Gagal menghapus poster.'
        ]);
    }

    public function tampilFrontend()
    {
        $data = PosterPendidikan::aktif();
        include __DIR__ . "/../../views/poster/index.php";
    }
}
