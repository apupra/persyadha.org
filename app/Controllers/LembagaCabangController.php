<?php
namespace App\Controllers;

use App\Models\LembagaCabang;
use App\Middleware\RoleMiddleware;

class LembagaCabangController
{
    private $uploadDir;

    public function __construct()
    {
        // Pastikan folder upload tersedia
        $this->uploadDir = __DIR__ . '/../../public/uploads/cabang/';
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

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

    // ============================================================
    // TAMPILKAN SEMUA DATA
    // ============================================================
    public function index()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $data = LembagaCabang::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        include __DIR__ . '/../../views/admin/lembaga_cabang/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ============================================================
    // SIMPAN DATA BARU
    // ============================================================
    public function simpan()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $nama = $_POST['nama_cabang'] ?? '';
        $kota = $_POST['kota'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $telepon = $_POST['telepon'] ?? '';
        $email = $_POST['email'] ?? '';
        $website = $_POST['website'] ?? '';
        $logo = null;

        // === Validasi utama ===
        if (empty($nama)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Nama cabang wajib diisi!'
            ];
            header("Location: /persyadha.org/manjadmin/lembaga-cabang");
            exit;
        }

        // === Upload logo (opsional) ===
        if (!empty($_FILES['logo']['name'])) {
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $filename = 'logo_' . time() . '.' . $ext;
            $targetPath = $this->uploadDir . $filename;

            if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath)) {
                $logo = $filename;
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal mengunggah logo!'
                ];
                header("Location: /persyadha.org/manjadmin/lembaga-cabang");
                exit;
            }
        }

        // === Simpan ke database ===
        $data = [
            'nama_cabang' => $nama,
            'kota' => $kota,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'email' => $email,
            'website' => $website,
            'logo' => $logo
        ];

        $simpan = LembagaCabang::create($data);

        $_SESSION['flash'] = [
            'type' => $simpan ? 'success' : 'error',
            'message' => $simpan
                ? 'Data cabang berhasil ditambahkan!'
                : 'Gagal menambahkan data.'
        ];

        header("Location: /persyadha.org/manjadmin/lembaga-cabang");
        exit;
    }

    // ============================================================
    // UPDATE DATA
    // ============================================================
    public function update($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $nama = $_POST['nama_cabang'] ?? '';
        $kota = $_POST['kota'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $telepon = $_POST['telepon'] ?? '';
        $email = $_POST['email'] ?? '';
        $website = $_POST['website'] ?? '';
        $logo = $_POST['logo_lama'] ?? null;

        // === Jika upload logo baru ===
        if (!empty($_FILES['logo']['name'])) {
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $filename = 'logo_' . time() . '.' . $ext;
            $targetPath = $this->uploadDir . $filename;

            if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetPath)) {
                // Hapus logo lama
                if ($logo && file_exists($this->uploadDir . $logo)) {
                    unlink($this->uploadDir . $logo);
                }
                $logo = $filename;
            }
        }

        $data = [
            'nama_cabang' => $nama,
            'kota' => $kota,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'email' => $email,
            'website' => $website,
            'logo' => $logo
        ];

        $update = LembagaCabang::update($id, $data);

        $_SESSION['flash'] = [
            'type' => $update ? 'success' : 'error',
            'message' => $update
                ? 'Data cabang berhasil diperbarui!'
                : 'Gagal memperbarui data.'
        ];

        header("Location: /persyadha.org/manjadmin/lembaga-cabang");
        exit;
    }

    // ============================================================
    // HAPUS DATA
    // ============================================================
    public function hapus($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        header('Content-Type: application/json');

        $item = LembagaCabang::find($id);

        // Hapus file logo jika ada
        if ($item && !empty($item['logo']) && file_exists($this->uploadDir . $item['logo'])) {
            unlink($this->uploadDir . $item['logo']);
        }

        $hapus = LembagaCabang::delete($id);

        echo json_encode([
            'success' => (bool) $hapus,
            'message' => $hapus
                ? 'Data cabang berhasil dihapus!'
                : 'Gagal menghapus data.'
        ]);
    }
}
