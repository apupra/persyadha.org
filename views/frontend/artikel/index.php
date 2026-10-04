<style>
    :root {
        --dark-green: #003333;
        --accent-green: #33CCCC;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    .text-green-main {
        color: var(--dark-green);
    }

    .bg-green-main {
        background-color: var(--dark-green);
    }

    .hover\:text-green-accent:hover {
        color: var(--accent-green);
    }

    .text-green-accent {
        color: var(--accent-green);
    }

    .bg-green-accent {
        background-color: var(--accent-green);
    }

    /* Responsif layout */
    @media (min-width: 768px) {
        .main-content-grid {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 1rem;
        }
    }
</style>

<!-- KONTEN UTAMA -->
<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">
    <h1 class="text-4xl font-extrabold text-center text-green-main dark:text-green-accent mb-8">Kumpulan Artikel</h1>

    <div class="main-content-grid">
        <!-- KIRI: Cari & Kategori -->
        <div class="w-full space-y-8">
            <div class="bg-green-main rounded-2xl shadow-xl p-6 sticky top-[100px] text-gray-100">
                <h2 class="text-2xl font-bold text-green-accent mb-4">Cari Artikel</h2>
                <div class="relative mb-6">
                    <input type="text" placeholder="Cari..."
                        class="w-full p-3 rounded-xl border border-green-accent bg-gray-800 text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-accent pr-10">
                    <i class="fas fa-search text-gray-400 absolute right-3 top-1/2 -translate-y-1/2"></i>
                </div>

                <h2 class="text-2xl font-bold text-green-accent mb-4">Kategori</h2>
                <nav class="space-y-2 text-gray-200">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <a href="/persyadha.org/artikel/kategori/<?= htmlspecialchars($cat['slug']) ?>"
                                class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">
                                <?= htmlspecialchars($cat['name']) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-300">Belum ada kategori</p>
                    <?php endif; ?>
                </nav>
            </div>
        </div>

        <!-- TENGAH: Artikel Terbaru + Per Kategori -->
        <div class="w-full space-y-8">
            <!-- Artikel Terbaru -->
            <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-6">
                    Artikel Terbaru
                </h2>

                <div class="space-y-6">

                    <!-- ARTIKEL UTAMA -->
                    <?php if (!empty($artikelUtama)): ?>
                        <div class="flex flex-col items-center text-center gap-4 border-b pb-4 dark:border-gray-700">
                            <img src="<?= !empty($artikelUtama['poster'])
                                ? '/persyadha.org/public' . htmlspecialchars($artikelUtama['poster'])
                                : 'https://placehold.co/600x400' ?>"
                                alt="<?= htmlspecialchars($artikelUtama['title']) ?>"
                                class="w-full aspect-video rounded-xl object-cover">

                            <div class="w-full">
                                <span class="text-xs font-semibold uppercase text-green-accent">
                                    <?= htmlspecialchars($artikelUtama['category_name'] ?? 'Umum') ?>
                                </span>

                                <h3 class="text-xl font-bold mt-1 text-green-main dark:text-green-accent">
                                    <?= htmlspecialchars($artikelUtama['title']) ?>
                                </h3>

                                <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">
                                    <?= htmlspecialchars(substr($artikelUtama['content'], 0, 120)) ?>...
                                </p>

                                <a href="/persyadha.org/artikel/<?= urlencode($artikelUtama['slug']) ?>"
                                    class="text-green-accent text-sm font-medium mt-2 block hover:underline">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- ARTIKEL BERIKUTNYA (pagination) -->
                    <?php if (!empty($artikels)): ?>
                        <?php foreach ($artikels as $artikel): ?>
                            <div class="flex flex-col md:flex-row items-start gap-4 border-b pb-4 dark:border-gray-700">
                                <img src="<?= !empty($artikel['poster'])
                                    ? '/persyadha.org/public' . htmlspecialchars($artikel['poster'])
                                    : 'https://placehold.co/600x400' ?>"
                                    alt="<?= htmlspecialchars($artikel['title']) ?>"
                                    class="w-full md:w-1/3 aspect-video rounded-xl object-cover">

                                <div class="flex-grow w-full">
                                    <span class="text-xs font-semibold uppercase text-green-accent">
                                        <?= htmlspecialchars($artikel['category_name'] ?? 'Umum') ?>
                                    </span>

                                    <h3 class="text-xl font-bold mt-1 text-green-main dark:text-green-accent">
                                        <?= htmlspecialchars($artikel['title']) ?>
                                    </h3>

                                    <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">
                                        <?= htmlspecialchars(substr($artikel['content'], 0, 120)) ?>...
                                    </p>

                                    <a href="/persyadha.org/artikel/<?= urlencode($artikel['slug']) ?>"
                                        class="text-green-accent text-sm font-medium mt-2 block hover:underline">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </section>

            <!-- PAGINATION ARTIKEL TERBARU -->
            <?php if (!empty($totalPages) && $totalPages > 1): ?>
                <nav class="flex justify-center mt-8 space-x-2">

                    <!-- Tombol Prev -->
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>"
                            class="px-4 py-2 bg-green-main text-white rounded-lg hover:bg-green-accent transition">
                            Prev
                        </a>
                    <?php endif; ?>

                    <!-- Nomor Halaman -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>" class="px-4 py-2 rounded-lg 
               <?= $i === $currentPage
                   ? 'bg-green-accent text-white'
                   : 'bg-gray-200 text-green-main hover:bg-green-accent hover:text-white transition' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <!-- Tombol Next -->
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>"
                            class="px-4 py-2 bg-green-main text-white rounded-lg hover:bg-green-accent transition">
                            Next
                        </a>
                    <?php endif; ?>

                </nav>
            <?php endif; ?>


            <!-- Artikel Berdasarkan Kategori -->
            <!-- Artikel Berdasarkan Kategori -->
            <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-6">
                    Artikel Berdasarkan Kategori
                </h2>

                <?php if (!empty($categories)): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($categories as $cat): ?>

                            <div class="group bg-gray-50 dark:bg-gray-700 
                    rounded-2xl shadow-md p-6 transition-all duration-300 
                    hover:shadow-xl hover:-translate-y-1 cursor-pointer border border-gray-200 dark:border-gray-600">

                                <!-- ICON -->
                                <div class="flex items-center justify-center w-14 h-14 
                        rounded-full bg-green-accent/15 group-hover:bg-green-accent/25 
                        transition-all duration-300 mb-4">
                                    <i class="fas fa-folder-open text-green-accent text-2xl"></i>
                                </div>

                                <!-- Kategori -->
                                <h3 class="text-xl font-bold text-green-main dark:text-green-accent mb-1">
                                    <?= htmlspecialchars($cat['name']) ?>
                                </h3>

                                <!-- Jumlah artikel -->
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                                    <?= htmlspecialchars($cat['articles_count'] ?? 0) ?> Artikel tersedia
                                </p>

                                <!-- Button -->
                                <a href="/persyadha.org/artikel/kategori/<?= htmlspecialchars($cat['slug']) ?>" class="inline-flex items-center text-green-accent font-medium text-sm 
                        hover:underline transition">
                                    Lihat Artikel
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>

                            </div>

                        <?php endforeach; ?>
                    </div>

                <?php else: ?>
                    <p class="text-gray-500 dark:text-gray-400">Belum ada kategori dengan artikel.</p>
                <?php endif; ?>
            </section>

        </div>

        <!-- KANAN: Populer -->
        <div class="w-full space-y-8">
            <!-- Terpopuler Hari Ini -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 sticky top-[100px] space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-4">Terpopuler Hari Ini</h2>
                    <?php if (!empty($popularToday)): ?>
                        <?php foreach ($popularToday as $artikel): ?>
                            <div class="flex items-start gap-3 border-b pb-3 dark:border-gray-700">
                                <img src="<?= !empty($artikel['poster'])
                                    ? '/persyadha.org/public' . htmlspecialchars($artikel['poster'])
                                    : 'https://placehold.co/100x80' ?>" class="w-20 h-16 object-cover rounded-md"
                                    alt="<?= htmlspecialchars($artikel['title']) ?>">
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">
                                        <a href="/persyadha.org/artikel/<?= htmlspecialchars($artikel['slug']) ?>"
                                            class="hover:underline">
                                            <?= htmlspecialchars(mb_strimwidth($artikel['title'], 0, 50, '...')) ?>
                                        </a>
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <?= htmlspecialchars($artikel['views_count'] ?? 0) ?>x dibaca
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada artikel populer hari ini.</p>
                    <?php endif; ?>
                </div>
                <!-- Terpopuler Sepanjang Masa -->
                <div>
                    <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-4">Terpopuler Sepanjang Masa
                    </h2>
                    <?php if (!empty($popularAllTime)): ?>
                        <?php foreach ($popularAllTime as $artikel): ?>
                            <div class="flex items-start gap-3 border-b pb-3 dark:border-gray-700">
                                <img src="<?= !empty($artikel['poster'])
                                    ? '/persyadha.org/public' . htmlspecialchars($artikel['poster'])
                                    : 'https://placehold.co/100x80' ?>" class="w-20 h-16 object-cover rounded-md"
                                    alt="<?= htmlspecialchars($artikel['title']) ?>">
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">
                                        <a href="/persyadha.org/artikel/<?= htmlspecialchars($artikel['slug']) ?>"
                                            class="hover:underline">
                                            <?= htmlspecialchars(mb_strimwidth($artikel['title'], 0, 50, '...')) ?>
                                        </a>
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <?= htmlspecialchars($artikel['views_count'] ?? 0) ?>x dibaca
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada artikel populer.</p>
                    <?php endif; ?>

                </div>

                <!-- Terpopuler Per Kategori -->
                <div>
                    <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-4">Terpopuler Tiap Kategori
                    </h2>
                    <?php if (!empty($popularByCategory)): ?>
                        <?php foreach ($popularByCategory as $category => $articles): ?>
                            <h3 class="text-lg font-semibold mt-4 mb-2 text-green-main dark:text-green-accent">
                                <?= htmlspecialchars($category) ?>
                            </h3>
                            <?php foreach ($articles as $artikel): ?>
                                <div class="flex items-start gap-3 border-b pb-3 dark:border-gray-700">
                                    <img src="<?= !empty($artikel['poster'])
                                        ? '/persyadha.org/public' . htmlspecialchars($artikel['poster'])
                                        : 'https://placehold.co/100x80' ?>" class="w-20 h-16 object-cover rounded-md"
                                        alt="<?= htmlspecialchars($artikel['title']) ?>">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-semibold text-green-main dark:text-green-accent">
                                            <a href="/persyadha.org/artikel/<?= htmlspecialchars($artikel['slug']) ?>"
                                                class="hover:underline">
                                                <?= htmlspecialchars(mb_strimwidth($artikel['title'], 0, 50, '...')) ?>
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <?= htmlspecialchars($artikel['views_count'] ?? 0) ?>x dibaca
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada artikel populer per kategori.</p>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</main>