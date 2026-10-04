<div id="main-content">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading" style="margin-top: -50px !important;">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Profil Lembaga</h3>
                    <p class="text-subtitle text-muted">Daftar profil lembaga yang telah terdaftar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/persyadha.org/manjadmin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profil</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- ======================== TABEL PROFIL ======================== -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Profil Lembaga</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        + Tambah Profil
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Subjudul</th>
                                    <th>Pimpinan</th>
                                    <th>Dibuat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($profiles)): ?>
                                    <?php foreach ($profiles as $row): ?>
                                        <tr id="row-<?= $row['id'] ?>">
                                            <td><?= htmlspecialchars($row['title']) ?></td>
                                            <td><?= htmlspecialchars($row['subtitle'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['leader_name'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['created_at'] ?? '-') ?></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-sm btn-warning rounded-circle edit-btn" title="Edit"
                                                        data-id="<?= $row['id'] ?>"
                                                        data-title="<?= htmlspecialchars($row['title']) ?>"
                                                        data-subtitle="<?= htmlspecialchars($row['subtitle'] ?? '') ?>"
                                                        data-leader="<?= htmlspecialchars($row['leader_name'] ?? '') ?>"
                                                        data-description="<?= htmlspecialchars($row['description'] ?? '') ?>"
                                                        data-vision="<?= htmlspecialchars($row['vision'] ?? '') ?>"
                                                        data-mission="<?= htmlspecialchars($row['mission'] ?? '') ?>"
                                                        data-values="<?= htmlspecialchars($row['values'] ?? '') ?>"
                                                        data-message="<?= htmlspecialchars($row['leader_message'] ?? '') ?>"
                                                        data-structure="<?= htmlspecialchars($row['structure_image'] ?? '') ?>"
                                                        data-activity="<?= htmlspecialchars($row['activity_image'] ?? '') ?>"
                                                        data-video="<?= htmlspecialchars($row['profile_video'] ?? '') ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <!-- Tombol Delete -->
                                                    <form method="POST"
                                                        action="/persyadha.org/manjadmin/profile/delete/<?= $row['id'] ?>"
                                                        class="delete-form d-inline" data-id="<?= $row['id'] ?>">
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                            title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada data profil.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ======================== MODAL TAMBAH ======================== -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="/persyadha.org/manjadmin/profile/store" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Profil Lembaga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Judul Profil</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Subjudul</label>
                                <input type="text" name="subtitle" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Visi</label>
                                <textarea name="vision" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Misi</label>
                                <textarea name="mission" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nilai</label>
                                <textarea name="values" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nama Pimpinan</label>
                                <input type="text" name="leader_name" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Pesan Pimpinan</label>
                                <textarea name="leader_message" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Struktur Organisasi (Gambar)</label>
                                <input type="file" name="structure_image" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Video Profil (URL YouTube / Link Video)</label>
                                <input type="url" name="profile_video" class="form-control"
                                    placeholder="https://www.youtube.com/watch?v=xxxx">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Foto Kegiatan</label>
                                <input type="file" name="activity_image" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================== MODAL EDIT ======================== -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" id="editForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Profil Lembaga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Judul Profil</label>
                                <input type="text" name="title" id="edit-title" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Subjudul</label>
                                <input type="text" name="subtitle" id="edit-subtitle" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Deskripsi</label>
                                <textarea name="description" id="edit-description" class="form-control"
                                    rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Visi</label>
                                <textarea name="vision" id="edit-vision" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Misi</label>
                                <textarea name="mission" id="edit-mission" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nilai</label>
                                <textarea name="values" id="edit-values" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nama Pimpinan</label>
                                <input type="text" name="leader_name" id="edit-leader" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Pesan Pimpinan</label>
                                <textarea name="leader_message" id="edit-message" class="form-control"
                                    rows="2"></textarea>
                            </div>

                            <!-- Struktur Organisasi -->
                            <div class="col-md-12 mb-3">
                                <label>Struktur Organisasi Saat Ini</label><br>
                                <img id="edit-structure-preview"
                                    src="https://via.placeholder.com/300x200?text=Belum+Ada+Gambar"
                                    class="img-fluid rounded mb-2 border" style="max-height:200px;">
                                <input type="file" name="structure_image" class="form-control mt-2">
                            </div>

                            <!-- Foto Kegiatan -->
                            <div class="col-md-12 mb-3">
                                <label>Foto Kegiatan Saat Ini</label><br>
                                <img id="edit-activity-preview"
                                    src="https://via.placeholder.com/300x200?text=Belum+Ada+Gambar"
                                    class="img-fluid rounded mb-2 border" style="max-height:200px;">
                                <input type="file" name="activity_image" class="form-control mt-2">
                            </div>

                            <!-- Video Profil -->
                            <div class="col-md-12 mb-3">
                                <label>Video Profil</label>
                                <input type="url" name="profile_video" id="edit-profile_video" class="form-control"
                                    placeholder="https://www.youtube.com/watch?v=xxxx">
                                <div class="mt-2" id="edit-video-preview">
                                    <small class="text-muted">Belum ada video profil.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================== SCRIPT ======================== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (!empty($_SESSION['flash'])): ?>
        <script>
            Swal.fire({
                icon: '<?= $_SESSION['flash']['type'] ?>',
                title: '<?= $_SESSION['flash']['message'] ?>',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- ======================== SCRIPT EDIT ======================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const baseUrl = window.location.origin;

            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;

                    // Isi form
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-title').value = this.dataset.title || '';
                    document.getElementById('edit-subtitle').value = this.dataset.subtitle || '';
                    document.getElementById('edit-description').value = this.dataset.description || '';
                    document.getElementById('edit-vision').value = this.dataset.vision || '';
                    document.getElementById('edit-mission').value = this.dataset.mission || '';
                    document.getElementById('edit-values').value = this.dataset.values || '';
                    document.getElementById('edit-leader').value = this.dataset.leader || '';
                    document.getElementById('edit-message').value = this.dataset.message || '';
                    document.getElementById('edit-profile_video').value = this.dataset.video || '';

                    // Gambar preview
                    document.getElementById('edit-structure-preview').src = this.dataset.structure
                        ? `${baseUrl}/persyadha.org/uploads/profile/${this.dataset.structure}`
                        : 'https://via.placeholder.com/300x200?text=Belum+Ada+Gambar';

                    document.getElementById('edit-activity-preview').src = this.dataset.activity
                        ? `${baseUrl}/persyadha.org/uploads/profile/${this.dataset.activity}`
                        : 'https://via.placeholder.com/300x200?text=Belum+Ada+Gambar';

                    // Video preview
                    const videoContainer = document.getElementById('edit-video-preview');
                    videoContainer.innerHTML = this.dataset.video
                        ? `<a href="${this.dataset.video}" target="_blank">${this.dataset.video}</a>`
                        : '<small class="text-muted">Belum ada video profil.</small>';

                    // Set form action
                    document.getElementById('editForm').action = `/persyadha.org/manjadmin/profile/update/${id}`;

                    // Tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('editModal'));
                    modal.show();
                });
            });
        });
    </script>

    <!-- ======================== SCRIPT DELETE ======================== -->
    <script>
        document.addEventListener('click', async function (ev) {
            const btn = ev.target.closest('.delete-btn');
            if (!btn) return;

            ev.preventDefault();
            const form = btn.closest('form');
            const id = form.dataset.id;
            const url = form.action;

            const confirm = await Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data profil yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            });

            if (!confirm.isConfirmed) return;

            try {
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                const response = await fetch(url, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (!response.ok) throw new Error('Server error');
                const data = await response.json();
                Swal.close();

                if (data.success) {
                    Swal.fire({ icon: 'success', title: data.message, timer: 1500, showConfirmButton: false });
                    document.getElementById(`row-${id}`)?.remove();
                } else {
                    Swal.fire({ icon: 'error', title: 'Gagal menghapus!', text: data.message || 'Terjadi kesalahan.' });
                }

            } catch (err) {
                Swal.fire({ icon: 'error', title: 'Gagal terhubung ke server!', text: 'Silakan coba lagi nanti.' });
            }
        });
    </script>
</div>