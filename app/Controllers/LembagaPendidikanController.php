<?php
namespace App\Controllers;

use App\Models\LembagaPendidikan;
use App\Middleware\RoleMiddleware;

class LembagaPendidikanController
{
    private $uploadDir;

    public function __construct()
    {
        // Pastikan folder upload tersedia
        $this->uploadDir = __DIR__ . '/../../public/uploads/poster/';
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

        $data = LembagaPendidikan::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        include __DIR__ . '/../../views/admin/lembaga/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ============================================================
    // SIMPAN DATA BARU
    // ============================================================
    public function simpan()
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $nama = $_POST['nama_lembaga'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $kota = $_POST['kota'] ?? '';
        $jenis = $_POST['jenis_pendidikan_id'] ?? null;
        $jenjang = $_POST['jenjang'] ?? '';
        $kontak = $_POST['kontak'] ?? '';
        $website = $_POST['website'] ?? '';
        $aktif = isset($_POST['aktif']) ? 1 : 0;
        $gambar = null;

        // === Validasi utama ===
        if (empty($nama)) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Nama lembaga wajib diisi!'
            ];
            header("Location: /persyadha.org/manjadmin/lembaga-pendidikan");
            exit;
        }

        // === Upload gambar (opsional) ===
        if (!empty($_FILES['gambar']['name'])) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $filename = 'poster_' . time() . '.' . $ext;
            $targetPath = $this->uploadDir . $filename;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
                $gambar = $filename;
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Gagal mengunggah gambar!'
                ];
                header("Location: /persyadha.org/manjadmin/lembaga-pendidikan");
                exit;
            }
        }

        // === Simpan ke database ===
        $data = [
            'nama_lembaga' => $nama,
            'alamat' => $alamat,
            'kota' => $kota,
            'jenis_pendidikan_id' => $jenis,
            'jenjang' => $jenjang,
            'kontak' => $kontak,
            'website' => $website,
            'aktif' => $aktif,
            'gambar' => $gambar
        ];

        $simpan = LembagaPendidikan::create($data);

        $_SESSION['flash'] = [
            'type' => $simpan ? 'success' : 'error',
            'message' => $simpan
                ? 'Data lembaga pendidikan berhasil ditambahkan!'
                : 'Gagal menambahkan data.'
        ];

        header("Location: /persyadha.org/manjadmin/lembaga-pendidikan");
        exit;
    }

    // ============================================================
    // UPDATE DATA
    // ============================================================
    public function update($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();

        $nama = $_POST['nama_lembaga'] ?? '';
        $alamat = $_POST['alamat'] ?? '';
        $kota = $_POST['kota'] ?? '';
        $jenis = $_POST['jenis_pendidikan_id'] ?? null;
        $jenjang = $_POST['jenjang'] ?? '';
        $kontak = $_POST['kontak'] ?? '';
        $website = $_POST['website'] ?? '';
        $aktif = isset($_POST['aktif']) ? 1 : 0;
        $gambar = $_POST['gambar_lama'] ?? null;

        // === Jika upload gambar baru ===
        if (!empty($_FILES['gambar']['name'])) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $filename = 'poster_' . time() . '.' . $ext;
            $targetPath = $this->uploadDir . $filename;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
                // Hapus gambar lama
                if ($gambar && file_exists($this->uploadDir . $gambar)) {
                    unlink($this->uploadDir . $gambar);
                }
                $gambar = $filename;
            }
        }

        $data = [
            'nama_lembaga' => $nama,
            'alamat' => $alamat,
            'kota' => $kota,
            'jenis_pendidikan_id' => $jenis,
            'jenjang' => $jenjang,
            'kontak' => $kontak,
            'website' => $website,
            'aktif' => $aktif,
            'gambar' => $gambar
        ];

        $update = LembagaPendidikan::update($id, $data);

        $_SESSION['flash'] = [
            'type' => $update ? 'success' : 'error',
            'message' => $update
                ? 'Data lembaga pendidikan berhasil diperbarui!'
                : 'Gagal memperbarui data.'
        ];

        header("Location: /persyadha.org/manjadmin/lembaga-pendidikan");
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

        $item = LembagaPendidikan::find($id);

        // Hapus file gambar jika ada
        if ($item && !empty($item['gambar']) && file_exists($this->uploadDir . $item['gambar'])) {
            unlink($this->uploadDir . $item['gambar']);
        }

        $hapus = LembagaPendidikan::delete($id);

        echo json_encode([
            'success' => (bool) $hapus,
            'message' => $hapus
                ? 'Data lembaga pendidikan berhasil dihapus!'
                : 'Gagal menghapus data.'
        ]);
    }
}
