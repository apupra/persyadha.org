<?php

namespace App\Controllers;

use App\Models\Download;
use App\Models\Figure;

class FrontDownloadController extends BaseController
{
    // ===========================
    // LIST SEMUA DOWNLOAD DI FRONTEND
    // ===========================
    public function index()
    {
        $typeFilter = $_GET['type'] ?? null;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;

        $limit = 5;

        $allDownloads = Download::all();

        // Filter berdasarkan tipe jika ada
        if ($typeFilter) {
            $allDownloads = array_filter($allDownloads, function ($d) use ($typeFilter) {
                return $d['type'] === $typeFilter;
            });
        }

        $totalItems = count($allDownloads);
        $totalPages = ceil($totalItems / $limit);

        // Slice untuk pagination
        $offset = ($page - 1) * $limit;
        $downloads = array_slice($allDownloads, $offset, $limit);

        $figures = Figure::all();

        return $this->render('downloads/index', [
            'downloads' => $downloads,
            'figures' => $figures,
            'typeFilter' => $typeFilter,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }


    // ===========================
    // DOWNLOAD FILE / DETAIL
    // ===========================
    public function download($id)
    {
        $file = Download::find($id);

        if (!$file) {
            http_response_code(404);
            echo "File tidak ditemukan.";
            exit;
        }

        // Redirect langsung ke Google Drive
        header("Location: " . $file['drive_link']);
        exit;
    }

    // ===========================
    // DOWNLOAD ALL BERDASARKAN TYPE
    // ===========================
    public function downloadAll($type)
    {
        $allFiles = Download::all();
        $files = array_filter($allFiles, function ($f) use ($type) {
            return $f['type'] === $type;
        });

        if (empty($files)) {
            http_response_code(404);
            echo "Tidak ada file untuk tipe {$type}.";
            exit;
        }

        // Redirect ke halaman index dengan filter tipe
        header("Location: /download?type={$type}");
        exit;
    }

    // ===========================
    // DETAIL DOWNLOAD VIEW
    // ===========================
    public function show($id)
    {
        $download = Download::find($id);
        $figure = Figure::find($download['figure_id']);

        return $this->render('downloads/show', [
            'download' => $download,
            'figure' => $figure
        ]);
    }
}
