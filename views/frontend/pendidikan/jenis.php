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
</style>

<!-- Konten Utama Halaman -->
<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">
    <!-- Judul -->
    <h1 class="text-4xl font-extrabold text-center text-green-main dark:text-green-accent mb-8">
        <?= htmlspecialchars($jenis['nama_jenis'] ?? '-') ?>
    </h1>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8 mb-10">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-green-main dark:text-green-accent mb-6">
            Daftar Lembaga <?= htmlspecialchars($jenis['nama_jenis']) ?>
        </h2>

        <?php if (!empty($lembagas)): ?>
            <div class="overflow-x-auto rounded-lg shadow-md border dark:border-gray-700">
                <table class="w-full text-left text-sm text-gray-700 dark:text-gray-300">
                    <thead class="text-xs text-gray-900 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama Lembaga</th>
                            <th scope="col" class="px-6 py-3">Alamat</th>
                            <th scope="col" class="px-6 py-3">Kota/Kab.</th>
                            <th scope="col" class="px-6 py-3">CP</th>
                            <th scope="col" class="px-6 py-3">Website</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lembagas as $index => $l): ?>
                            <tr
                                class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4"><?= $index + 1 ?></td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <?= htmlspecialchars($l['nama_lembaga']) ?>
                                </td>
                                <td class="px-6 py-4"><?= htmlspecialchars($l['alamat']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($l['kota']) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($l['kontak'] ?? '-') ?></td>
                                <td class="px-6 py-4">
                                    <?php if (!empty($l['website'])): ?>
                                        <a href="<?= htmlspecialchars($l['website']) ?>" target="_blank"
                                            class="text-green-accent hover:underline">
                                            <?= htmlspecialchars(parse_url($l['website'], PHP_URL_HOST) ?? $l['website']) ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500 dark:text-gray-400 py-6">
                Belum ada lembaga yang terdaftar untuk jenis pendidikan ini.
            </p>
        <?php endif; ?>
    </div>

    <div class="text-center mt-6">
        <a href="/persyadha.org/pendidikan"
            class="inline-block px-6 py-3 bg-green-main text-white rounded-xl hover:bg-green-accent transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Pendidikan
        </a>
    </div>

</main>