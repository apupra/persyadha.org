<!-- FOOTER dengan 4 kolom -->
<footer class="bg-green-main dark:bg-gray-900 text-gray-100 dark:text-gray-200 py-10 transition-colors duration-500">
    <div
        class="container mx-auto px-4 lg:px-6 grid grid-cols-1 md:grid-cols-[1.2fr_1fr_1fr_1fr] gap-x-16 md:gap-x-10 lg:gap-x-12 gap-y-8">

        <!-- Kolom 1: Logo & Deskripsi -->
        <div class="text-center md:text-left">
            <div class="bg-white rounded-xl p-2 inline-block shadow-md mb-4 flex items-center">
                <img src="/persyadha.org/assets/frontend/images/logo kiri.png" alt="Logo Persyadha"
                    class="h-16 w-auto mx-auto md:mx-0">
            </div>
            <p class="text-sm leading-relaxed text-gray-200 text-justify">
                <strong>Persyarikatan Dakwah Al-Haromain (PERSYADHA)</strong> adalah lembaga dakwah
                yang berkomitmen membangun generasi Qur'ani melalui pendidikan, sosial, dan dakwah
                berkelanjutan berbasis pesantren mahasiswa dan masyarakat.
            </p>
        </div>

        <!-- Kolom 2:  Jam Kerja -->
        <div class="text-center md:text-left">
            <h3 class="text-2xl font-bold mb-4">Jam Kerja</h3>
            <ul class="text-sm space-y-1">
                <li><strong>Senin – Jumat:</strong> 08.00 – 16.00 WIB</li>
                <li><strong>Sabtu:</strong> 08.00 – 12.00 WIB</li>
                <li><strong>Minggu:</strong> Tutup</li>
            </ul>
            <div class="mt-4">
                <p class="text-sm text-gray-300 dark:text-gray-400 text-justify">
                    Kami siap melayani Anda sesuai jam operasional.
                    Silakan hubungi kami melalui kontak yang tersedia.
                </p>
            </div>
        </div>


        <!-- Kolom 3: Hubungi Kami -->
        <div class="text-center md:text-left">
            <h3 class="text-2xl font-bold mb-4">Hubungi Kami</h3>
            <ul class="space-y-2 text-sm">
                <li class="flex items-center justify-center md:justify-start">
                    <i class="fas fa-map-marker-alt mr-3 text-green-accent"></i>
                    <span>Jl. Ketintang, Surabaya</span>
                </li>
                <li class="flex items-center justify-center md:justify-start">
                    <i class="fas fa-phone mr-3 text-green-accent"></i>
                    <span>+62 812-3456-7890</span>
                </li>
                <li class="flex items-center justify-center md:justify-start">
                    <i class="fas fa-envelope mr-3 text-green-accent"></i>
                    <span>info@alharomain.or.id</span>
                </li>
                <li class="flex items-center justify-center md:justify-start">
                    <i class="fab fa-whatsapp mr-3 text-green-accent"></i>
                    <span>+62 812-3456-7890</span>
                </li>
            </ul>
        </div>

        <!-- Kolom 4: Hak Cipta -->
<div class="text-center md:text-left">
    <h3 class="text-2xl font-bold mb-4">Hak Cipta</h3>
    <p class="text-sm leading-relaxed text-gray-200">
        &copy; 2024 Persyarikatan Dakwah Al-Haromain. <br class="md:hidden">
        Semua Hak Cipta Terpelihara.
    </p>
    <div class="mt-4 flex justify-center md:justify-start space-x-3 text-lg">
        <a href="#" class="hover:text-green-accent"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="hover:text-green-accent"><i class="fab fa-instagram"></i></a>
        <a href="#" class="hover:text-green-accent"><i class="fab fa-youtube"></i></a>
    </div>
</div>


    </div>
