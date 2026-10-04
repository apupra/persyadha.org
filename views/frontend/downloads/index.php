<?php
// pastikan $downloads berisi array dari database
// contoh: $downloads = Download::all(); 
// setiap item memiliki: id, figure_id, type (document/foto/book), title, description, drive_link, created_at

?>

<style>
    :root {
        --dark-green: #003333;
        --accent-green: #33CCCC;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }

    @media (hover: none) and (pointer: coarse) {
        .card-hover {
            transform: none !important;
            box-shadow: none !important;
        }
    }
</style>

<main class="pt-28 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">

    <h1 class="text-3xl md:text-5xl font-extrabold text-center text-green-main mb-3 tracking-wide">
        Downloads
    </h1>

    <p class="text-center text-gray-600 dark:text-gray-300 text-sm md:text-base max-w-xl mx-auto mb-8">
        Kumpulan dokumen, foto, dan buku yang bisa diunduh langsung melalui Google Drive.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">

        <?php if (!empty($downloads)): ?>
            <?php foreach ($downloads as $d): ?>

                <a href="<?= htmlspecialchars($d['drive_link']) ?>" target="_blank"
                    class="block bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden card-hover transition-transform duration-300">

                    <!-- ICON BERDASARKAN TYPE -->
                    <div class="flex items-center justify-center h-40 bg-gray-100 dark:bg-gray-700 text-green-main text-6xl">
                        <?php if ($d['type'] === 'document'): ?>
                            <i class="fas fa-file-alt"></i> <!-- document -->
                        <?php elseif ($d['type'] === 'foto'): ?>
                            <i class="fas fa-image"></i> <!-- foto -->
                        <?php elseif ($d['type'] === 'book'): ?>
                            <i class="fas fa-book"></i> <!-- book -->
                        <?php else: ?>
                            <i class="fas fa-file"></i> <!-- generic file -->
                        <?php endif; ?>
                    </div>

                    <div class="p-5 md:p-6">
                        <span class="text-xs px-2 py-1 bg-green-main text-white rounded uppercase">
                            <?= htmlspecialchars($d['type']) ?>
                        </span>

                        <h2 class="text-lg md:text-xl font-bold text-green-main mt-2 line-clamp-2">
                            <?= htmlspecialchars($d['title']) ?>
                        </h2>

                        <p class="text-gray-600 dark:text-gray-300 mt-2 text-sm line-clamp-3">
                            <?= htmlspecialchars(substr($d['description'], 0, 120)) ?>...
                        </p>

                        <p class="text-sm text-gray-500 mt-3">
                            <?= date('l, d F Y', strtotime($d['created_at'])) ?>
                        </p>
                    </div>
                </a>

            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-gray-500 py-6 col-span-3">Belum ada file download tersedia.</p>
        <?php endif; ?>

    </div>

    <!-- ============================== -->
    <!--       PAGINATION SECTION      -->
    <!-- ============================== -->
    <?php if ($totalPages > 1): ?>
        <div class="flex justify-center items-center gap-2 mt-10">

            <!-- Previous -->
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>"
                    class="px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 hover:bg-gray-100">
                    Previous
                </a>
            <?php endif; ?>

            <!-- Number Buttons -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="px-4 py-2 border rounded-lg 
               <?= $page == $i ? 'bg-green-main text-white' : 'bg-white dark:bg-gray-700 hover:bg-gray-100' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <!-- Next -->
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>"
                    class="px-4 py-2 border rounded-lg bg-white dark:bg-gray-700 hover:bg-gray-100">
                    Next
                </a>
            <?php endif; ?>

        </div>
    <?php endif; ?>

</main>