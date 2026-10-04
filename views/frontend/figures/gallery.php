<main class="pt-28 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">

    <h1 class="text-3xl md:text-5xl font-extrabold text-center text-green-main mb-3 tracking-wide">
        Galeri: <?= htmlspecialchars($figure['name']) ?>
    </h1>

    <p class="text-center text-gray-600 dark:text-gray-300 text-sm md:text-base max-w-xl mx-auto mb-8">
        Kumpulan foto terkait tokoh <strong><?= htmlspecialchars($figure['name']) ?></strong>.
    </p>

    <?php if (empty($galleries)): ?>
        <p class="text-center text-gray-500">Belum ada galeri untuk tokoh ini.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            <?php foreach ($galleries as $g): ?>
                <div class="border rounded overflow-hidden shadow hover:shadow-lg transition">

                    <img src="/persyadha.org/public/<?= htmlspecialchars($g['image']) ?>"
                         alt="<?= htmlspecialchars($g['title']) ?>"
                         class="w-full h-56 object-cover">

                    <div class="p-3">
                        <h3 class="font-semibold text-green-main">
                            <?= htmlspecialchars($g['title']) ?>
                        </h3>

                        <?php if (!empty($g['description'])): ?>
                            <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($g['description']) ?></p>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>
</main>
