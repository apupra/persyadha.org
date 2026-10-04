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
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Lembaga Cabang</h3>
                    <p class="text-subtitle text-muted">Daftar lembaga cabang yang terdaftar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lembaga Cabang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- ======================== TABEL LEMBAGA CABANG ======================== -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Lembaga Cabang</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        + Tambah Cabang
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Cabang</th>
                                    <th>Logo</th>
                                    <th>Kota</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data)): ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr id="row-<?= $row['id'] ?>">
                                            <td><?= htmlspecialchars($row['nama_cabang']) ?></td>
                                            <td>
                                                <?php if (!empty($row['logo'])): ?>
                                                    <img src="/persyadha.org/public/uploads/cabang/<?= htmlspecialchars($row['logo']) ?>"
                                                         alt="Logo" style="width:50px;height:50px;object-fit:cover;">
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row['kota'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['alamat'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['telepon'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['email'] ?? '-') ?></td>
                                            <td>
                                                <?php if (!empty($row['website'])): ?>
                                                    <a href="<?= htmlspecialchars($row['website']) ?>" target="_blank" class="text-primary">Lihat</a>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-sm btn-warning rounded-circle edit-btn"
                                                        data-id="<?= $row['id'] ?>"
                                                        data-nama="<?= htmlspecialchars($row['nama_cabang']) ?>"
                                                        data-kota="<?= htmlspecialchars($row['kota']) ?>"
                                                        data-alamat="<?= htmlspecialchars($row['alamat']) ?>"
                                                        data-telepon="<?= htmlspecialchars($row['telepon']) ?>"
                                                        data-email="<?= htmlspecialchars($row['email']) ?>"
                                                        data-website="<?= htmlspecialchars($row['website']) ?>"
                                                        data-logo="<?= htmlspecialchars($row['logo']) ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <form method="POST"
                                                        action="/persyadha.org/manjadmin/lembaga-cabang/hapus/<?= $row['id'] ?>"
                                                        class="delete-form d-inline" data-id="<?= $row['id'] ?>">
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Belum ada data lembaga cabang.</td>
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
            <form method="POST" action="/persyadha.org/manjadmin/lembaga-cabang/simpan" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Lembaga Cabang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Cabang</label>
                            <input type="text" name="nama_cabang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Kota</label>
                            <input type="text" name="kota" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control" placeholder="https://example.com">
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
            <form method="POST" id="editForm" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Lembaga Cabang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label>Nama Cabang</label>
                            <input type="text" name="nama_cabang" id="edit-nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Logo</label>
                            <input type="file" name="logo" class="form-control">
                            <input type="hidden" name="logo_lama" id="edit-logo-lama">
                        </div>
                        <div class="mb-3">
                            <label>Kota</label>
                            <input type="text" name="kota" id="edit-kota" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" id="edit-alamat" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Telepon</label>
                            <input type="text" name="telepon" id="edit-telepon" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Website</label>
                            <input type="text" name="website" id="edit-website" class="form-control">
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
</div>

<!-- ======================== SCRIPT SWEETALERT2 ======================== -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Flash message -->
<?php if (!empty($_SESSION['flash'])): ?>
<script>
    Swal.fire({
        icon: '<?= $_SESSION['flash']['type'] ?>', // 'success', 'error', 'warning', 'info'
        title: '<?= $_SESSION['flash']['message'] ?>',
        timer: 2000,
        showConfirmButton: false
    });
</script>
<?php unset($_SESSION['flash']); ?>
<?php endif; ?>

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
                Swal.fire({ icon: 'error', title: data.message || 'Gagal menghapus!' });
            }
        } catch (err) {
            Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
        }
    });
})();
</script>


<!-- ======================== SCRIPT EDIT ======================== -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('edit-id').value = this.dataset.id;
            document.getElementById('edit-nama').value = this.dataset.nama;
            document.getElementById('edit-kota').value = this.dataset.kota;
            document.getElementById('edit-alamat').value = this.dataset.alamat;
            document.getElementById('edit-telepon').value = this.dataset.telepon;
            document.getElementById('edit-email').value = this.dataset.email;
            document.getElementById('edit-website').value = this.dataset.website;
            document.getElementById('edit-logo-lama').value = this.dataset.logo ?? '';

            document.getElementById('editForm').action = `/persyadha.org/manjadmin/lembaga-cabang/update/${this.dataset.id}`;
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        });
    });
});
</script>
