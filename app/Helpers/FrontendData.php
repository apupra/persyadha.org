<?php
use App\Models\Event;
use App\Models\Artikel;
use App\Models\Category;
use App\Models\Berita;
use App\Models\BeritaCategory;
use App\Models\Video;
use App\Models\Post;
use App\Models\LembagaPendidikan;

if (!function_exists('getFrontendData')) {
    function getFrontendData(): array
    {
        return [
            'events'           => Event::all(),
            'artikels'         => Artikel::latest(4),
            'categories'       => Category::all(),
            'beritaCategories' => BeritaCategory::all(),
            'beritas'          => Berita::latest(5),
            'videos'           => Video::latest(7),
            'posts'            => Post::latest(3),
            'lembagas'         => LembagaPendidikan::all(),
        ];
    }
}
