<!-- Konten Utama Halaman -->
<main class="pt-[100px] md:pt-[70px] pb-12">
    <!-- Bagian Poster Slider - DB Version -->
    <section id="poster-section" class="w-full h-screen relative shadow-lg">
        <!-- Konten Persyarikatan tetap sama -->
        <div id="hero-text-container" class="absolute inset-0 z-10">
            <div class="w-full h-full flex flex-col md:flex-row justify-center items-center text-left text-white px-8 lg:px-24"
                style="background: linear-gradient(to right, rgba(0, 51, 51, 0.9), transparent);">
                <!-- Kolom kiri -->
                <div class="w-full md:w-1/2 flex flex-col justify-center items-start text-center md:text-left">
                    <h1 class="text-3xl md:text-6xl font-extrabold mb-4">
                        Persyarikatan Dakwah <span class="text-green-accent">Al-Haromain</span>
                    </h1>
                    <p class="text-lg md:text-2xl font-light mb-8 max-w-xl mx-auto md:mx-0">
                        Mencetak generasi rabbani yang beriman dan berilmu, siap menjadi pelopor perubahan menuju
                        peradaban Islam yang gemilang.
                    </p>
                    <a href="/persyadha.org/profil"
                        class="inline-block bg-green-accent text-white py-3 px-8 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-900 hover:text-green-main dark:hover:text-green-accent transition-all font-bold">
                        Profil
                    </a>
                </div>

                <!-- Kolom kanan -->
                <div class="w-full md:w-1/2 flex justify-center items-end md:items-center p-4">
                    <div
                        class="relative w-full max-w-[300px] h-[400px] bg-white dark:bg-gray-700 rounded-2xl shadow-xl overflow-hidden p-2">
                        <img src="https://placehold.co/400x500/1E4620/ffffff?text=FOTO+DAKWAH"
                            alt="Foto kegiatan dakwah" class="w-full h-full object-cover rounded-xl">
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontainer utama untuk seluruh tampilan poster -->
        <div class="w-full h-full relative overflow-hidden">
            <div id="poster-container"
                class="poster-wrapper w-full h-full transition-transform duration-500 ease-in-out">

                <!-- Duplikat Poster terakhir (untuk looping mulus) -->
                <?php if (!empty($events)): ?>
                    <div class="poster-item flex items-center justify-center relative">
                        <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/persyadha.org/public<?= htmlspecialchars($event['poster']) . '?v=' . time() ?>"
                            alt="Poster <?= htmlspecialchars(end($events)['title']) ?>" class="w-full h-full object-cover">
                        <div class="absolute bottom-4 left-4 bg-black/50 text-white px-3 py-1 rounded">
                            <?= htmlspecialchars(end($events)['title']) ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Loop poster asli -->
                <?php foreach ($events as $event): ?>
                    <div class="poster-item flex items-center justify-center relative">
                        <?php if (!empty($event['poster'])): ?>
                            <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/persyadha.org/public<?= htmlspecialchars($event['poster']) . '?v=' . time() ?>"
                                alt="Poster <?= htmlspecialchars($event['title']) ?>" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 bg-black/50 text-white px-3 py-1 rounded">
                                <?= htmlspecialchars($event['title']) ?>
                            </div>
                        <?php else: ?>
                            <div class="bg-gray-400 w-full h-full flex items-center justify-center text-white">
                                <span>Tidak ada poster</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <!-- Duplikat Poster pertama (untuk looping mulus) -->
                <?php if (!empty($events)): ?>
                    <div class="poster-item flex items-center justify-center relative">
                        <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/persyadha.org/public<?= htmlspecialchars($event['poster']) . '?v=' . time() ?>"
                            alt="Poster <?= htmlspecialchars(reset($events)['title']) ?>"
                            class="w-full h-full object-cover">
                        <div class="absolute bottom-4 left-4 bg-black/50 text-white px-3 py-1 rounded">
                            <?= htmlspecialchars(reset($events)['title']) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tombol navigasi -->
            <button id="prev-btn"
                class="absolute top-1/2 -translate-y-1/2 left-4 z-20 p-3 sm:p-4 rounded-full bg-gray-800/50 text-white hover:bg-gray-800 dark:bg-gray-600/50 dark:hover:bg-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="next-btn"
                class="absolute top-1/2 -translate-y-1/2 right-4 z-20 p-3 sm:p-4 rounded-full bg-gray-800/50 text-white hover:bg-gray-800 dark:bg-gray-600/50 dark:hover:bg-gray-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Navigasi Dot -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
                <?php foreach ($events as $index => $event): ?>
                    <button
                        class="carousel-dot w-3 h-3 bg-white rounded-full opacity-50 hover:opacity-100 transition-opacity"
                        data-index="<?= $index ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Kontainer logo unit, sekarang berada di bawah slider -->
    <section class="w-full bg-white dark:bg-gray-800 transition-colors duration-500">
        <div
            class="py-6 container mx-auto px-4 lg:px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Logo LAZIS -->
            <a href="#"
                class="flex items-center justify-center space-x-2 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-xl transition-colors">
                <img src="https://placehold.co/100x100/1E4620/ffffff?text=LAZIS" alt="Logo LAZIS"
                    class="w-16 h-16 rounded-full border-2 border-green-main p-1">
                <span class="text-base font-semibold text-gray-800 dark:text-gray-200">LAZIS</span>
            </a>
            <!-- Logo WAKAF -->
            <a href="#"
                class="flex items-center justify-center space-x-2 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-xl transition-colors">
                <img src="https://placehold.co/100x100/1E4620/ffffff?text=WAKAF" alt="Logo WAKAF"
                    class="w-16 h-16 rounded-full border-2 border-green-main p-1">
                <span class="text-base font-semibold text-gray-800 dark:text-gray-200">WAKAF</span>
            </a>
            <!-- Logo TOKO -->
            <a href="#"
                class="flex items-center justify-center space-x-2 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-xl transition-colors">
                <img src="https://placehold.co/100x100/1E4620/ffffff?text=TOKO" alt="Logo TOKO"
                    class="w-16 h-16 rounded-full border-2 border-green-main p-1">
                <span class="text-base font-semibold text-gray-800 dark:text-gray-200">TOKO</span>
            </a>
            <!-- Logo MAJALAH -->
            <a href="#"
                class="flex items-center justify-center space-x-2 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-xl transition-colors">
                <img src="https://placehold.co/100x100/1E4620/ffffff?text=MAJALAH" alt="Logo MAJALAH"
                    class="w-16 h-16 rounded-full border-2 border-green-main p-1">
                <span class="text-base font-semibold text-gray-800 dark:text-gray-200">MAJALAH</span>
            </a>
            <!-- Logo WAKAF UANG -->
            <a href="#"
                class="flex items-center justify-center space-x-2 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-xl transition-colors">
                <img src="https://placehold.co/100x100/1E4620/ffffff?text=WAKAF+UANG" alt="Logo WAKAF UANG"
                    class="w-16 h-16 rounded-full border-2 border-green-main p-1">
                <span class="text-base font-semibold text-gray-800 dark:text-gray-200">WAKAF UANG</span>
            </a>
        </div>
    </section>

    <!-- Bagian Komitmen Organisasi -->
    <section class="container mx-auto px-4 lg:px-6 my-12 text-center">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 border-b-2 border-green-main pb-2">
            Komitmen Kami
        </h2>
        <p class="text-lg text-gray-700 dark:text-gray-300 max-w-4xl mx-auto">
            Kami berkomitmen untuk menjalankan dakwah dengan landasan **Jujur, Ikhlas, dan Semangat**. Setiap langkah
            kami didasari oleh nilai-nilai Al-Qur'an dan Sunnah untuk membangun peradaban Islam yang maju dan berakhlak
            mulia, serta memberikan kontribusi nyata bagi umat dan bangsa.
        </p>
    </section>

    <!-- Bagian Ikon-ikon Unit -->
    <section class="bg-green-main dark:bg-gray-900 py-12 transition-colors duration-500">
        <div class="container mx-auto px-4 lg:px-6">
            <h2 class="text-3xl font-bold text-white mb-6 border-b-2 border-white pb-2 text-center">
                Unit dan Pelayanan Kami
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 text-center">
                <!-- Box Cabang -->
                <a href="#"
                    class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-8 rounded-xl shadow-lg hover:shadow-gray-400/20 transition-all transform hover:scale-105">
                    <div class="text-green-main dark:text-green-accent text-5xl mb-4">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="text-xl font-semibold">Cabang</h3>
                </a>
                <!-- Box Sekolah -->
                <a href="#"
                    class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-8 rounded-xl shadow-lg hover:shadow-gray-400/20 transition-all transform hover:scale-105">
                    <div class="text-green-main dark:text-green-accent text-5xl mb-4">
                        <i class="fas fa-school"></i>
                    </div>
                    <h3 class="text-xl font-semibold">Sekolah</h3>
                </a>
                <!-- Box Pesantren -->
                <a href="#"
                    class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-8 rounded-xl shadow-lg hover:shadow-gray-400/20 transition-all transform hover:scale-105">
                    <div class="text-green-main dark:text-green-accent text-5xl mb-4">
                        <i class="fas fa-mosque"></i>
                    </div>
                    <h3 class="text-xl font-semibold">Pesantren</h3>
                </a>
                <!-- Box Majelis -->
                <a href="#"
                    class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-8 rounded-xl shadow-lg hover:shadow-gray-400/20 transition-all transform hover:scale-105">
                    <div class="text-green-main dark:text-green-accent text-5xl mb-4">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="text-xl font-semibold">Majelis</h3>
                </a>
                <!-- Box Da'i -->
                <a href="#"
                    class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 p-8 rounded-xl shadow-lg hover:shadow-gray-400/20 transition-all transform hover:scale-105">
                    <div class="text-green-main dark:text-green-accent text-5xl mb-4">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="text-xl font-semibold">Da'i</h3>
                </a>
            </div>
        </div>
    </section>

    <!-- Bagian Berita Terbaru -->
    <section class="container mx-auto px-4 lg:px-6 my-12">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 border-b-2 border-green-main pb-2">
            Berita Terbaru
        </h2>

        <?php if (!empty($beritas)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($beritas as $index => $berita): ?>
                    <?php
                    // Ambil kategori berita (jika ada)
                    $categoryName = '-';
                    if (!empty($berita['category_id'])) {
                        foreach ($beritaCategories as $cat) {
                            if ($cat['id'] == $berita['category_id']) {
                                $categoryName = $cat['name'];
                                break;
                            }
                        }
                    }

                    // Tentukan path gambar
                    $imagePath = file_exists(__DIR__ . "/../../public/uploads/berita/{$berita['image']}")
                        ? "/persyadha.org/public/uploads/berita/{$berita['image']}"
                        : (file_exists(__DIR__ . "/../../public/uploads/{$berita['image']}")
                            ? "/persyadha.org/public/upload/{$berita['image']}"
                            : "https://placehold.co/600x400/E8E8E8/1E4620?text=No+Image");
                    ?>

                    <?php if ($index === 0): ?>
                        <!-- Berita Utama -->
                        <div
                            class="bg-white dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden transition-all transform hover:scale-105 col-span-1 md:col-span-2 row-span-2">
                            <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($berita['title']) ?>"
                                class="w-full h-80 object-cover">
                            <div class="p-4">
                                <!-- Kategori -->
                                <?php if ($categoryName && $categoryName !== '-'): ?>
                                    <span
                                        class="inline-block bg-green-main text-white text-xs font-semibold px-3 py-1 rounded-full mb-3">
                                        <?= htmlspecialchars($categoryName) ?>
                                    </span>
                                <?php endif; ?>

                                <h3 class="text-xl md:text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2">
                                    <?= htmlspecialchars($berita['title']) ?>
                                </h3>
                                <p class="text-base text-gray-600 dark:text-gray-300">
                                    <?= htmlspecialchars(mb_strimwidth(strip_tags($berita['description']), 0, 800, '...')) ?>
                                </p>
                                <?php if (!empty($berita['link'])): ?>
                                    <a href="<?= htmlspecialchars($berita['link']) ?>" target="_blank"
                                        class="inline-block mt-3 text-green-main font-semibold hover:underline">
                                        Baca Selengkapnya →
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Berita Lainnya -->
                        <div
                            class="bg-white dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden transition-all transform hover:scale-105">
                            <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($berita['title']) ?>"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <!-- Kategori -->
                                <?php if ($categoryName && $categoryName !== '-'): ?>
                                    <span
                                        class="inline-block bg-green-main text-white text-xs font-semibold px-3 py-1 rounded-full mb-2">
                                        <?= htmlspecialchars($categoryName) ?>
                                    </span>
                                <?php endif; ?>

                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">
                                    <?= htmlspecialchars($berita['title']) ?>
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    <?= htmlspecialchars(mb_strimwidth(strip_tags($berita['description']), 0, 100, '...')) ?>
                                </p>
                                <?php if (!empty($berita['link'])): ?>
                                    <a href="<?= htmlspecialchars($berita['link']) ?>" target="_blank"
                                        class="inline-block mt-2 text-green-main text-sm hover:underline">
                                        Lihat Selengkapnya →
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-600 dark:text-gray-300">Belum ada berita untuk ditampilkan.</p>
        <?php endif; ?>
    </section>

    <!-- Bagian Artikel Terbaru -->
    <section class="bg-green-main dark:bg-gray-900 text-white py-12 transition-colors duration-500">
        <div class="container mx-auto px-4 lg:px-6">
            <h2 class="text-3xl font-bold mb-6 border-b-2 border-white pb-2">
                Artikel Terbaru
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php if (!empty($artikels)): ?>
                    <?php foreach ($artikels as $row): ?>
                        <?php
                        // Gunakan foto author jika ada, default ke placeholder
                        $authorPhoto = !empty($row['author_photo'])
                            ? '/persyadha.org/public' . htmlspecialchars($row['author_photo'])
                            : 'https://placehold.co/40x40/E8E8E8/1E4620?text=A';
                        ?>
                        <div
                            class="bg-white dark:bg-gray-700 rounded-2xl shadow-md overflow-hidden transition-all transform hover:scale-[1.02] hover:shadow-lg">

                            <!-- Gambar Artikel -->
                            <div class="relative">
                                <img src="<?= !empty($row['poster'])
                                    ? '/persyadha.org/public' . htmlspecialchars($row['poster'])
                                    : 'https://placehold.co/600x400/E8E8E8/1E4620?text=Artikel' ?>"
                                    alt="Poster <?= htmlspecialchars($row['title']) ?>" class="w-full h-44 object-cover">
                                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent p-3">
                                    <span class="text-sm text-white font-semibold">
                                        <?= htmlspecialchars($row['category_name'] ?? '-') ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Konten -->
                            <div class="p-5 text-gray-800 dark:text-gray-200 flex flex-col justify-between">
                                <!-- Judul -->
                                <h3
                                    class="text-lg font-bold mb-3 line-clamp-2 hover:text-green-main transition-colors duration-200">
                                    <?= htmlspecialchars(mb_strimwidth($row['title'], 0, 60, '...')) ?>
                                </h3>

                                <!-- Baris kategori & author -->
                                <div
                                    class="flex justify-between items-center mb-3 border-b border-gray-200 dark:border-gray-600 pb-2">
                                    <!-- Author -->
                                    <div class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-300">
                                        <img src="<?= $authorPhoto ?>" alt="Author"
                                            class="w-8 h-8 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                                        <span class="font-medium"><?= htmlspecialchars($row['author_name'] ?? '-') ?></span>
                                    </div>

                                    <?php /* 
                                    <!-- Kategori -->
                                    <div class="flex items-center text-green-600 dark:text-green-300 font-semibold text-sm">
                                        <i class="bi bi-folder-fill mr-1"></i>
                                        <span><?= htmlspecialchars($row['category_name'] ?? '-') ?></span>
                                    </div>
                                    */ ?>
                                </div>

                                <!-- Deskripsi -->
                                <p class="text-sm leading-relaxed mb-3 text-gray-700 dark:text-gray-300">
                                    <?= htmlspecialchars(mb_strimwidth(strip_tags($row['content']), 0, 100, '...')) ?>
                                </p>

                                <!-- Tombol -->
                                <a href="/persyadha.org/artikel/<?= urlencode($row['id']) ?>"
                                    class="inline-block text-green-main dark:text-green-accent font-semibold hover:underline text-sm">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="col-span-4 text-center text-gray-200">Belum ada artikel terbaru.</p>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Bagian Video Terbaru dengan tata letak ubin 3:1 -->
    <section class="container mx-auto px-4 lg:px-6 my-12">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 border-b-2 border-green-main pb-2">
            Video Terbaru
        </h2>

        <?php
        use App\Models\Video;

        // Ambil 7 video terbaru dari database
        $videos = Video::latest(7);

        if (!empty($videos)):
            $leftVideos = array_slice($videos, 0, 4);
            $rightVideos = array_slice($videos, 4, 3);
            ?>
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Bagian Kiri: 4 Video -->
                <div class="w-full md:w-3/4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php foreach ($leftVideos as $video): ?>
                        <div
                            class="bg-white dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden transition-all transform hover:scale-105">
                            <div class="w-full h-48">
                                <?php
                                // Cek apakah link video YouTube atau file lokal
                                if (str_contains($video['link'], 'youtube.com') || str_contains($video['link'], 'youtu.be')):
                                    // Ambil ID video YouTube
                                    preg_match('/(youtu\.be\/|v=)([^&]+)/', $video['link'], $match);
                                    $videoId = $match[2] ?? '';
                                    ?>
                                    <iframe class="w-full h-48"
                                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($videoId); ?>"
                                        frameborder="0" allowfullscreen></iframe>
                                <?php else: ?>
                                    <video class="w-full h-48 object-cover" controls playsinline>
                                        <source src="<?= htmlspecialchars($video['link']) ?>" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">
                                    <?= htmlspecialchars($video['title']) ?>
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    <?= htmlspecialchars(mb_strimwidth($video['description'], 0, 300, '...')) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Bagian Kanan: 3 Video Vertikal -->
                <div class="w-full md:w-1/4 flex flex-col gap-4">
                    <?php foreach ($rightVideos as $video): ?>
                        <div
                            class="bg-white dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden transition-all transform hover:scale-105 flex-1">
                            <div class="w-full h-40">
                                <?php
                                if (str_contains($video['link'], 'youtube.com') || str_contains($video['link'], 'youtu.be')):
                                    preg_match('/(youtu\.be\/|v=)([^&]+)/', $video['link'], $match);
                                    $videoId = $match[2] ?? '';
                                    ?>
                                    <iframe class="w-full h-40"
                                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($videoId); ?>"
                                        frameborder="0" allowfullscreen></iframe>
                                <?php else: ?>
                                    <video class="w-full h-40 object-cover" controls playsinline>
                                        <source src="<?= htmlspecialchars($video['link']) ?>" type="video/mp4">
                                        Browser Anda tidak mendukung tag video.
                                    </video>
                                <?php endif; ?>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">
                                    <?= htmlspecialchars(mb_strimwidth($video['title'], 0, 30, '...')) ?>
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    <?= htmlspecialchars(mb_strimwidth($video['description'], 0, 30, '...')) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500">Belum ada video yang ditambahkan.</p>
        <?php endif; ?>
    </section>

    <!-- Bagian Postingan Terbaru (Podcast, Instagram, Facebook) -->
    <section class="container mx-auto px-4 lg:px-6 my-12">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6 border-b-2 border-green-main pb-2">
            Postingan Terbaru
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <?php
                    // Tentukan ikon dan label berdasarkan kategori
                    switch (strtolower($post['category'])) {
                        case 'podcast':
                            $icon = '<i class="fas fa-podcast"></i>';
                            $label = 'Podcast Terbaru';
                            $cta = 'Dengarkan sekarang';
                            break;
                        case 'instagram':
                            $icon = '<i class="fab fa-instagram"></i>';
                            $label = 'Instagram Terbaru';
                            $cta = 'Lihat postingan';
                            break;
                        case 'facebook':
                            $icon = '<i class="fab fa-facebook-f"></i>';
                            $label = 'Facebook Terbaru';
                            $cta = 'Tonton video';
                            break;
                        case 'youtube':
                            $icon = '<i class="fab fa-youtube"></i>';
                            $label = 'YouTube Terbaru';
                            $cta = 'Tonton sekarang';
                            break;
                        default:
                            $icon = '<i class="fas fa-newspaper"></i>';
                            $label = ucfirst($post['category']);
                            $cta = 'Baca selengkapnya';
                            break;
                    }
                    ?>
                    <div class="bg-gray-200 dark:bg-gray-700 rounded-xl p-6 shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-main text-white text-2xl p-3 rounded-full mr-4">
                                <?= $icon ?>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200"><?= $label ?></h3>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-md">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-1">
                                <?= htmlspecialchars($post['title']) ?>
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                                <?= htmlspecialchars($post['description']) ?>
                            </p>
                            <a href="<?= htmlspecialchars($post['link']) ?>" target="_blank"
                                class="text-green-main dark:text-green-accent font-semibold hover:underline">
                                <?= $cta ?> <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600 dark:text-gray-300">Belum ada postingan terbaru.</p>
            <?php endif; ?>

        </div>
    </section>

</main>