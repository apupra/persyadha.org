<style>
    :root {
        --dark-green: #003333;
        --accent-green: #33CCCC;
    }

    body {
        font-family: 'Inter', sans-serif;
    }
</style>

<main class="pt-32 md:pt-[140px] pb-12 container mx-auto px-4 lg:px-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- ===================== -->
        <!-- KIRI (TOKOH UTAMA)    -->
        <!-- ===================== -->
        <div class="lg:col-span-2">

            <div class="bg-[#003333] rounded-xl overflow-hidden shadow-lg text-white text-center p-8">

                <!-- FOTO -->
                <img src="<?= !empty($figure['photo'])
                    ? '/persyadha.org/public/' . htmlspecialchars($figure['photo'])
                    : 'https://placehold.co/300x300' ?>"
                    class="w-full h-64 md:h-80 object-cover mb-4">

                <!-- NAMA -->
                <h1 class="text-2xl md:text-3xl font-bold">
                    <?= htmlspecialchars($figure['name']) ?>
                </h1>

                <!-- SUB -->
                <p class="text-sm text-gray-200 mt-2">
                    Tokoh Al Haromain
                </p>

                <!-- BIO -->
                <p class="text-sm md:text-base text-gray-200 mt-4 max-w-xl mx-auto leading-relaxed">
                    <?php if (!empty($figure['biography'])): ?>
                        <?= nl2br(htmlspecialchars($figure['biography'])) ?>
                    <?php else: ?>
                        <em>Belum ada biografi.</em>
                    <?php endif; ?>
                </p>

            </div>

        </div>


        <!-- ===================== -->
        <!-- KANAN (SIDEBAR)       -->
        <!-- ===================== -->
        <div class="space-y-3">

            <div class="bg-[#003333] text-white text-center py-3 font-semibold rounded">
                Kalam
            </div>

            <div class="bg-blue-900 text-white text-center py-6 flex flex-col items-center justify-center rounded">
                ▶
                <span class="text-xs mt-2">Youtube Abi Ihya</span>
            </div>

            <div class="bg-[#003333] text-white text-center py-3 rounded hover:bg-green-700 transition">
                Fas'alu
            </div>

            <div class="bg-[#003333] text-white text-center py-3 rounded hover:bg-green-700 transition">
                Tafsir
            </div>

            <div class="bg-[#003333] text-white text-center py-3 rounded hover:bg-green-700 transition">
                Kitab
            </div>

            <div class="bg-[#003333] text-white text-center py-3 rounded hover:bg-green-700 transition">
                Galeri
            </div>

        </div>

    </div>

    <!-- ===================== -->
    <!-- BUTTON BACK           -->
    <!-- ===================== -->
    <div class="text-center mt-10">
        <a href="/persyadha.org/figures"
           class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition shadow">
            ← Kembali ke Daftar Tokoh
        </a>
    </div>

</main>