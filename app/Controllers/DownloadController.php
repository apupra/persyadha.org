<?php

namespace App\Controllers;

use App\Models\Download;
use App\Models\Figure;
use App\Middleware\RoleMiddleware;

class DownloadController
{
    private function authCheck()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }
    }

    // ==========================================
    // INDEX
    // ==========================================
    public function index()
    {
        RoleMiddleware::onlyAdmin();

        $downloads = Download::all();
        $figures = Figure::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/downloads/index.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // ==========================================
    // CREATE FORM
    // ==========================================
    public function create()
    {
        RoleMiddleware::onlyAdmin();

        $figures = Figure::all();

        require __DIR__ . '/../../../views/admin/layouts/header.php';
        require __DIR__ . '/../../../views/admin/downloads/create.php';
        require __DIR__ . '/../../../views/admin/layouts/footer.php';
    }

    // ==========================================
    // STORE
    // ==========================================
    public function store()
    {
        RoleMiddleware::onlyAdmin();

        $data = [
            'figure_id' => $_POST['figure_id'] ?? null,
            'type' => $_POST['type'] ?? '',
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'drive_link' => $_POST['drive_link'] ?? ''
        ];

        $result = Download::create($data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Data download berhasil ditambahkan!' : 'Gagal menambahkan data.'
        ];

        header("Location: /persyadha.org/manjadmin/downloads");
        exit;
    }

    // ==========================================
    // EDIT FORM
    // ==========================================
    public function edit($id)
    {
        RoleMiddleware::onlyAdmin();

        $download = Download::find($id);
        $figures = Figure::all();

        require __DIR__ . '/../../../views/admin/layouts/header.php';
        require __DIR__ . '/../../../views/admin/downloads/edit.php';
        require __DIR__ . '/../../../views/admin/layouts/footer.php';
    }

    // ==========================================
    // UPDATE
    // ==========================================
    public function update($id)
    {
        RoleMiddleware::onlyAdmin();

        $data = [
            'figure_id' => $_POST['figure_id'] ?? null,
            'type' => $_POST['type'] ?? '',
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'drive_link' => $_POST['drive_link'] ?? ''
        ];

        $result = Download::update($id, $data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Data download berhasil diperbarui!' : 'Gagal memperbarui data.'
        ];

        header("Location: /persyadha.org/manjadmin/downloads");
        exit;
    }

    // ==========================================
    // DELETE
    // ==========================================
    public function destroy($id)
    {
        RoleMiddleware::onlyAdmin();

        $deleted = Download::delete($id);

        echo json_encode([
            'success' => $deleted ? true : false,
            'message' => $deleted ? 'Data download berhasil dihapus!' : 'Gagal menghapus data!'
        ]);
        exit;
    }

    // ==========================================
    // SHOW
    // ==========================================
    public function show($id)
    {
        RoleMiddleware::onlyAdmin();

        $download = Download::find($id);

        require __DIR__ . '/../../../views/admin/layouts/header.php';
        require __DIR__ . '/../../../views/admin/downloads/show.php';
        require __DIR__ . '/../../../views/admin/layouts/footer.php';
    }
}
