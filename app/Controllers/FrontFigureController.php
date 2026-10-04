<?php

namespace App\Controllers;

use App\Models\Figure;
use App\Models\Gallery;
use App\Models\Book;

class FrontFigureController extends BaseController
{
    /**
     * Halaman Daftar Tokoh dengan Pagination
     * URL: /figures
     */
    public function index()
{
    // Ambil semua data TANPA pagination
    $figures = Figure::all();

    return $this->render('figures/index', [
        'figures' => $figures
    ]);
}


    /**
     * Halaman Detail Tokoh
     * URL: /figures/{slug}
     */
    public function detail($slug)
    {
        $figureModel = new Figure();
        $figure = $figureModel->findBySlug($slug);

        if (!$figure) {
            echo "Figure tidak ditemukan.";
            return;
        }

        return $this->render('figures/detail', compact('figure'));
    }


    /**
     * Tampilkan tokoh berdasarkan nama/kategori
     * URL contoh:
     * /figures/abi-ihya
     * /figures/abuya
     */
    public function byName($name)
    {
        // jadikan nama lebih rapi
        $name = str_replace('-', ' ', $name);

        $all = Figure::all();

        $figures = array_filter($all, function ($f) use ($name) {
            return strtolower($f['name']) === strtolower($name);
        });

        return $this->render('figures/list-by-name', compact('figures', 'name'));
    }

     public function books($slug)
    {
        $figure = Figure::findBySlug($slug);

        if (!$figure) {
            die("Figure tidak ditemukan.");
        }

        $books = Book::findByFigureId($figure['id']);

        return $this->render('figures/books', [
            'figure' => $figure,
            'books'  => $books
        ]);
    }

    // ===== HALAMAN GALERI =====
    public function gallery($slug)
    {
        $figure = Figure::findBySlug($slug);

        if (!$figure) {
            die("Figure tidak ditemukan.");
        }

        $galleries = Gallery::findByFigureId($figure['id']);

        return $this->render('figures/gallery', [
            'figure'    => $figure,
            'galleries' => $galleries
        ]);
    }
}
