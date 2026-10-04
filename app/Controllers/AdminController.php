<?php
namespace App\Controllers;

use App\Models\Artikel;
use App\Models\Event;
use App\Models\Video;
use App\Models\Post;
use App\Models\Admin;

use App\Models\Berita;
use App\Models\Book;
use App\Models\Gallery;
use App\Models\Figure;
use App\Models\LembagaPendidikan;
use App\Models\LembagaCabang;

use App\Middleware\RoleMiddleware;

class AdminController
{

    /* ============================================================
       DASHBOARD
    ============================================================ */
    public function dashboard()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }

        // Data Statistik Lama
        $total_artikel = count(Artikel::all());
        $total_event = count(Event::all());
        $total_video = count(Video::all());
        $total_post = count(Post::all());

        // Data Statistik Baru
        $total_berita = count(Berita::all());
        $total_kitab = count(Book::all());
        $total_galeri = count(Gallery::all());
        $total_tokoh = count(Figure::all());
        $total_lembaga_pendidikan = count(LembagaPendidikan::all());
        $total_unit_kerja = count(LembagaCabang::all());

        // Data Lembaga Cabang
        $data_all = LembagaCabang::all();
        usort($data_all, function ($a, $b) {
            return $b['id'] - $a['id'];
        });
        $data = array_slice($data_all, 0, 3);

        // --- DATA EVENT TERBARU ---
        $event_all = Event::all();
        // urutkan dari terbaru (ID terbesar)
        usort($event_all, function ($a, $b) {
            return $b['id'] - $a['id'];
        });
        // ambil 3 event terbaru
        $events = array_slice($event_all, 0, 3);

        // Ambil semua data
        $lp_all = LembagaPendidikan::all();

        // urutkan berdasarkan id terbesar
        usort($lp_all, function ($a, $b) {
            return $b['id'] - $a['id'];
        });

        // ambil 5 data terbaru
        $lembaga_pendidikan_terbaru = array_slice($lp_all, 0, 5);


        // tampilkan data admin
        $users = Admin::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/dashboard.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }



    /* ============================================================
       LIST ADMIN / OPERATOR / PENULIS
    ============================================================ */
    public function userIndex()
    {
        RoleMiddleware::onlyAdmin();

        $users = Admin::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/users/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    /* ============================================================
       CREATE PAGE
    ============================================================ */
    public function userCreatePage()
    {
        RoleMiddleware::onlyAdmin();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/users/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    /* ============================================================
       CREATE PROCESS
    ============================================================ */
    public function userStore()
    {
        RoleMiddleware::onlyAdmin();

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        Admin::create([
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "role" => $role
        ]);

        $_SESSION['flash'] = [
            "type" => "success",
            "message" => "Akun berhasil dibuat!"
        ];

        header("Location: /persyadha.org/manjadmin/users");
        exit;
    }


    /* ============================================================
       EDIT PAGE
    ============================================================ */
    public function userEditPage($id)
    {
        RoleMiddleware::onlyAdmin();

        $user = Admin::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/users/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    /* ============================================================
       UPDATE PROCESS
    ============================================================ */
    public function userUpdate($id)
    {
        RoleMiddleware::onlyAdmin();

        Admin::update($id, [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "role" => $_POST['role']
        ]);

        $_SESSION['flash'] = [
            "type" => "success",
            "message" => "Akun berhasil diperbarui!"
        ];

        header("Location: /persyadha.org/manjadmin/users");
        exit;
    }

    /* ============================================================
       DELETE USER
    ============================================================ */
    public function userDelete($id)
    {
        if (!isset($_SESSION['admin'])) {
            echo json_encode([
                "success" => false,
                "message" => "Unauthorized"
            ]);
            return;
        }

        $delete = Admin::delete($id);

        if ($delete) {
            echo json_encode([
                "success" => true,
                "message" => "Akun berhasil dihapus!"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Gagal menghapus akun!"
            ]);
        }
    }

}
