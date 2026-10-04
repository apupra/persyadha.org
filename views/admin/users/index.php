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
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Manajemen Akun</h3>
                    <p class="text-subtitle text-muted">Admin, Operator & Penulis</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/manjadmin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Akun</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- ======================== TABEL USERS ======================== -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Akun</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        + Tambah Akun
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Dibuat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $row): ?>
                                        <tr id="row-<?= $row['id'] ?>">
                                            <td><?= htmlspecialchars($row['name']) ?></td>
                                            <td><?= htmlspecialchars($row['email']) ?></td>
                                            <td>
                                                <span class="badge bg-info text-dark">
                                                    <?= htmlspecialchars($row['role']) ?>
                                                </span>
                                            </td>
                                            <td><?= htmlspecialchars($row['created_at']) ?></td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <!-- Edit -->
                                                    <button 
                                                        class="btn btn-sm btn-warning rounded-circle edit-btn"
                                                        data-id="<?= $row['id'] ?>"
                                                        data-name="<?= htmlspecialchars($row['name']) ?>"
                                                        data-email="<?= htmlspecialchars($row['email']) ?>"
                                                        data-role="<?= htmlspecialchars($row['role']) ?>"
                                                    >
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <!-- Delete -->
                                                    <form method="POST" 
                                                          action="/persyadha.org/manjadmin/users/delete/<?= $row['id'] ?>" 
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
                                        <td colspan="5" class="text-center text-muted">Belum ada akun.</td>
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
            <form method="POST" action="/persyadha.org/manjadmin/users/store">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                                <option value="penulis">Penulis</option>
                            </select>
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
            <form method="POST" id="editForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" id="edit-role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                                <option value="penulis">Penulis</option>
                            </select>
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

    <!-- Edit Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {

                    document.getElementById('edit-id').value = this.dataset.id;
                    document.getElementById('edit-name').value = this.dataset.name;
                    document.getElementById('edit-email').value = this.dataset.email;
                    document.getElementById('edit-role').value = this.dataset.role;

                    document.getElementById('editForm').action =
                        `/persyadha.org/manjadmin/users/update/${this.dataset.id}`;

                    new bootstrap.Modal(document.getElementById('editModal')).show();
                });
            });
        });
    </script>

    <!-- Delete Script -->
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
                    text: 'Data yang dihapus tidak bisa dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
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

                    const res = await response.json();
                    Swal.close();

                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        const row = document.getElementById(`row-${id}`);
                        if (row) row.remove();

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: res.message || 'Gagal menghapus!'
                        });
                    }

                } catch (err) {
                    Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
            });
        })();
    </script>

</div>
