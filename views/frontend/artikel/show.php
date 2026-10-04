<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">
    <article class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
        <!-- Judul Artikel -->
        <h1 class="text-3xl font-bold text-green-main dark:text-green-accent mb-4">
            <?= htmlspecialchars($artikel['title']) ?>
        </h1>

        <!-- Info Publikasi -->
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
            Dipublikasikan pada <?= date('d M Y', strtotime($artikel['created_at'])) ?>
        </p>

        <!-- Gambar Artikel -->
        <img src="<?= !empty($artikel['poster'])
            ? '/persyadha.org/public' . htmlspecialchars($artikel['poster'])
            : 'https://placehold.co/800x400/E8E8E8/1E4620?text=Artikel' ?>"
            alt="Poster <?= htmlspecialchars($artikel['title']) ?>"
            class="w-full rounded-xl mb-6 object-cover">

        <!-- Konten Artikel -->
        <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
            <?= $artikel['content'] ?>
        </div>
    </article>
</main>
