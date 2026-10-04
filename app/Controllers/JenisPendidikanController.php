<?php
namespace App\Controllers;

use App\Models\JenisPendidikan;
use App\Middleware\RoleMiddleware;

class JenisPendidikanController
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

    // Menampilkan daftar semua jenis pendidikan
    public function index()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $data = JenisPendidikan::all();
        require __DIR__ . '/../../views/admin/layouts/header.php';
        include __DIR__ . "/../../views/admin/jenis/index.php";
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Simpan data baru
    public function store()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $nama = $_POST['nama_jenis'] ?? '';
        $keterangan = $_POST['keterangan'] ?? '';

        if (empty($nama)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Nama jenis wajib diisi.'];
            header("Location: /persyadha.org/manjadmin/jenis-pendidikan");
            exit;
        }

        $simpan = JenisPendidikan::create($nama, $keterangan);

        $_SESSION['flash'] = [
            'type' => $simpan ? 'success' : 'error',
            'message' => $simpan ? 'Jenis pendidikan berhasil ditambahkan!' : 'Gagal menambah data.'
        ];
        header("Location: /persyadha.org/manjadmin/jenis-pendidikan");
        exit;
    }

    // Update data
    public function update($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $nama = $_POST['nama_jenis'] ?? '';
        $keterangan = $_POST['keterangan'] ?? '';

        if (empty($nama)) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Nama jenis wajib diisi.'];
            header("Location: /persyadha.org/manjadmin/jenis-pendidikan");
            exit;
        }

        $update = JenisPendidikan::updateData($id, $nama, $keterangan);

        $_SESSION['flash'] = [
            'type' => $update ? 'success' : 'error',
            'message' => $update ? 'Data berhasil diperbarui!' : 'Gagal memperbarui data.'
        ];
        header("Location: /persyadha.org/manjadmin/jenis-pendidikan");
        exit;
    }

    // Hapus data (via AJAX)
    public function destroy($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();
        
        header('Content-Type: application/json');
        $hapus = JenisPendidikan::delete($id);

        if ($hapus) {
            echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus data.']);
        }
        exit;
    }
}
