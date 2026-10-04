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

    @media (min-width: 768px) {
        .main-content-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 1rem;
        }
    }
</style>

<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">
    <h1 class="text-4xl font-extrabold text-center text-green-main dark:text-green-accent mb-8">
        Kategori: <?= htmlspecialchars($category['name']) ?>
    </h1>

    <div class="main-content-grid">
        <!-- KIRI: Sidebar Kategori -->
        <div class="w-full space-y-8">
            <div class="bg-green-main rounded-2xl shadow-xl p-6 sticky top-[100px] text-gray-100">
                <h2 class="text-2xl font-bold text-green-accent mb-4">Cari Berita</h2>
                <div class="relative mb-6">
                    <input type="text" placeholder="Cari..."
                        class="w-full p-3 rounded-xl border border-green-accent bg-gray-800 text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-accent pr-10">
                    <i class="fas fa-search text-gray-400 absolute right-3 top-1/2 -translate-y-1/2"></i>
                </div>

                <h2 class="text-2xl font-bold text-green-accent mb-4">Kategori</h2>
                <nav class="space-y-2 text-gray-200">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <a href="/persyadha.org/berita/kategori/<?= htmlspecialchars($cat['id']) ?>"
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

        <!-- KANAN: Daftar Berita per Kategori -->
        <section class="w-full space-y-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-6">
                    Berita dalam kategori <span
                        class="text-green-accent"><?= htmlspecialchars($category['name']) ?></span>
                </h2>

                <div class="space-y-6">
                    <?php if (!empty($beritas)): ?>
                        <?php foreach ($beritas as $b): ?>
                            <?php
                            $imagePath = !empty($b['image'])
                                ? '/persyadha.org/public/uploads/berita/' . htmlspecialchars($b['image'])
                                : 'https://placehold.co/600x400';
                            ?>
                            <div class="flex flex-col md:flex-row items-start gap-4 border-b pb-4 dark:border-gray-700">
                                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($b['title']) ?>"
                                    class="w-full md:w-1/3 aspect-video rounded-xl object-cover">

                                <div class="flex-grow">
                                    <span class="text-xs font-semibold uppercase text-green-accent">
                                        <?= htmlspecialchars($b['category_name'] ?? $category['name']) ?>
                                    </span>
                                    <h3 class="text-xl font-bold mt-1 text-green-main dark:text-green-accent">
                                        <?= htmlspecialchars($b['title']) ?>
                                    </h3>
                                    <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">
                                        <?= htmlspecialchars(substr($b['description'], 0, 120)) ?>...
                                    </p>
                                    <a href="/persyadha.org/berita/detail/<?= urlencode($b['id']) ?>"
                                        class="text-green-accent text-sm font-medium mt-2 block hover:underline">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-500 dark:text-gray-400">Belum ada berita untuk kategori ini.</p>
                    <?php endif; ?>
                </div>

                <!-- PAGINATION -->
                <?php if (isset($totalPages) && $totalPages > 1): ?>
                    <div class="flex justify-center mt-6 space-x-2">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?= $i ?>" class="px-3 py-1 border rounded-lg <?= $i == ($page ?? 1)
                                  ? 'bg-green-accent text-white border-green-accent'
                                  : 'border-gray-300 text-gray-700 hover:bg-green-accent hover:text-white' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>