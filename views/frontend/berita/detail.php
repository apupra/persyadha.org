<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">
    <article class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
        <h1 class="text-3xl font-bold text-green-main dark:text-green-accent mb-4">
            <?= htmlspecialchars($berita->title) ?>
        </h1>
        <p class="text-sm text-gray-500 mb-6">
            Kategori: <?= htmlspecialchars($berita->category_name ?? 'Umum') ?>
        </p>
        <img src="<?= !empty($berita->image)
            ? '/persyadha.org/public/uploads/berita/' . htmlspecialchars($berita->image)
            : 'https://placehold.co/800x400' ?>"
            alt="<?= htmlspecialchars($berita->title) ?>"
            class="w-full rounded-xl mb-6 object-cover">
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
            <?= nl2br(htmlspecialchars($berita->description)) ?>
        </p>
    </article>
</main>