</footer>
<!-- Footer -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ===== MENU HAMBURGER (Mobile) =====
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (hamburgerBtn && mobileMenu) {
            hamburgerBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // ===== POP-UP TANGGAL & WAKTU =====
        const dateTimeBtn = document.getElementById('date-time-btn');
        const dateTimeBox = document.getElementById('date-time-box');
        const gregorianDate = document.getElementById('gregorian-date');
        const currentTime = document.getElementById('current-time');

        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            if (gregorianDate) gregorianDate.textContent = `Masehi: ${now.toLocaleDateString('id-ID', options)}`;
            if (currentTime) currentTime.textContent = `Pukul: ${now.toLocaleTimeString('id-ID')}`;
        }

        if (dateTimeBtn && dateTimeBox) {
            dateTimeBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                dateTimeBox.style.display = dateTimeBox.style.display === 'block' ? 'none' : 'block';
                if (dateTimeBox.style.display === 'block') {
                    updateDateTime();
                }
            });
        }

        // ===== POP-UP BAHASA =====
        const languageBtn = document.getElementById('language-btn');
        const languageBox = document.getElementById('language-box');
        if (languageBtn && languageBox) {
            languageBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                languageBox.style.display = languageBox.style.display === 'block' ? 'none' : 'block';
            });
        }

        // ===== KOTAK PENCARIAN =====
        const searchBtn = document.getElementById('search-btn');
        const searchBox = document.getElementById('search-box');
        if (searchBtn && searchBox) {
            searchBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                searchBox.style.display = searchBox.style.display === 'block' ? 'none' : 'block';
            });
        }

        // ===== CLOSE POPUP JIKA KLIK LUAR =====
        document.addEventListener('click', (event) => {
            if (dateTimeBtn && dateTimeBox && !dateTimeBtn.contains(event.target) && !dateTimeBox.contains(event.target)) {
                dateTimeBox.style.display = 'none';
            }
            if (languageBtn && languageBox && !languageBtn.contains(event.target) && !languageBox.contains(event.target)) {
                languageBox.style.display = 'none';
            }
            if (searchBtn && searchBox && !searchBtn.contains(event.target) && !searchBox.contains(event.target)) {
                searchBox.style.display = 'none';
            }
        });

        // ===== DROPDOWN NAVIGASI (Desktop) =====
        const dropdownContainers = document.querySelectorAll('.dropdown-container');
        dropdownContainers.forEach(container => {
            const button = container.querySelector('button');
            const menu = container.querySelector('.dropdown-menu');
            if (button && menu) {
                button.addEventListener('mouseenter', () => menu.style.display = 'block');
                container.addEventListener('mouseleave', () => menu.style.display = 'none');
            }
        });

        // ===== DROPDOWN NAVIGASI (Mobile) =====
        const mobileDropdownBtns = document.querySelectorAll('.mobile-dropdown-btn');
        mobileDropdownBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const menu = btn.nextElementSibling;
                if (menu) menu.classList.toggle('hidden');
            });
        });

        // ===== MODE MALAM =====
        const modeMalamBtn = document.getElementById('mode-malam');
        if (modeMalamBtn) {
            modeMalamBtn.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
            });
        }

        // ===== MODAL PREVIEW (Gambar/Video) =====
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modal-content');
        const closeBtn = document.querySelector('.close-btn');
        const previewBoxes = document.querySelectorAll('.preview-box');

        if (modal && modalContent && closeBtn) {
            previewBoxes.forEach(box => {
                box.addEventListener('click', () => {
                    const type = box.dataset.type;
                    const src = box.dataset.src;
                    modalContent.innerHTML = '';

                    if (type === 'image') {
                        const img = document.createElement('img');
                        img.src = src;
                        modalContent.appendChild(img);
                    } else if (type === 'video') {
                        const video = document.createElement('video');
                        video.src = src;
                        video.controls = true;
                        video.autoplay = true;
                        video.loop = true;
                        video.setAttribute('playsinline', '');
                        modalContent.appendChild(video);
                    }
                    modal.style.display = 'flex';
                });
            });

            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                const video = modalContent.querySelector('video');
                if (video) { video.pause(); video.currentTime = 0; }
            });

            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    const video = modalContent.querySelector('video');
                    if (video) { video.pause(); video.currentTime = 0; }
                }
            });
        }

        // ===== CAROUSEL POSTER =====
        const posterContainer = document.getElementById('poster-container');
        const posters = document.querySelectorAll('.poster-item');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const carouselDots = document.querySelectorAll('.carousel-dot');
        const heroTextContainer = document.getElementById('hero-text-container');

        if (posterContainer && posters.length > 0) {
            const totalRealPosters = 3;
            let currentIndex = 1;

            posterContainer.style.transform = `translateX(-${currentIndex * 100}%)`;

            function updatePoster() {
                posterContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
                let dotIndex = currentIndex - 1;
                if (currentIndex === 0) dotIndex = totalRealPosters - 1;
                else if (currentIndex === totalRealPosters + 1) dotIndex = 0;

                carouselDots.forEach((dot, i) => {
                    dot.classList.remove('opacity-100');
                    dot.classList.add('opacity-50');
                    if (i === dotIndex) dot.classList.add('opacity-100');
                });

                if (heroTextContainer) {
                    heroTextContainer.classList.toggle('hidden', dotIndex !== 0);
                }
            }

            nextBtn?.addEventListener('click', () => {
                if (currentIndex >= posters.length - 1) {
                    currentIndex++;
                    posterContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
                    setTimeout(() => {
                        posterContainer.classList.add('no-transition');
                        currentIndex = 1;
                        posterContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
                        setTimeout(() => posterContainer.classList.remove('no-transition'), 50);
                    }, 500);
                } else {
                    currentIndex++;
                    updatePoster();
                }
            });

            prevBtn?.addEventListener('click', () => {
                if (currentIndex <= 0) {
                    currentIndex--;
                    posterContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
                    setTimeout(() => {
                        posterContainer.classList.add('no-transition');
                        currentIndex = posters.length - 2;
                        posterContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
                        setTimeout(() => posterContainer.classList.remove('no-transition'), 50);
                    }, 500);
                } else {
                    currentIndex--;
                    updatePoster();
                }
            });

            carouselDots.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    currentIndex = i + 1;
                    updatePoster();
                });
            });

            setInterval(() => { if (!posterContainer.classList.contains('no-transition')) nextBtn?.click(); }, 5000);
            window.addEventListener('load', updatePoster);
        }

        // ===== IMAGE SLIDER SEDERHANA =====
        const slider = document.getElementById('image-slider');
        if (slider) {
            const slides = slider.querySelectorAll('img');
            const totalSlides = slides.length;
            let currentIndex = 0;
            const sliderDotsContainer = document.getElementById('slider-dots');

            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('span');
                dot.classList.add('dot');
                dot.addEventListener('click', () => showSlide(i));
                sliderDotsContainer.appendChild(dot);
            }
            const dots = sliderDotsContainer.querySelectorAll('.dot');

            function showSlide(index) {
                currentIndex = (index + totalSlides) % totalSlides;
                slider.style.transform = `translateX(${-currentIndex * 100}%)`;
                dots.forEach((dot, i) => dot.classList.toggle('active', i === currentIndex));
            }

            document.querySelector('.slider-button.prev')?.addEventListener('click', () => showSlide(currentIndex - 1));
            document.querySelector('.slider-button.next')?.addEventListener('click', () => showSlide(currentIndex + 1));
            setInterval(() => showSlide(currentIndex + 1), 5000);
            showSlide(0);
        }
    });
</script>



</body>

</html>