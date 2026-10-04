<?php

namespace App\Controllers;

use App\Models\Event;
use App\Middleware\RoleMiddleware;

class EventController
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

    // Menampilkan semua event
    public function index()
    {
        RoleMiddleware::onlyAdmin();

        $events = Event::all();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/events/index.php';
        //require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Form tambah event
    public function create()
    {
        RoleMiddleware::onlyAdmin();

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/events/create.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Simpan event baru
    public function store()
    {
        RoleMiddleware::onlyAdmin();
        $poster = $this->uploadPoster();
        if ($poster === false) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Format file poster tidak diperbolehkan.'
            ];
            header('Location: /persyadha.org/manjadmin/events/create');
            exit;
        }

        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'location' => $_POST['location'] ?? '',
            'start_date' => $_POST['start_date'] ?? null,
            'end_date' => $_POST['end_date'] ?? null,
            'start_time' => $_POST['start_time'] ?? null,
            'end_time' => $_POST['end_time'] ?? null,
            'poster' => $poster,
            'link_registration' => $_POST['link_registration'] ?? null,
            'status' => $_POST['status'] ?? 'upcoming',
        ];

        $result = Event::create($data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Event berhasil ditambahkan!' : 'Gagal menambahkan event.'
        ];

        header('Location: /persyadha.org/manjadmin/events');
        exit;
    }

    // Form edit event
    public function edit($id)
    {
        RoleMiddleware::onlyAdmin();
        $event = Event::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/events/edit.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Update event
    public function update($id)
    {
        RoleMiddleware::onlyAdmin();
        $event = Event::find($id);
        if (!$event) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Event tidak ditemukan.'
            ];
            header('Location: /persyadha.org/manjadmin/events');
            exit;
        }

        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'location' => $_POST['location'] ?? '',
            'start_date' => $_POST['start_date'] ?? null,
            'end_date' => $_POST['end_date'] ?? null,
            'start_time' => $_POST['start_time'] ?? null,
            'end_time' => $_POST['end_time'] ?? null,
            'link_registration' => $_POST['link_registration'] ?? null,
            'status' => $_POST['status'] ?? 'upcoming',
        ];

        // Jika upload poster baru
        if (isset($_FILES['poster']) && !empty($_FILES['poster']['name'])) {
            $newPoster = $this->uploadPoster();
            if ($newPoster === false) {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Format file poster tidak diperbolehkan.'
                ];
                header("Location: /persyadha.org/manjadmin/events/edit/$id");
                exit;
            }

            if (!empty($event['poster'])) {
                $oldFile = __DIR__ . '/../../' . ltrim($event['poster'], '/');
                if (file_exists($oldFile))
                    unlink($oldFile);
            }

            $data['poster'] = $newPoster;
        } else {
            $data['poster'] = $event['poster'];
        }

        $result = Event::update($id, $data);

        $_SESSION['flash'] = [
            'type' => $result ? 'success' : 'error',
            'message' => $result ? 'Event berhasil diperbarui!' : 'Gagal memperbarui event.'
        ];

        header('Location: /persyadha.org/manjadmin/events');
        exit;
    }

    // Hapus event (AJAX)
    public function destroy($id)
    {
        RoleMiddleware::onlyAdmin();
        $event = Event::find($id);

        if (!$event) {
            echo json_encode([
                'success' => false,
                'message' => 'Event tidak ditemukan!'
            ]);
            exit;
        }

        // Hapus poster jika ada
        if (!empty($event['poster'])) {
            $filePath = __DIR__ . '/../../' . ltrim($event['poster'], '/');
            if (file_exists($filePath))
                unlink($filePath);
        }

        $deleted = Event::delete($id);

        if ($deleted) {
            echo json_encode([
                'success' => true,
                'message' => 'Event berhasil dihapus!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menghapus event!'
            ]);
        }
        exit;
    }



    // Detail event
    public function show($id)
    {
        //$this->authCheck();
        RoleMiddleware::onlyAdmin();
        $event = Event::find($id);

        require __DIR__ . '/../../views/admin/layouts/header.php';
        require __DIR__ . '/../../views/admin/events/show.php';
        require __DIR__ . '/../../views/admin/layouts/footer.php';
    }

    // Helper upload poster
    private function uploadPoster()
    {
        if (!empty($_FILES['poster']['name'])) {
            $targetDir = __DIR__ . '/../../public/uploads/events/';
            if (!is_dir($targetDir))
                mkdir($targetDir, 0777, true);

            $fileName = time() . '_' . basename($_FILES['poster']['name']);
            $targetFile = $targetDir . $fileName;

            $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowedExt))
                return false;

            if (move_uploaded_file($_FILES['poster']['tmp_name'], $targetFile)) {
                return '/uploads/events/' . $fileName;
            }
        }
        return null;
    }
}
