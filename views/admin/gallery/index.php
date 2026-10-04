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
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Galeri Foto</h3>
                    <p class="text-subtitle text-muted">Kumpulan foto dari para tokoh</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/persyadha.org/manjadmin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- ======================== TABEL GALLERY ======================== -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Galeri</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        + Tambah Foto
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Judul</th>
                                    <th>Tokoh</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($data)): ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr id="row-<?= $row['id'] ?>">

                                            <td>
                                                <?php if (!empty($row['image'])): ?>
                                                    <img src="/persyadha.org/public<?= $row['image'] ?>" width="60" class="rounded">
                                                <?php else: ?>
                                                    <span class="text-muted">Tidak ada foto</span>
                                                <?php endif; ?>
                                            </td>

                                            <td><?= htmlspecialchars($row['title']) ?></td>

                                            <td><?= htmlspecialchars($row['figure_name'] ?? '—') ?></td>

                                            <td><?= mb_strimwidth(strip_tags($row['description']), 0, 80, '...') ?></td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">

                                                    <!-- EDIT BUTTON -->
                                                    <button class="btn btn-sm btn-warning rounded-circle edit-btn"
                                                        data-id="<?= $row['id'] ?>"
                                                        data-title="<?= htmlspecialchars($row['title']) ?>"
                                                        data-figure="<?= htmlspecialchars($row['figure_id']) ?>"
                                                        data-description="<?= htmlspecialchars($row['description']) ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <!-- DELETE -->
                                                    <form method="POST" action="/persyadha.org/manjadmin/gallery/destroy/<?= $row['id'] ?>"
                                                        class="delete-form d-inline" data-id="<?= $row['id'] ?>">
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada foto galeri.</td>
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="/persyadha.org/manjadmin/gallery/store" enctype="multipart/form-data">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Foto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Judul Foto</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tokoh</label>
                            <select name="figure_id" class="form-control" required>
                                <option value="">-- Pilih Tokoh --</option>
                                <?php foreach ($figures as $f): ?>
                                    <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Foto</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editForm" enctype="multipart/form-data">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Foto Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" name="id" id="edit-id">

                        <div class="mb-3">
                            <label>Judul Foto</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tokoh</label>
                            <select name="figure_id" id="edit-figure" class="form-control" required>
                                <?php foreach ($figures as $f): ?>
                                    <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Foto Baru (opsional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" id="edit-description" class="form-control" rows="4"></textarea>
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

    <!-- ======================== FLASH MSG ======================== -->
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

    <!-- ======================== EDIT SCRIPT ======================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {

                    document.getElementById('edit-id').value = this.dataset.id;
                    document.getElementById('edit-title').value = this.dataset.title;
                    document.getElementById('edit-description').value = this.dataset.description;
                    document.getElementById('edit-figure').value = this.dataset.figure;

                    document.getElementById('editForm').action =
                        `/persyadha.org/manjadmin/gallery/update/${this.dataset.id}`;

                    const modal = new bootstrap.Modal(document.getElementById('editModal'));
                    modal.show();
                });
            });
        });
    </script>

    <!-- ======================== DELETE SCRIPT ======================== -->
    <script>
        (function () {
            document.addEventListener('click', async function (ev) {
                const btn = ev.target.closest('.delete-btn');
                if (!btn) return;

                ev.preventDefault();
                const form = btn.closest('form');
                const id = form.dataset.id;

                const confirm = await Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data yang sudah dihapus tidak bisa dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                });

                if (!confirm.isConfirmed) return;

                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                const res = await response.json();
                Swal.close();

                if (res.success) {
                    Swal.fire({ icon: 'success', title: res.message, timer: 1500, showConfirmButton: false });
                    const row = document.getElementById(`row-${id}`);
                    if (row) row.remove();
                } else {
                    Swal.fire({ icon: 'error', title: res.message || 'Gagal menghapus!' });
                }
            });
        })();
    </script>

</div>
