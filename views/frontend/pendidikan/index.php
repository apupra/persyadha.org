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

<main class="pt-32 md:pt-[140px]">

    <div class="flex min-h-screen">

        <!-- ================= SIDEBAR ================= -->
       <aside class="w-64 bg-green-main text-white flex flex-col pt-4 pb-10">

            <div class="p-4 font-bold text-lg border-b border-white/20">
                Pendidikan
            </div>

            <ul class="flex-1 text-sm">
                <li class="border-b border-white/10">
                    <a href="#" class="block px-4 py-3 hover:bg-green-700">Umum</a>
                </li>
                <li class="border-b border-white/10">
                    <a href="#" class="block px-4 py-3 hover:bg-green-700">LP & Sekolah</a>
                </li>
                <li class="border-b border-white/10">
                    <a href="#" class="block px-4 py-3 hover:bg-green-700">Pesantren</a>
                </li>
                <li class="border-b border-white/10">
                    <a href="#" class="block px-4 py-3 hover:bg-green-700">Majelis Ilmu</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-3 hover:bg-green-700">Komunitas Binaan</a>
                </li>
            </ul>

        </aside>

        <!-- ================= CONTENT ================= -->
        <div class="flex-1 container mx-auto px-4 lg:px-6 py-6 space-y-6">

            <!-- ================= SLIDER ================= -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="flex overflow-x-auto">
                    <?php if (!empty($posters)): ?>
                        <?php foreach ($posters as $poster): ?>
                            <img src="/persyadha.org/public/uploads/poster/<?= htmlspecialchars($poster['gambar']) ?>"
                                class="w-full h-[220px] object-cover">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <img src="https://placehold.co/1000x280"
                            class="w-full h-[220px] object-cover">
                    <?php endif; ?>
                </div>
            </div>

            <!-- ================= CARD STATISTIK ================= -->
            <?php
$colors = [
    'Sekolah' => 'bg-red-600',
    'Pesantren' => 'bg-blue-600',
    'Pondok Pesantren' => 'bg-blue-700',
    'Pesantren Mahasiswa' => 'bg-indigo-600',
    'TPQ' => 'bg-yellow-500',
    'Majelis Taklim' => 'bg-pink-600',
];
?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

<?php if (!empty($stats)): ?>
    <?php foreach ($stats as $jenis => $jumlah): ?>

        <?php
            $color = $colors[$jenis] ?? 'bg-gray-600';
        ?>

        <div class="<?= $color ?> text-white p-6 rounded-xl shadow-lg text-center">

            <div class="text-lg font-semibold">
                <?= htmlspecialchars($jenis) ?>
            </div>

            <div class="text-3xl font-bold mt-2">
                <?= htmlspecialchars($jumlah) ?>+
            </div>

            <p class="text-sm mt-1">
                Lembaga Pendidikan
            </p>

        </div>

    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center col-span-3 text-gray-500">
        Belum ada data statistik.
    </p>
<?php endif; ?>

</div>

            <!-- ================= INFORMASI ================= -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6">

                <h2 class="text-xl md:text-2xl font-bold text-center text-green-main mb-4">
                    Informasi Penerimaan Siswa/Santri Baru
                </h2>

                <!-- FILTER -->
                <form method="GET" class="flex flex-col md:flex-row gap-4 mb-6">

                    <select name="kota"
                        class="w-full md:w-1/3 p-3 rounded-xl border">
                        <option value="">Pilih Kota/Kabupaten</option>
                        <?php foreach ($cities as $c): ?>
                            <option value="<?= htmlspecialchars($c['kota']) ?>">
                                <?= htmlspecialchars($c['kota']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select name="jenis"
                        class="w-full md:w-1/3 p-3 rounded-xl border">
                        <option value="">Pilih Jenis Pendidikan</option>
                        <?php foreach ($types as $t): ?>
                            <option value="<?= htmlspecialchars($t['nama_jenis']) ?>">
                                <?= htmlspecialchars($t['nama_jenis']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit"
                        class="w-full md:w-1/3 bg-green-main text-white p-3 rounded-xl">
                        Cari
                    </button>

                </form>

                <!-- ================= TABLE ================= -->
                <div class="overflow-x-auto rounded-lg border">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Alamat</th>
                                <th class="px-4 py-2">Kota</th>
                                <th class="px-4 py-2">Jenis</th>
                                <th class="px-4 py-2">CP</th>
                                <th class="px-4 py-2">Website</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($lembagas)): ?>
                                <?php foreach ($lembagas as $i => $l): ?>
                                    <tr class="border-b">
                                        <td class="px-4 py-2"><?= $i + 1 ?></td>
                                        <td class="px-4 py-2"><?= $l['nama_lembaga'] ?></td>
                                        <td class="px-4 py-2"><?= $l['alamat'] ?></td>
                                        <td class="px-4 py-2"><?= $l['kota'] ?></td>
                                        <td class="px-4 py-2"><?= $l['nama_jenis'] ?></td>
                                        <td class="px-4 py-2"><?= $l['kontak'] ?? '-' ?></td>
                                        <td class="px-4 py-2">
                                            <?php if (!empty($l['website'])): ?>
                                                <a href="<?= $l['website'] ?>" target="_blank"
                                                    class="text-blue-500 underline">
                                                    Website
                                                </a>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        Tidak ada data
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