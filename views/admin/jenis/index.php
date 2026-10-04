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
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Jenis Pendidikan</h3>
                    <p class="text-subtitle text-muted">Daftar jenis pendidikan yang tersedia</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Jenis Pendidikan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- ======================== TABEL JENIS PENDIDIKAN ======================== -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Jenis Pendidikan</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        + Tambah Jenis
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Dibuat</th>
                                    <th>Diperbarui</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data)): ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr id="row-<?= $row['id'] ?>">
                                            <td><?= htmlspecialchars($row['nama_jenis']) ?></td>
                                            <td><?= htmlspecialchars($row['keterangan'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['dibuat_pada']) ?></td>
                                            <td><?= htmlspecialchars($row['diperbarui_pada']) ?></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-sm btn-warning rounded-circle edit-btn"
                                                        data-id="<?= $row['id'] ?>"
                                                        data-nama="<?= htmlspecialchars($row['nama_jenis']) ?>"
                                                        data-keterangan="<?= htmlspecialchars($row['keterangan'] ?? '') ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <form method="POST"
                                                        action="/persyadha.org/manjadmin/jenis-pendidikan/hapus/<?= $row['id'] ?>"
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
                                        <td colspan="5" class="text-center text-muted">Belum ada data jenis pendidikan.</td>
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
        <div class="modal-dialog">
            <form method="POST" action="/persyadha.org/manjadmin/jenis-pendidikan/simpan">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jenis Pendidikan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Jenis</label>
                            <input type="text" name="nama_jenis" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3"></textarea>
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
        <div class="modal-dialog">
            <form method="POST" id="editForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Jenis Pendidikan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label>Nama Jenis</label>
                            <input type="text" name="nama_jenis" id="edit-nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Keterangan</label>
                            <textarea name="keterangan" id="edit-keterangan" class="form-control" rows="3"></textarea>
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
                    const nama = this.dataset.nama;
                    const keterangan = this.dataset.keterangan;

                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-nama').value = nama;
                    document.getElementById('edit-keterangan').value = keterangan;
                    document.getElementById('editForm').action = `/persyadha.org/manjadmin/jenis-pendidikan/update/${id}`;

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

                    // Jika respons bukan JSON valid, hentikan
                    if (!response.ok) throw new Error('Server error');

                    const data = await response.json();
                    Swal.close();

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        const row = document.getElementById(`row-${id}`);
                        if (row) row.remove();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menghapus!',
                            text: data.message || 'Data tidak dapat dihapus karena masih digunakan oleh lembaga pendidikan lain.'
                        });
                    }

                } catch (err) {
                    // Tangani error koneksi atau error dari PHP
                    Swal.fire({
                        icon: 'error',
                        title: 'Data tidak dapat dihapus!',
                        text: 'Kemungkinan data masih digunakan oleh lembaga pendidikan lain.'
                    });
                }
            });
        })();
    </script>

</div>