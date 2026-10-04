<?php
namespace App\Controllers;

use App\Models\Artikel;
use App\Models\Category;
use App\Models\Event;
use App\Models\LembagaPendidikan;
use App\Models\PosterPendidikan;
use App\Models\JenisPendidikan;

class PendidikanController extends BaseController
{
    public function index()
    {
        $limit = 5; // jumlah data per halaman
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // === Ambil data filter dari GET (jika ada) ===
        $city = $_GET['kota'] ?? '';
        $type = $_GET['jenis'] ?? '';

        // === Ambil daftar dropdown dinamis ===
        $cities = LembagaPendidikan::getCities();   // dari kolom `kota`
        $types = JenisPendidikan::all();            // dari tabel `jenis_pendidikan`

        // === Ambil data lembaga berdasarkan filter ===
        if (!empty($city) || !empty($type)) {
            // Total data sesuai filter
            $totalFiltered = LembagaPendidikan::countFiltered($city, $type);

            // Data lembaga sesuai filter + paginasi
            $lembagas = LembagaPendidikan::paginateFiltered($limit, $offset, $city, $type);

            $totalPages = ceil($totalFiltered / $limit);

        } else {

            // Total semua data
            $totalData = LembagaPendidikan::total();

            // Data default paginasi tanpa filter
            $lembagas = LembagaPendidikan::paginate($limit, $offset);

            $totalPages = ceil($totalData / $limit);
        }


        // === Poster pendidikan (banner kegiatan atau info pendidikan) ===
        $posters = PosterPendidikan::all(); // bisa ditambah limit: ::latest(5)

        // === Artikel & kategori pendidikan ===
        $artikels = Artikel::latest(4);
        $categories = Category::all();

        // === Jenis & Statistik lembaga pendidikan ===
        $jenisPendidikan = JenisPendidikan::all();
        $stats = LembagaPendidikan::countByJenis();
        $totalLembaga = LembagaPendidikan::total();

        // === Render view melalui BaseController ===
        $this->render('pendidikan/index', compact(
            'lembagas',
            'posters',
            'artikels',
            'categories',
            'jenisPendidikan',
            'cities',
            'types',
            'stats',
            'totalLembaga',
            'totalPages',
            'page',
            'limit',
            'city',   // <-- Tambahkan ini
            'type'    // <-- Tambahkan ini
        ));
    }

    public function byJenis($id)
    {
        // Ambil data jenis pendidikan
        $jenis = JenisPendidikan::find($id);

        // Jika id tidak ada, tampilkan halaman error
        if (!$jenis) {
            http_response_code(404);
            die("Jenis pendidikan tidak ditemukan.");
        }

        // Ambil lembaga sesuai jenis
        $lembagas = LembagaPendidikan::byJenisId($id);

        // Data tambahan untuk sidebar, header, statistik
        $categories = Category::all();
        $artikels = Artikel::latest(4);
        $jenisPendidikan = JenisPendidikan::all();
        $stats = LembagaPendidikan::countByJenis();
        $totalLembaga = LembagaPendidikan::total();

        // Render view
        $this->render('pendidikan/jenis', compact(
            'lembagas',
            'jenis',
            'categories',
            'artikels',
            'jenisPendidikan',
            'stats',
            'totalLembaga'
        ));
    }



}
