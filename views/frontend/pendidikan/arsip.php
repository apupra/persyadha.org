<style>
    /* Mendefinisikan warna kustom untuk tema hijau tua dan hijau aksen */
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

    /* Style untuk pop-up dropdown */
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        min-width: 200px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 50;
        border-radius: 0.5rem;
        padding: 0.5rem;
    }

    .dropdown-item a {
        display: block;
        padding: 0.5rem 1rem;
        color: var(--dark-green);
        transition: background-color 0.3s;
    }

    .dropdown-item a:hover {
        background-color: #f0f0f0;
        border-radius: 0.375rem;
    }

    /* Style untuk pop-up tanggal dan waktu */
    .date-time-box,
    .language-box {
        top: 100%;
        right: 0;
        display: none;
    }

    /* Style untuk kotak pencarian */
    .search-box {
        position: absolute;
        top: 100%;
        right: 0;
        width: 320px;
        padding: 1rem;
        background-color: white;
        z-index: 40;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: none;
        /* Default hidden */
        border-radius: 0.75rem;
    }

    @media (max-width: 767px) {
        .search-box {
            width: 100%;
            /* Lebar penuh di perangkat seluler */
            left: 0;
        }
    }

    /* Mengubah warna teks pada mode malam */
    .dark .bg-gray-100 {
        background-color: #1a202c;
    }

    .dark .bg-white {
        background-color: #2d3748;
    }

    .dark .text-gray-800 {
        color: #e2e8e0;
    }

    .dark .text-gray-600 {
        color: #a0aec0;
    }

    .dark .text-gray-700 {
        color: #cbd5e0;
    }

    .dark .bg-gray-200 {
        background-color: #4a5568;
    }

    .dark .border-gray-200 {
        border-color: #4a5568;
    }

    .dark .bg-gray-700 {
        background-color: #4a5568;
    }

    .dark .bg-gray-800 {
        background-color: #2d3748;
    }

    .dark .bg-gray-900 {
        background-color: #1a202c;
    }

    /* CSS kustom untuk slider gambar */
    .slider-container {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slider img {
        width: 100%;
        flex-shrink: 0;
    }

    .slider-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 0.75rem;
        cursor: pointer;
        z-index: 10;
        border-radius: 50%;
        transition: background-color 0.3s;
    }

    .slider-button:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .slider-button.prev {
        left: 1rem;
    }

    .slider-button.next {
        right: 1rem;
    }

    .slider-dots {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.5rem;
    }

    .dot {
        width: 0.75rem;
        height: 0.75rem;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .dot.active {
        background-color: white;
    }

    /* Penyesuaian responsif untuk tata letak utama */
    @media (min-width: 768px) {
        .main-content-grid {
            display: grid;
            grid-template-columns: 1fr 3fr;
            gap: 2rem;
        }
    }
</style>

<!-- Konten Utama Halaman -->
<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">
    <!-- Judul Utama -->
    <h1 class="text-4xl font-extrabold text-center text-green-main dark:text-green-accent mb-8">
        Pendidikan Al Haromain
    </h1>

    <div class="main-content-grid">
        <!-- Kolom Kiri: (Unit Pendidikan) -->
        <div class="w-full">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 space-y-4 sticky top-[100px]">
                <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-4">Unit Pendidikan</h2>
                <nav class="space-y-2">
                    <?php if (!empty($jenisPendidikan)): ?>
                        <?php foreach ($jenisPendidikan as $jenis): ?>
                            <a href="#"
                                class="block p-3 rounded-lg bg-green-accent/20 text-green-main dark:text-green-accent font-semibold hover:bg-green-accent hover:text-white transition-colors">
                                <?= htmlspecialchars($jenis['nama_jenis']) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-500">Belum ada data jenis pendidikan.</p>
                    <?php endif; ?>
                </nav>
            </div>
        </div>

        <!-- Kolom Kanan: Konten Utama -->
        <div class="w-full space-y-8">
            
            <!-- === POSTER (Slider) === -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden slider-container">
                <div class="slider" id="image-slider">
                    <?php if (!empty($posters)): ?>
                        <?php foreach ($posters as $poster): ?>
                            <img src="/persyadha.org/public/uploads/poster/<?= htmlspecialchars($poster['gambar']) ?>"
                                alt="<?= htmlspecialchars($poster['judul']) ?>" class="w-full h-auto object-cover">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <img src="https://placehold.co/1200x400/1E4620/ffffff?text=Belum+Ada+Poster"
                            alt="Belum ada poster pendidikan" class="w-full h-auto object-cover">
                    <?php endif; ?>
                </div>
                <button class="slider-button prev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-button next"><i class="fas fa-chevron-right"></i></button>
                <div class="slider-dots" id="slider-dots"></div>
            </div>

            <!-- === STATISTIK LEMBAGA === -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-bold text-center text-green-main dark:text-green-accent mb-6">
                    Statistik Lembaga Pendidikan
                </h2>

                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 text-center">
                    <?php
                    $icons = [
                        'Pesantren' => 'fas fa-mosque',
                        'Sekolah' => 'fas fa-school',
                        'TPQ' => 'fas fa-book-reader',
                        'Majelis Taklim' => 'fas fa-users',
                    ];

                    if (!empty($stats)):
                        foreach ($stats as $jenis => $jumlah):
                    ?>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 md:p-6 rounded-2xl shadow-md">
                                <i class="<?= $icons[$jenis] ?? 'fas fa-university' ?> text-3xl md:text-4xl text-green-accent mb-2"></i>
                                <div class="text-3xl md:text-4xl font-extrabold text-green-main dark:text-green-accent">
                                    <?= htmlspecialchars($jumlah) ?>+
                                </div>
                                <p class="mt-1 text-sm md:text-base font-semibold text-gray-700 dark:text-gray-300">
                                    <?= htmlspecialchars($jenis) ?>
                                </p>
                            </div>
                    <?php
                        endforeach;
                    else:
                    ?>
                        <p class="col-span-4 text-center text-gray-500">Belum ada data statistik lembaga.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- === INFORMASI PENERIMAAN SISWA BARU === -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-bold text-green-main dark:text-green-accent mb-6">
                    Informasi Penerimaan Siswa Baru
                </h2>
                <p class="text-gray-700 dark:text-gray-300 mb-6 text-sm md:text-base">
                    Temukan lembaga pendidikan Al Haromain terdekat dengan Anda. Gunakan kolom pencarian di bawah ini
                    untuk mencari berdasarkan kota atau jenis pendidikan.
                </p>

                <!-- Filter -->
                <div class="flex flex-col md:flex-row gap-4 mb-8">
                    <select class="w-full md:w-1/3 p-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-accent">
                        <option value="">Pilih Kota/Kabupaten</option>
                        <option value="surabaya">Surabaya</option>
                        <option value="sidoarjo">Sidoarjo</option>
                        <option value="malang">Malang</option>
                        <option value="gresik">Gresik</option>
                    </select>
                    <select class="w-full md:w-1/3 p-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-green-accent">
                        <option value="">Pilih Jenis Pendidikan</option>
                        <option value="pesantren">Pesantren</option>
                        <option value="sekolah">Sekolah</option>
                        <option value="madrasah">Madrasah</option>
                        <option value="tpq">TPQ</option>
                    </select>
                    <button class="w-full md:w-1/3 p-3 rounded-xl bg-green-main text-white font-semibold hover:bg-green-accent transition-colors">
                        Cari
                    </button>
                </div>

                <!-- Tabel -->
                <div class="overflow-x-auto rounded-lg shadow-md border dark:border-gray-700">
                    <table class="w-full text-left text-sm text-gray-700 dark:text-gray-300">
                        <thead class="text-xs text-gray-900 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama Lembaga</th>
                                <th class="px-6 py-3">Alamat</th>
                                <th class="px-6 py-3">Kota/Kab.</th>
                                <th class="px-6 py-3">Jenis Pendidikan</th>
                                <th class="px-6 py-3">CP</th>
                                <th class="px-6 py-3">Website</th>
                            </tr>
                        </thead>
                        <tbody id="school-data">
                            <?php if (!empty($lembagas)): ?>
                                <?php foreach ($lembagas as $index => $l): ?>
                                    <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4"><?= $index + 1 ?></td>
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            <?= htmlspecialchars($l['nama_lembaga']) ?>
                                        </td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($l['alamat']) ?></td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($l['kota']) ?></td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($l['nama_jenis'] ?? ($l['jenis']['nama_jenis'] ?? '-')) ?></td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($l['kontak'] ?? '-') ?></td>
                                        <td class="px-6 py-4">
                                            <?php if (!empty($l['website'])): ?>
                                                <a href="<?= htmlspecialchars($l['website']) ?>" target="_blank" class="text-green-accent hover:underline">
                                                    <?= htmlspecialchars(parse_url($l['website'], PHP_URL_HOST) ?? $l['website']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-gray-400">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">
                                        Belum ada data lembaga pendidikan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
