<div class="container mt-4">
    <h2 class="mb-4">Manajemen Profil</h2>

    <!-- Tombol Tambah -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle"></i> Tambah Profil
    </button>

    <!-- Tabel Data -->
    <table class="table table-bordered align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Subjudul</th>
                <th>Pimpinan</th>
                <th>Struktur</th>
                <th>Aktivitas</th>
                <th>Video Profil</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($profiles as $row): ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['subtitle']) ?></td>
                    <td><?= htmlspecialchars($row['leader_name']) ?></td>
                    <td>
                        <?php if (!empty($row['structure_image'])): ?>
                            <img src="/persyadha.org/public/uploads/profile/<?= htmlspecialchars($row['structure_image']) ?>" width="60">
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($row['activity_image'])): ?>
                            <img src="/persyadha.org/public/uploads/profile/<?= htmlspecialchars($row['activity_image']) ?>" width="60">
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($row['profile_video'])): ?>
                            <a href="<?= htmlspecialchars($row['profile_video']) ?>" target="_blank" class="btn btn-sm btn-outline-info">Lihat</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning rounded-circle edit-btn" title="Edit"
                            data-id="<?= $row['id'] ?>"
                            data-title="<?= htmlspecialchars($row['title']) ?>"
                            data-subtitle="<?= htmlspecialchars($row['subtitle']) ?>"
                            data-leader="<?= htmlspecialchars($row['leader_name']) ?>"
                            data-description="<?= htmlspecialchars($row['description']) ?>"
                            data-vision="<?= htmlspecialchars($row['vision']) ?>"
                            data-mission="<?= htmlspecialchars($row['mission']) ?>"
                            data-values="<?= htmlspecialchars($row['values']) ?>"
                            data-message="<?= htmlspecialchars($row['leader_message']) ?>"
                            data-structure_image="<?= htmlspecialchars($row['structure_image']) ?>"
                            data-activity_image="<?= htmlspecialchars($row['activity_image']) ?>"
                            data-profile_video="<?= htmlspecialchars($row['profile_video']) ?>">
                            <i class="bi bi-pencil"></i>
                        </button>

                        <form method="POST" action="/persyadha.org/manjadmin/profile/delete/<?= $row['id'] ?>" class="d-inline delete-form">
                            <button type="submit" class="btn btn-sm btn-danger rounded-circle" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- ========================== MODAL TAMBAH ========================== -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="/persyadha.org/manjadmin/profile/store">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Subjudul</label>
                        <input type="text" name="subtitle" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Visi</label>
                            <textarea name="vision" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Misi</label>
                            <textarea name="mission" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Nilai</label>
                        <textarea name="values" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Pesan Pimpinan</label>
                        <textarea name="leader_message" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Nama Pimpinan</label>
                        <input type="text" name="leader_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Struktur Organisasi (gambar)</label>
                        <input type="file" name="structure_image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Gambar Aktivitas</label>
                        <input type="file" name="activity_image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Video Profil (URL YouTube)</label>
                        <input type="text" name="profile_video" class="form-control" placeholder="https://youtu.be/...">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================== MODAL EDIT ========================== -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" id="editForm">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">

                    <!-- Hidden input untuk file lama -->
                    <input type="hidden" name="old_structure_image" id="old_structure_image">
                    <input type="hidden" name="old_activity_image" id="old_activity_image">
                    <input type="hidden" name="old_profile_video" id="old_profile_video">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="title" id="edit-title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Subjudul</label>
                        <input type="text" name="subtitle" id="edit-subtitle" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Visi</label>
                            <textarea name="vision" id="edit-vision" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Misi</label>
                            <textarea name="mission" id="edit-mission" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Nilai</label>
                        <textarea name="values" id="edit-values" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Pesan Pimpinan</label>
                        <textarea name="leader_message" id="edit-message" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Nama Pimpinan</label>
                        <input type="text" name="leader_name" id="edit-leader" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Struktur Organisasi</label>
                            <input type="file" name="structure_image" class="form-control">
                            <img id="preview-structure" src="" width="100" class="mt-2 rounded">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Gambar Aktivitas</label>
                            <input type="file" name="activity_image" class="form-control">
                            <img id="preview-activity" src="" width="100" class="mt-2 rounded">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Video Profil (URL)</label>
                            <input type="text" name="profile_video" id="edit-profile_video" class="form-control" placeholder="https://youtu.be/...">
                            <a id="preview-video" href="#" target="_blank" class="btn btn-outline-primary btn-sm mt-2">Lihat Video</a>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Perbarui</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ========================== SCRIPT ========================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = this.dataset.title;
            document.getElementById('edit-subtitle').value = this.dataset.subtitle;
            document.getElementById('edit-description').value = this.dataset.description;
            document.getElementById('edit-vision').value = this.dataset.vision;
            document.getElementById('edit-mission').value = this.dataset.mission;
            document.getElementById('edit-values').value = this.dataset.values;
            document.getElementById('edit-leader').value = this.dataset.leader;
            document.getElementById('edit-message').value = this.dataset.message;

            // Hidden input untuk file lama
            document.getElementById('old_structure_image').value = this.dataset.structure_image || '';
            document.getElementById('old_activity_image').value = this.dataset.activity_image || '';
            document.getElementById('old_profile_video').value = this.dataset.profile_video || '';

            // Preview gambar lama
            document.getElementById('preview-structure').src = this.dataset.structure_image ? `/persyadha.org/public/uploads/profile/${this.dataset.structure_image}` : '';
            document.getElementById('preview-activity').src = this.dataset.activity_image ? `/persyadha.org/public/uploads/profile/${this.dataset.activity_image}` : '';

            // Preview video
            document.getElementById('edit-profile_video').value = this.dataset.profile_video || '';
            document.getElementById('preview-video').href = this.dataset.profile_video || '#';

            // Set form action
            document.getElementById('editForm').action = `/persyadha.org/manjadmin/profile/update/${id}`;

            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        });
    });
});
</script>
