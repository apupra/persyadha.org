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

    .text-green-accent {
        color: var(--accent-green);
    }

    .bg-green-accent {
        background-color: var(--accent-green);
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
        /* Tetap putih */
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

    .dark .search-box {
        background-color: white;
        /* Kotak pencarian tetap putih */
    }

    .dark .search-box input,
    .dark .search-box button {
        color: #2d3748;
        /* Mengatur warna teks di dalam kotak pencarian untuk mode gelap */
    }

    /* Penyesuaian responsif untuk tata letak utama */
    @media (min-width: 768px) {
        .main-content-grid {
            /* Mengubah lebar kolom menjadi 1fr 3fr 1fr dan mengurangi celah */
            display: grid;
            grid-template-columns: 1fr 3fr 1fr;
            gap: 1rem;
            /* Mengurangi jarak antar kolom */
        }
    }
</style>
<!-- KONTEN UTAMA HALAMAN ARTIKEL -->
<main class="pt-24 md:pt-[100px] pb-12 container mx-auto px-4 lg:px-6">
    <h1 class="text-4xl lg:text-5xl font-extrabold text-center text-green-main dark:text-green-accent mb-8">Kumpulan
        Artikel</h1>

    <!-- Tata Letak 3 Kolom untuk Desktop, Vertikal untuk Mobile -->
    <div class="main-content-grid">
        <!-- Kolom Kiri: Kategori dan Pencarian (1/4 lebar) -->
        <div class="w-full space-y-8">
            <div class="bg-green-main dark:bg-green-main rounded-2xl shadow-xl p-6 sticky top-[100px] text-gray-100">
                <h2 class="text-2xl font-bold text-green-accent mb-4">Cari Artikel</h2>
                <div class="relative mb-6">
                    <input type="text" placeholder="Cari..."
                        class="w-full p-3 rounded-xl border border-green-accent bg-gray-800 text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-accent pr-10">
                    <i class="fas fa-search text-gray-400 absolute right-3 top-1/2 -translate-y-1/2"></i>
                </div>

                <h2 class="text-2xl font-bold text-green-accent mb-4">Kategori</h2>
                <nav class="space-y-2 text-gray-200">
                    <!-- Menghilangkan tulisan "Semua Kategori" -->
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Umum</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Khutbah</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Akidah</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Fiqih</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Tazkiyah</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Tafsir</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Siroh
                        Nabawi</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Perempuan</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Anak</a>
                    <a href="#"
                        class="block p-3 rounded-lg hover:bg-green-accent hover:text-white transition-colors">Kisah</a>
                </nav>
                
            </div>
        </div>

        <!-- Kolom Tengah: Artikel Terbaru & Per Kategori (2/4 lebar) -->
        <div class="w-full space-y-8">
            <!-- Bagian Artikel Terbaru -->
            <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-6">Artikel Terbaru</h2>
                <div class="space-y-6">
                    <!-- Artikel Terbaru 1: Gambar lebih besar -->
                    <div class="flex flex-col items-center text-center gap-4 border-b pb-4 dark:border-gray-700">
                        <img src="https://placehold.co/800x450/1E4620/ffffff?text=Artikel+1" alt="Preview Artikel 1"
                            class="w-full h-auto rounded-xl object-cover">
                        <div class="flex-grow w-full">
                            <span class="text-xs font-semibold uppercase text-green-accent">Khutbah</span>
                            <h3 class="text-xl font-bold mt-1 text-green-main dark:text-green-accent">Pentingnya Shalat
                                Berjamaah di Tengah Kehidupan Modern</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Shalat berjamaah membawa banyak
                                keutamaan, tidak hanya pahala yang berlipat ganda, tetapi juga memperkuat ukhuwah
                                islamiyah...</p>
                            <a href="#" class="text-green-accent text-sm font-medium mt-2 block hover:underline">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                    <!-- Artikel Terbaru 2: Gambar di kiri -->
                    <div class="flex flex-col md:flex-row items-start gap-4 border-b pb-4 dark:border-gray-700">
                        <img src="https://placehold.co/200x150/1C5040/ffffff?text=Artikel+2" alt="Preview Artikel 2"
                            class="w-full h-auto md:w-1/3 md:h-auto rounded-xl object-cover">
                        <div class="flex-grow w-full md:text-left">
                            <span class="text-xs font-semibold uppercase text-green-accent">Akidah</span>
                            <h3 class="text-xl font-bold mt-1 text-green-main dark:text-green-accent">Memahami Asmaul
                                Husna: Al-Ghaniy</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Mengenal nama-nama Allah adalah
                                jalan untuk mendekatkan diri kepada-Nya. Nama Al-Ghaniy, Yang Maha Kaya, mengajarkan
                                kita untuk tidak bergantung pada selain Allah...</p>
                            <a href="#" class="text-green-accent text-sm font-medium mt-2 block hover:underline">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                    <!-- Artikel Terbaru 3: Gambar di kiri -->
                    <div class="flex flex-col md:flex-row items-start gap-4">
                        <img src="https://placehold.co/200x150/1D6650/ffffff?text=Artikel+3" alt="Preview Artikel 3"
                            class="w-full h-auto md:w-1/3 md:h-auto rounded-xl object-cover">
                        <div class="flex-grow w-full md:text-left">
                            <span class="text-xs font-semibold uppercase text-green-accent">Siroh Nabawi</span>
                            <h3 class="text-xl font-bold mt-1 text-green-main dark:text-green-accent">Perjuangan Hijrah
                                Rasulullah dari Makkah ke Madinah</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Kisah hijrah Rasulullah ﷺ bukan
                                sekadar perjalanan fisik, melainkan perjalanan dakwah yang penuh hikmah dan pelajaran
                                berharga bagi umat Islam...</p>
                            <a href="#" class="text-green-accent text-sm font-medium mt-2 block hover:underline">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Bagian Artikel Per Kategori -->
            <section class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
                <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-6">Artikel Berdasarkan Kategori
                </h2>
                <div class="space-y-8">
                    <!-- Baris 1: Fiqih, Tazkiyah, Tafsir -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Artikel Fiqih -->
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                            <img src="https://placehold.co/400x250/1E4620/ffffff?text=Fiqih" alt="Artikel Fiqih"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <span class="text-xs font-semibold uppercase text-green-accent">Fiqih</span>
                                <h3 class="text-lg font-bold mt-1 text-green-main dark:text-green-accent">Mengenal
                                    Rukun-rukun Wudhu</h3>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Wudhu adalah syarat sah shalat.
                                    Memahami rukun-rukunnya adalah keharusan bagi setiap muslim...</p>
                            </div>
                        </div>
                        <!-- Artikel Tazkiyah -->
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                            <img src="https://placehold.co/400x250/1C5040/ffffff?text=Tazkiyah" alt="Artikel Tazkiyah"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <span class="text-xs font-semibold uppercase text-green-accent">Tazkiyah</span>
                                <h3 class="text-lg font-bold mt-1 text-green-main dark:text-green-accent">Meraih
                                    Keikhlasan Hati</h3>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Ikhlas adalah kunci diterimanya
                                    setiap amal. Bagaimana cara melatih hati agar senantiasa ikhlas...</p>
                            </div>
                        </div>
                        <!-- Artikel Tafsir -->
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                            <img src="https://placehold.co/400x250/1D6650/ffffff?text=Tafsir" alt="Artikel Tafsir"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <span class="text-xs font-semibold uppercase text-green-accent">Tafsir</span>
                                <h3 class="text-lg font-bold mt-1 text-green-main dark:text-green-accent">Makna Surat
                                    Al-Insyirah</h3>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Tafsir surat Al-Insyirah
                                    mengajarkan kita tentang kemudahan yang menyertai setiap kesulitan...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 2: Perempuan, Anak, Kisah -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Artikel Perempuan -->
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                            <img src="https://placehold.co/400x250/1E4620/ffffff?text=Perempuan" alt="Artikel Perempuan"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <span class="text-xs font-semibold uppercase text-green-accent">Perempuan</span>
                                <h3 class="text-lg font-bold mt-1 text-green-main dark:text-green-accent">Peran Mulia
                                    Muslimah dalam Dakwah</h3>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Islam mengangkat derajat
                                    perempuan dan memberi peran yang sangat penting dalam keberlangsungan dakwah...</p>
                            </div>
                        </div>
                        <!-- Artikel Anak -->
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                            <img src="https://placehold.co/400x250/1C5040/ffffff?text=Anak" alt="Artikel Anak"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <span class="text-xs font-semibold uppercase text-green-accent">Anak</span>
                                <h3 class="text-lg font-bold mt-1 text-green-main dark:text-green-accent">Kisah Nabi
                                    Yunus untuk Anak-Anak</h3>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Kisah para nabi adalah sumber
                                    pelajaran terbaik bagi anak-anak untuk membentuk karakter yang shalih...</p>
                            </div>
                        </div>
                        <!-- Artikel Kisah -->
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                            <img src="https://placehold.co/400x250/1D6650/ffffff?text=Kisah" alt="Artikel Kisah"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <span class="text-xs font-semibold uppercase text-green-accent">Kisah</span>
                                <h3 class="text-lg font-bold mt-1 text-green-main dark:text-green-accent">Kisah
                                    Inspiratif dari Sahabat Nabi</h3>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">Membaca kisah para sahabat akan
                                    membangkitkan semangat kita untuk meneladani akhlak mulia mereka...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Kolom Kanan: Artikel Terpopuler (1/4 lebar) -->
        <div class="w-full space-y-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 sticky top-[100px] space-y-6">
                <!-- Terpopuler Hari Ini -->
                <div>
                    <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-4">Terpopuler Hari Ini</h2>
                    <div class="space-y-4">
                        <!-- Artikel Populer 1 -->
                        <div
                            class="flex flex-col items-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md p-4 text-center">
                            <img src="https://placehold.co/80x80/1E4620/ffffff?text=Pop+1" alt="Artikel Populer"
                                class="w-24 h-24 rounded-lg object-cover mb-2">
                            <div>
                                <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">Tips Menjaga
                                    Hati Agar Selalu Ikhlas</h3>
                                <p class="text-xs text-gray-700 dark:text-gray-400">Oleh: Ust. Zulkifli</p>
                            </div>
                        </div>
                        <!-- Artikel Populer 2 -->
                        <div
                            class="flex flex-col items-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md p-4 text-center">
                            <img src="https://placehold.co/80x80/1C5040/ffffff?text=Pop+2" alt="Artikel Populer"
                                class="w-24 h-24 rounded-lg object-cover mb-2">
                            <div>
                                <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">Rahasia Doa
                                    yang Mustajab</h3>
                                <p class="text-xs text-gray-700 dark:text-gray-400">Oleh: Ustadzah Fatimah</p>
                            </div>
                        </div>
                        <!-- Artikel Populer 3 -->
                        <div
                            class="flex flex-col items-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md p-4 text-center">
                            <img src="https://placehold.co/80x80/1D6650/ffffff?text=Pop+3" alt="Artikel Populer"
                                class="w-24 h-24 rounded-lg object-cover mb-2">
                            <div>
                                <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">Hikmah di Balik
                                    Musibah</h3>
                                <p class="text-xs text-gray-700 dark:text-gray-400">Oleh: Ustadz Ihsan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terpopuler Sepanjang Masa -->
                <div>
                    <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-4">Terpopuler Sepanjang Masa
                    </h2>
                    <div class="space-y-4">
                        <!-- Artikel Terpopuler 1 -->
                        <div
                            class="flex flex-col items-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md p-4 text-center">
                            <img src="https://placehold.co/80x80/1E4620/ffffff?text=All+1" alt="Artikel Terpopuler"
                                class="w-24 h-24 rounded-lg object-cover mb-2">
                            <div>
                                <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">Keutamaan
                                    Menghafal Al-Qur'an</h3>
                                <p class="text-xs text-gray-700 dark:text-gray-400">Oleh: Abi Ihya Al-Haromain</p>
                            </div>
                        </div>
                        <!-- Artikel Terpopuler 2 -->
                        <div
                            class="flex flex-col items-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md p-4 text-center">
                            <img src="https://placehold.co/80x80/1C5040/ffffff?text=All+2" alt="Artikel Terpopuler"
                                class="w-24 h-24 rounded-lg object-cover mb-2">
                            <div>
                                <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">Adab dan Doa
                                    Harian Rasulullah</h3>
                                <p class="text-xs text-gray-700 dark:text-gray-400">Oleh: Ustadz Syarif</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terpopuler Per Kategori -->
                <div>
                    <h2 class="text-2xl font-bold text-green-main dark:text-green-accent mb-4">Terpopuler Tiap Kategori
                    </h2>
                    <div class="space-y-4">
                        <!-- Artikel Terpopuler Kategori 1 -->
                        <div
                            class="flex flex-col items-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md p-4 text-center">
                            <img src="https://placehold.co/80x80/1D6650/ffffff?text=Kategori+1"
                                alt="Artikel Terpopuler Kategori" class="w-24 h-24 rounded-lg object-cover mb-2">
                            <div>
                                <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">Keutamaan
                                    Shalat Dhuha (Fiqih)</h3>
                                <p class="text-xs text-gray-700 dark:text-gray-400">Oleh: Ustadz Hasan</p>
                            </div>
                        </div>
                        <!-- Artikel Terpopuler Kategori 2 -->
                        <div
                            class="flex flex-col items-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md p-4 text-center">
                            <img src="https://placehold.co/80x80/1E4620/ffffff?text=Kategori+2"
                                alt="Artikel Terpopuler Kategori" class="w-24 h-24 rounded-lg object-cover mb-2">
                            <div>
                                <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">Kisah Cinta
                                    Sahabat Ali & Fatimah (Kisah)</h3>
                                <p class="text-xs text-gray-700 dark:text-gray-400">Oleh: Tim Persyadha</p>
                            </div>
                        </div>
                        <!-- Artikel Terpopuler Kategori 3 -->
                        <div
                            class="flex flex-col items-center bg-gray-100 dark:bg-gray-700 rounded-xl shadow-md p-4 text-center">
                            <img src="https://placehold.co/80x80/1C5040/ffffff?text=Kategori+3"
                                alt="Artikel Terpopuler Kategori" class="w-24 h-24 rounded-lg object-cover mb-2">
                            <div>
                                <h3 class="text-sm font-semibold text-green-main dark:text-green-accent">Adab Terhadap
                                    Orang Tua (Tazkiyah)</h3>
                                <p class="text-xs text-gray-700 dark:text-gray-400">Oleh: Ustadzah Khadijah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

