<style>
    /* Warna tema */
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

    /* Responsif video YouTube */
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 ratio */
        height: 0;
        overflow: hidden;
        border-radius: 1rem;
    }

    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
        border-radius: 1rem;
    }

    /* Style umum elemen */
    .preview-box img,
    video {
        border-radius: 1rem;
    }
</style>

<!-- ===========================
    BAGIAN PROFIL
=========================== -->
<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">
    <h1 class="text-4xl font-extrabold text-center text-green-main dark:text-green-accent mb-8">
        <?= htmlspecialchars($profile['title']) ?>
    </h1>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Kolom Kiri -->
        <div class="w-full md:w-1/3 flex flex-col space-y-6">

            <!-- Struktur Pengurus -->
            <?php if (!empty($profile['structure_image'])): ?>
                <div class="rounded-2xl shadow-lg bg-white dark:bg-gray-700 overflow-hidden">
                    <img src="/persyadha.org/public/uploads/profile/<?= htmlspecialchars($profile['structure_image']) ?>"
                        alt="Struktur Pengurus"
                        class="w-full h-auto object-cover transition-transform duration-300 hover:scale-105">
                </div>
            <?php endif; ?>

            <!-- Video Profil -->
            <?php if (!empty($profile['profile_video'])): ?>
                <?php
                $videoUrl = trim($profile['profile_video']);
                $youtubeId = null;

                // Deteksi link YouTube
                if (preg_match('/(?:youtube\.com\/(?:embed\/|watch\?v=)|youtu\.be\/)([0-9A-Za-z_-]{11})/', $videoUrl, $matches)) {
                    $youtubeId = $matches[1];
                }
                ?>

                <div class="rounded-2xl shadow-lg bg-white dark:bg-gray-700 overflow-hidden">
                    <?php if ($youtubeId): ?>
                        <!-- Video YouTube -->
                        <div class="video-container">
                            <iframe src="https://www.youtube.com/embed/<?= $youtubeId ?>?rel=0" title="Video Profil"
                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    <?php else: ?>
                        <!-- Video Lokal -->
                        <video class="w-full object-cover" controls playsinline>
                            <source src="<?= $videoUrl ?>" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Kegiatan -->
            <?php if (!empty($profile['activity_image'])): ?>
                <div class="rounded-2xl shadow-lg bg-white dark:bg-gray-700 overflow-hidden">
                    <img src="/persyadha.org/public/uploads/profile/<?= htmlspecialchars($profile['activity_image']) ?>"
                        alt="Kegiatan Yayasan"
                        class="w-full h-auto object-cover transition-transform duration-300 hover:scale-105">
                </div>
            <?php endif; ?>

        </div>

        <!-- Kolom Kanan -->
        <div class="w-full md:w-2/3 bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
            <h2 class="text-3xl font-bold text-green-main dark:text-green-accent mb-4">Sejarah & Visi Kami</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                <?= nl2br(htmlspecialchars($profile['description'])) ?>
            </p>

            <?php if (!empty($profile['vision'])): ?>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Visi</h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                    <?= nl2br(htmlspecialchars($profile['vision'])) ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($profile['mission'])): ?>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Misi</h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                    <?= nl2br(htmlspecialchars($profile['mission'])) ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($profile['values'])): ?>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Nilai Inti</h3>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                    <?= nl2br(htmlspecialchars($profile['values'])) ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($profile['leader_message'])): ?>
                <div class="bg-gray-100 dark:bg-gray-900 rounded-xl p-6 mt-8">
                    <h4 class="text-xl font-bold text-green-main dark:text-green-accent mb-2">Pesan Pimpinan</h4>
                    <p class="italic text-gray-600 dark:text-gray-400">
                        “<?= htmlspecialchars($profile['leader_message']) ?>”
                    </p>
                    <p class="text-right text-sm font-semibold mt-2 text-gray-500 dark:text-gray-400">
                        - <?= htmlspecialchars($profile['leader_name']) ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===========================
        LOKASI YAYASAN
    =========================== -->
    <section class="w-full mt-16">
        <h2 class="text-3xl font-bold text-center text-green-main dark:text-green-accent mb-3">
            Lokasi Yayasan Persyada Al Haromain
        </h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-6">
            Anda dapat memperbesar peta atau klik untuk membuka langsung di Google Maps.
        </p>

        <div class="rounded-2xl overflow-hidden shadow-2xl bg-white dark:bg-gray-800">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3333.8897135983416!2d112.72294!3d-7.310711599999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb4b7ae2852d%3A0x65eacd8f2f25a27b!2sYayasan%20Persyada%20Al%20Haromain!5e1!3m2!1sid!2sid!4v1762315530660!5m2!1sid!2sid"
                width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
</main>
