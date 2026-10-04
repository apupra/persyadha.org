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
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Data Video</h3>
                    <p class="text-subtitle text-muted">Daftar video yang tersedia</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/persyadha.org/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Video</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Video</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        + Tambah Video
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Link</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($videos)): ?>
                                    <?php foreach ($videos as $row): ?>
                                        <tr id="row-<?= $row['id'] ?>">
                                            <td><?= htmlspecialchars(mb_strimwidth(strip_tags($row['title']), 0, 30, '...')) ?>
                                            </td>
                                            <td>
                                                <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank">
                                                    <?= htmlspecialchars(mb_strimwidth(strip_tags($row['link']), 0, 30, '...')) ?>
                                                </a>
                                            </td>
                                            <td><?= htmlspecialchars(mb_strimwidth(strip_tags($row['description']), 0, 40, '...')) ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button type="button" class="btn btn-sm btn-warning rounded-circle edit-btn"
                                                        title="Edit" data-id="<?= $row['id'] ?>"
                                                        data-title="<?= htmlspecialchars($row['title']) ?>"
                                                        data-link="<?= htmlspecialchars($row['link']) ?>"
                                                        data-description="<?= htmlspecialchars($row['description']) ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <form method="POST"
                                                        action="/persyadha.org/manjadmin/videos/destroy/<?= $row['id'] ?>"
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
                                        <td colspan="4" class="text-center text-muted">Belum ada video.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ======================== MODAL CREATE ======================== -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="/persyadha.org/manjadmin/videos/store">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Video Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Link Video</label>
                            <input type="text" name="link" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
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
            <form method="POST" id="editForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Link Video</label>
                            <input type="text" name="link" id="edit-link" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
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

    <!-- Flash message -->
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
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const title = this.dataset.title;
                    const link = this.dataset.link;
                    const description = this.dataset.description;

                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-title').value = title;
                    document.getElementById('edit-link').value = link;
                    document.getElementById('edit-description').value = description;

                    document.getElementById('editForm').action = `/persyadha.org/manjadmin/videos/update/${id}`;

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
                text: 'Data yang sudah dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            });

            if (!confirm.isConfirmed) return;

            try {
                const response = await fetch(url, { method: 'POST' });
                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    document.getElementById(`row-${id}`).remove();
                } else {
                    Swal.fire('Gagal', data.message, 'error');
                }
            } catch (err) {
                Swal.fire('Error', 'Terjadi kesalahan saat menghapus.', 'error');
            }
        });
    </script>
</div>