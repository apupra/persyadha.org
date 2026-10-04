<?php
// Pastikan variabel $category dan $articles tersedia dari controller
// Misalnya: $category = Category::findBySlug($slug); $articles = Artikel::byCategory($category['id']);
?>

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

    .text-green-accent {
        color: var(--accent-green);
    }

    .bg-green-accent {
        background-color: var(--accent-green);
    }
</style>

<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">
    <h1 class="text-4xl font-extrabold text-center text-green-main dark:text-green-accent mb-8">
        Artikel Kategori: <?= htmlspecialchars($category['name'] ?? 'Tidak Diketahui') ?>
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- KIRI: Daftar Kategori -->
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

        <!-- TENGAH: Artikel di Kategori -->
        <section class="md:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
            <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-6">
                Artikel di Kategori <?= htmlspecialchars($category['name'] ?? '-') ?>
            </h2>

            <?php if (!empty($articles)): ?>
                <div class="space-y-6">
                    <?php foreach ($articles as $artikel): ?>
                        <article class="flex flex-col md:flex-row gap-4 border-b pb-4 dark:border-gray-700">
                            <img src="<?= !empty($artikel['poster'])
                                ? '/persyadha.org/public' . htmlspecialchars($artikel['poster'])
                                : 'https://placehold.co/600x400' ?>" alt="<?= htmlspecialchars($artikel['title']) ?>"
                                class="w-full md:w-1/3 aspect-video rounded-xl object-cover">
                            <div class="flex-grow">
                                <span class="text-xs font-semibold uppercase text-green-accent">
                                    <?= htmlspecialchars($category['name'] ?? 'Umum') ?>
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
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500 dark:text-gray-400">Belum ada artikel di kategori ini.</p>
            <?php endif; ?>
        </section>
    </div>
</main>