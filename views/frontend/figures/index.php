<main class="pt-28 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">

    <?php
    // Pisahkan berdasarkan kategori
    $pendiri = array_filter($figures, fn($f) => $f['category'] === 'pendiri');
    $dai = array_filter($figures, fn($f) => $f['category'] === 'dai');
    ?>

    <!-- ===================== -->
    <!-- PENDIRI YAYASAN       -->
    <!-- ===================== -->
        <?php if (!empty($pendiri)): ?>

        <div class="text-center mb-8">
            <h1 class="text-2xl md:text-3xl font-bold tracking-widest text-gray-800">
                TOKOH
            </h1>
            <div class="w-32 h-1 bg-[#003333] mx-auto mt-2"></div>

            <p class="mt-4 text-lg font-semibold text-gray-700">
                Pendiri Yayasan
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">

                <?php foreach ($pendiri as $f): ?>
                <a href="/persyadha.org/figure/<?= $f['slug'] ?>"
                    class="bg-[#003333] text-white rounded-lg p-5 flex gap-4 items-center hover:shadow-xl transition">

                    <!-- FOTO -->
                    <div class="flex-shrink-0">
                            <?php if (!empty($f['photo'])): ?>
                            <img src="/persyadha.org/public/<?= htmlspecialchars($f['photo']) ?>"
                                class="w-20 h-20 object-cover rounded-full border-2 border-white">
                            <?php else: ?>
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                👤
                            </div>
                            <?php endif; ?>
                    </div>

                    <!-- TEXT -->
                    <div class="flex-1">
                        <p class="text-sm italic text-gray-200 mb-2">
                            “Pendiri Al Haromain”
                        </p>

                        <p class="text-xs text-gray-300 line-clamp-2 mb-2">
                                <?= htmlspecialchars(substr($f['biography'], 0, 100)) ?>...
                        </p>

                        <h3 class="font-bold text-white">
                                <?= htmlspecialchars($f['name']) ?>
                        </h3>
                    </div>

                </a>
                <?php endforeach; ?>

        </div>

        <?php endif; ?>


    <!-- ===================== -->
    <!-- DAI TUGAS             -->
    <!-- ===================== -->
        <?php if (!empty($dai)): ?>

        <div class="text-center mt-12 mb-6">
            <p class="text-lg font-semibold text-gray-700">
                Da’i Tugas
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">

                <?php foreach ($dai as $f): ?>
                <a href="/persyadha.org/figure/<?= $f['slug'] ?>"
                    class="bg-[#003333] text-white rounded-lg p-5 flex gap-4 items-center hover:shadow-xl transition">

                    <!-- FOTO -->
                    <div class="flex-shrink-0">
                            <?php if (!empty($f['photo'])): ?>
                            <img src="/persyadha.org/public/<?= htmlspecialchars($f['photo']) ?>"
                                class="w-20 h-20 object-cover rounded-full border-2 border-white">
                            <?php else: ?>
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                                👤
                            </div>
                            <?php endif; ?>
                    </div>

                    <!-- TEXT -->
                    <div class="flex-1">
                        <p class="text-sm italic text-gray-200 mb-2">
                            “Da’i Al Haromain”
                        </p>

                        <p class="text-xs text-gray-300 line-clamp-2 mb-2">
                                <?= htmlspecialchars(substr($f['biography'], 0, 100)) ?>...
                        </p>

                        <h3 class="font-bold text-white">
                                <?= htmlspecialchars($f['name']) ?>
                        </h3>
                    </div>

                </a>
                <?php endforeach; ?>

        </div>

        <?php endif; ?>

</main>