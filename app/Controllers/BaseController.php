<?php
namespace App\Controllers;

use App\Models\Event;
use App\Models\Artikel;
use App\Models\Category;
use App\Models\Berita;
use App\Models\BeritaCategory;
use App\Models\Video;
use App\Models\Post;
use App\Models\LembagaPendidikan;
use App\Models\LembagaCabang;
use App\Models\JenisPendidikan;


class BaseController
{
    protected array $sharedData = [];

    public function __construct()
    {
        $this->sharedData = [
            'events'           => Event::all(),
            'artikels'         => Artikel::latest(4),
            'categories'       => Category::all(),
            'beritaCategories' => BeritaCategory::all(),
            'beritas'          => Berita::latest(5),
            'videos'           => Video::latest(7),
            'posts'            => Post::latest(3),
            'lembagas'         => LembagaPendidikan::all(),
            'lembaga_cabang'   => LembagaCabang::all(),
            'jenisPendidikan'  => JenisPendidikan::all(),
        ];
    }

    protected function render(string $view, array $data = [])
    {
        extract(array_merge($this->sharedData, $data));
        require __DIR__ . '/../../views/frontend/layouts/header.php';
        require __DIR__ . '/../../views/frontend/' . $view . '.php';
        require __DIR__ . '/../../views/frontend/layouts/footer.php';
    }
}
