



  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Topbar -->
    <header class="flex items-center justify-between bg-white shadow-md h-16 px-6">
      <div class="flex items-center gap-4">
        <button id="toggleSidebar" class="text-[#013220] text-2xl">
          <i class="bi bi-list"></i>
        </button>
        <h1 class="text-xl font-semibold text-[#013220]">Dashboard Admin</h1>
      </div>
      <div class="flex items-center gap-3">
        <span class="text-gray-700 font-medium">
          <?= $_SESSION['admin']['username'] ?? 'Admin'; ?>
        </span>
        <img src="https://ui-avatars.com/api/?name=Admin+Alharomain&background=013220&color=fff" alt="avatar" class="w-9 h-9 rounded-full border-2 border-green-700">
      </div>
    </header>

    <!-- Content -->
    <main class="p-6 space-y-6">
      <!-- Greeting -->
      <div class="bg-white p-6 rounded-2xl shadow-md">
        <h2 class="text-xl font-semibold text-[#013220]">Halo, <?= $_SESSION['admin']['username'] ?? 'Admin'; ?>!</h2>
        <p class="text-gray-600 mt-1">Anda berhasil login ke Dashboard Admin Persyarikatan Dakwah Al-Haromain.</p>
      </div>

      <!-- Statistik -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white p-5 rounded-2xl shadow-md border-l-4 border-purple-600">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-gray-500 text-sm font-semibold">Event</h3>
              <p class="text-3xl font-bold text-[#013220]"><?= $total_event ?? 0 ?></p>
            </div>
            <i class="bi bi-calendar-event-fill text-purple-600 text-3xl"></i>
          </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-md border-l-4 border-blue-600">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-gray-500 text-sm font-semibold">Artikel</h3>
              <p class="text-3xl font-bold text-[#013220]"><?= $total_artikel ?? 0 ?></p>
            </div>
            <i class="bi bi-journal-text text-blue-600 text-3xl"></i>
          </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-md border-l-4 border-green-600">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-gray-500 text-sm font-semibold">Video</h3>
              <p class="text-3xl font-bold text-[#013220]"><?= $total_video ?? 0 ?></p>
            </div>
            <i class="bi bi-play-btn-fill text-green-600 text-3xl"></i>
          </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-md border-l-4 border-red-600">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="text-gray-500 text-sm font-semibold">Postingan</h3>
              <p class="text-3xl font-bold text-[#013220]"><?= $total_post ?? 0 ?></p>
            </div>
            <i class="bi bi-megaphone-fill text-red-600 text-3xl"></i>
          </div>
        </div>
      </div>

      <!-- Komentar Terbaru -->
      <div class="bg-white rounded-2xl shadow-md p-6">
        <h2 class="text-lg font-semibold text-[#013220] mb-4">Komentar Terbaru</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-[#013220] text-white">
              <tr>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Komentar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b">
                <td class="px-4 py-2 font-semibold">Si Cantik</td>
                <td class="px-4 py-2">Selamat atas keberhasilannya!</td>
              </tr>
              <tr class="border-b bg-gray-50">
                <td class="px-4 py-2 font-semibold">Si Ganteng</td>
                <td class="px-4 py-2">Desain dashboard-nya keren banget!</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Profil Admin -->
      <div class="bg-white rounded-2xl shadow-md p-6 flex items-center gap-4">
        <img src="/persyadha.org/assets/admin/images/faces/1.jpg" alt="Admin" class="w-20 h-20 rounded-full border-4 border-green-700">
        <div>
          <h3 class="text-xl font-semibold text-[#013220]"><?= $_SESSION['admin']['username'] ?? 'John Duck'; ?></h3>
          <p class="text-gray-600">@johnducky</p>
        </div>
      </div>

      <footer class="text-gray-600 text-center mt-10">
        <p><?= date("Y") ?> &copy; Persyarikatan Dakwah Al-Haromain. Crafted with <i class="bi bi-heart-fill text-red-500"></i></p>
      </footer>
    </main>
  </div>

  <!-- Script -->
  <script>
    const sidebar = document.getElementById('sidebar');
    const toggleSidebar = document.getElementById('toggleSidebar');
    toggleSidebar.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
    });
  </script>
</body>
</html>
