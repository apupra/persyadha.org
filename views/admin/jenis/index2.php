
  <!-- MAIN CONTENT -->
  <div class="flex-1 flex flex-col">
    <!-- TOPBAR -->
    <header class="flex items-center justify-between bg-white shadow-md h-16 px-6">
      <div class="flex items-center gap-4">
        <button id="toggleSidebar" class="text-[#013220] text-2xl">
          <i class="bi bi-list"></i>
        </button>
        <h1 class="text-xl font-semibold text-[#013220]">Jenis Pendidikan</h1>
      </div>
      <div class="flex items-center gap-3">
        <span class="text-gray-700 font-medium">
          <?= $_SESSION['admin']['username'] ?? 'Admin'; ?>
        </span>
        <img src="https://ui-avatars.com/api/?name=Admin+Persyadha&background=013220&color=fff" alt="avatar" class="w-9 h-9 rounded-full border-2 border-green-700">
      </div>
    </header>

    <!-- CONTENT -->
    <main class="p-6 space-y-6">
      <div class="bg-white p-6 rounded-2xl shadow-md">
        <div class="flex justify-between items-center mb-4">
          <div>
            <h2 class="text-xl font-semibold text-[#013220]">Tabel Jenis Pendidikan</h2>
            <p class="text-gray-600 text-sm">Daftar jenis pendidikan yang tersedia</p>
          </div>
          <button id="openCreateModal" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition">
            + Tambah Jenis
          </button>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 rounded-lg text-sm">
            <thead class="bg-[#013220] text-white">
              <tr>
                <th class="px-4 py-2 text-left">Nama Jenis</th>
                <th class="px-4 py-2 text-left">Keterangan</th>
                <th class="px-4 py-2 text-left">Dibuat</th>
                <th class="px-4 py-2 text-left">Diperbarui</th>
                <th class="px-4 py-2 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($data)): ?>
                <?php foreach ($data as $row): ?>
                <tr id="row-<?= $row['id'] ?>" class="border-b hover:bg-gray-50">
                  <td class="px-4 py-2"><?= htmlspecialchars($row['nama_jenis']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($row['keterangan'] ?? '-') ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($row['dibuat_pada']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($row['diperbarui_pada']) ?></td>
                  <td class="px-4 py-2 text-center">
                    <div class="flex justify-center gap-2">
                      <button class="edit-btn bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded" 
                              data-id="<?= $row['id'] ?>"
                              data-nama="<?= htmlspecialchars($row['nama_jenis']) ?>"
                              data-keterangan="<?= htmlspecialchars($row['keterangan'] ?? '') ?>">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <form method="POST" action="/persyadha.org/manjadmin/jenis-pendidikan/hapus/<?= $row['id'] ?>" class="delete-form" data-id="<?= $row['id'] ?>">
                        <button type="button" class="delete-btn bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
              <tr>
                <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data jenis pendidikan.</td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

      <footer class="text-gray-600 text-center mt-10">
        <p><?= date("Y") ?> &copy; Persyarikatan Dakwah Al-Haromain.</p>
      </footer>
    </main>
  </div>

  <!-- MODAL TAMBAH -->
  <div id="createModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-lg">
      <h3 class="text-lg font-semibold mb-4 text-[#013220]">Tambah Jenis Pendidikan</h3>
      <form method="POST" action="/persyadha.org/manjadmin/jenis-pendidikan/simpan">
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Nama Jenis</label>
          <input type="text" name="nama_jenis" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-600 outline-none" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Keterangan</label>
          <textarea name="keterangan" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-600 outline-none"></textarea>
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" id="closeCreateModal" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</button>
          <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL EDIT -->
  <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-lg">
      <h3 class="text-lg font-semibold mb-4 text-[#013220]">Edit Jenis Pendidikan</h3>
      <form method="POST" id="editForm">
        <input type="hidden" name="id" id="edit-id">
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Nama Jenis</label>
          <input type="text" name="nama_jenis" id="edit-nama" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-600 outline-none" required>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">Keterangan</label>
          <textarea name="keterangan" id="edit-keterangan" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-green-600 outline-none"></textarea>
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" id="closeEditModal" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</button>
          <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800">Update</button>
        </div>
      </form>
    </div>
  </div>

  <!-- SCRIPT -->
  <script>
    // Sidebar toggle
    const sidebar = document.getElementById('sidebar');
    document.getElementById('toggleSidebar').addEventListener('click', () => {
      sidebar.classList.toggle('hidden');
    });

    // Modal Create
    const createModal = document.getElementById('createModal');
    document.getElementById('openCreateModal').onclick = () => createModal.classList.remove('hidden');
    document.getElementById('closeCreateModal').onclick = () => createModal.classList.add('hidden');

    // Modal Edit
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');
    closeEditModal.onclick = () => editModal.classList.add('hidden');

    document.querySelectorAll('.edit-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        document.getElementById('edit-id').value = this.dataset.id;
        document.getElementById('edit-nama').value = this.dataset.nama;
        document.getElementById('edit-keterangan').value = this.dataset.keterangan;
        document.getElementById('editForm').action = `/persyadha.org/manjadmin/jenis-pendidikan/update/${this.dataset.id}`;
        editModal.classList.remove('hidden');
      });
    });

    // Delete
    document.addEventListener('click', async function (ev) {
      const btn = ev.target.closest('.delete-btn');
      if (!btn) return;
      ev.preventDefault();
      const form = btn.closest('form');
      const id = form.dataset.id;
      const url = form.action;
      const confirm = await Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data yang sudah dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
      });
      if (!confirm.isConfirmed) return;
      try {
        const response = await fetch(url, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        if (!response.ok) throw new Error('Server error');
        const data = await response.json();
        if (data.success) {
          Swal.fire({ icon: 'success', title: data.message, timer: 1500, showConfirmButton: false });
          document.getElementById(`row-${id}`)?.remove();
        } else {
          Swal.fire({ icon: 'error', title: 'Gagal menghapus!', text: data.message || 'Data masih digunakan.' });
        }
      } catch {
        Swal.fire({ icon: 'error', title: 'Data tidak dapat dihapus!', text: 'Kemungkinan data masih digunakan oleh lembaga lain.' });
      }
    });
  </script>
</body>
</html>