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
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Data Berita</h3>
                    <p class="text-subtitle text-muted">Daftar berita yang tersedia</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- ======================== TABEL BERITA ======================== -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Berita</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        + Tambah Berita
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Gambar</th>
                                    <th>Link</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($beritas)): ?>
                                    <?php foreach ($beritas as $row): ?>
                                        <tr id="row-<?= $row->id ?>">
                                            <td><?= htmlspecialchars(mb_strimwidth(strip_tags($row->title), 0, 30, '...')) ?>
                                            </td>
                                            <td><?= htmlspecialchars($row->category_name ?? '-') ?></td>
                                            <td>
                                                <?php if (!empty($row->image)): ?>
                                                    <img src="/persyadha.org/public/uploads/berita/<?= htmlspecialchars($row->image) ?>"
                                                        width="80" class="rounded">
                                                <?php else: ?>
                                                    <span class="text-muted">Tidak ada</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($row->link)): ?>
                                                    <a href="<?= htmlspecialchars($row->link) ?>" target="_blank">
                                                        <?= htmlspecialchars(mb_strimwidth($row->link, 0, 25, '...')) ?>
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars(mb_strimwidth(strip_tags($row->description), 0, 40, '...')) ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-sm btn-warning rounded-circle edit-btn"
                                                        data-id="<?= $row->id ?>"
                                                        data-title="<?= htmlspecialchars($row->title) ?>"
                                                        data-description="<?= htmlspecialchars($row->description) ?>"
                                                        data-link="<?= htmlspecialchars($row->link) ?>"
                                                        data-image="<?= htmlspecialchars($row->image) ?>"
                                                        data-category="<?= $row->category_name ?? '' ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <!-- Tombol Delete -->
                                                    <form method="POST"
                                                        action="/persyadha.org/manjadmin/berita/destroy/<?= $row->id ?>"
                                                        class="delete-form d-inline" data-id="<?= $row->id ?>">
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
                                        <td colspan="6" class="text-center text-muted">Belum ada berita.</td>
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
            <form method="POST" action="/persyadha.org/manjadmin/berita/store" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Berita Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label>Link (opsional)</label>
                            <input type="text" name="link" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
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
                        <h5 class="modal-title">Edit Berita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="hidden" name="old_image" id="edit-old-image">

                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="category_id" id="edit-category" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Gambar (opsional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                        </div>

                        <div class="mb-3">
                            <label>Link (opsional)</label>
                            <input type="text" name="link" id="edit-link" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" id="edit-description" class="form-control" rows="3"
                                required></textarea>
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
                    const image = this.dataset.image;
                    const categoryName = this.dataset.category;

                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-title').value = title;
                    document.getElementById('edit-link').value = link;
                    document.getElementById('edit-description').value = description;
                    document.getElementById('edit-old-image').value = image;

                    const categorySelect = document.getElementById('edit-category');
                    for (let opt of categorySelect.options) {
                        if (opt.text === categoryName) {
                            opt.selected = true;
                            break;
                        }
                    }

                    document.getElementById('editForm').action = `/persyadha.org/manjadmin/berita/update/${id}`;

                    const modal = new bootstrap.Modal(document.getElementById('editModal'));
                    modal.show();
                });
            });
        });
    </script>

    <!-- ======================== SCRIPT DELETE ======================== -->
    <script>
        (function () {
            document.addEventListener('click', async function (ev) {
                const btn = ev.target.closest('.delete-btn');
                if (!btn) return;

                ev.preventDefault();

                const form = btn.closest('form');
                if (!form) return;

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
                    Swal.fire({
                        title: 'Menghapus...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    const response = await fetch(url, {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const data = await response.json();
                    Swal.close();

                    if (data.success) {
                        Swal.fire({ icon: 'success', title: data.message, timer: 1500, showConfirmButton: false });
                        const row = document.getElementById(`row-${id}`);
                        if (row) row.remove();
                    } else {
                        Swal.fire({ icon: 'error', title: data.message || 'Gagal menghapus!' });
                    }
                } catch (err) {
                    Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
            });
        })();
    </script>
</div>