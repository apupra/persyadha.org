<main class="pt-28 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">

    <h1 class="text-3xl md:text-5xl font-extrabold text-center text-green-main mb-3 tracking-wide">
        Daftar Kitab: <?= htmlspecialchars($figure['name']) ?>
    </h1>

    <p class="text-center text-gray-600 dark:text-gray-300 text-sm md:text-base max-w-xl mx-auto mb-8">
        Kumpulan kitab yang berkaitan dengan tokoh <strong><?= htmlspecialchars($figure['name']) ?></strong>.
    </p>

    <?php if (empty($books)): ?>
        <p class="text-center text-gray-500 py-6">
            Belum ada kitab untuk tokoh ini.
        </p>
    <?php else: ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            <?php foreach ($books as $book): ?>
                <div class="border rounded overflow-hidden shadow hover:shadow-lg transition">

                    <?php if (!empty($book['cover'])): ?>
                        <img src="/persyadha.org/public/<?= htmlspecialchars($book['cover']) ?>"
                             alt="<?= htmlspecialchars($book['title']) ?>"
                             class="w-full h-56 object-cover">
                    <?php else: ?>
                        <div class="w-full h-56 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-500">Tidak Ada Cover</span>
                        </div>
                    <?php endif; ?>

                    <div class="p-3">
                        <h3 class="font-semibold text-green-main">
                            <?= htmlspecialchars($book['title']) ?>
                        </h3>

                        <?php if (!empty($book['description'])): ?>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                <?= nl2br(htmlspecialchars($book['description'])) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>
</main>
