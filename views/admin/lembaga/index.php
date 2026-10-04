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
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Lembaga Pendidikan</h3>
                    <p class="text-subtitle text-muted">Daftar lembaga pendidikan yang terdaftar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lembaga Pendidikan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- ======================== TABEL LEMBAGA PENDIDIKAN ======================== -->
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Lembaga Pendidikan</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        + Tambah Lembaga
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>Nama Lembaga</th>
                                    <th>Jenis Pendidikan</th>
                                    <th>Jenjang</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Kontak</th>
                                    <th>Website</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data)): ?>
                                    <?php foreach ($data as $row): ?>
                                        <tr id="row-<?= $row['id'] ?>">
                                            <td><?= htmlspecialchars($row['nama_lembaga']) ?></td>
                                            <td><?= htmlspecialchars($row['nama_jenis'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['jenjang'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['alamat'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['kota'] ?? '-') ?></td>
                                            <td><?= htmlspecialchars($row['kontak'] ?? '-') ?></td>
                                            <td>
                                                <?php if (!empty($row['website'])): ?>
                                                    <a href="<?= htmlspecialchars($row['website']) ?>" target="_blank"
                                                        class="text-primary">
                                                        Lihat
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php if ($row['aktif']): ?>
                                                    <span class="badge bg-success">Aktif</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Nonaktif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <button class="btn btn-sm btn-warning rounded-circle edit-btn"
                                                        data-id="<?= $row['id'] ?>"
                                                        data-nama="<?= htmlspecialchars($row['nama_lembaga']) ?>"
                                                        data-jenis="<?= htmlspecialchars($row['jenis_pendidikan_id']) ?>"
                                                        data-jenjang="<?= htmlspecialchars($row['jenjang']) ?>"
                                                        data-alamat="<?= htmlspecialchars($row['alamat']) ?>"
                                                        data-kota="<?= htmlspecialchars($row['kota']) ?>"
                                                        data-kontak="<?= htmlspecialchars($row['kontak']) ?>"
                                                        data-website="<?= htmlspecialchars($row['website']) ?>"
                                                        data-aktif="<?= htmlspecialchars($row['aktif']) ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <form method="POST"
                                                        action="/persyadha.org/manjadmin/lembaga-pendidikan/hapus/<?= $row['id'] ?>"
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
                                        <td colspan="9" class="text-center text-muted">Belum ada data lembaga pendidikan.
                                        </td>
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
            <form method="POST" action="/persyadha.org/manjadmin/lembaga-pendidikan/simpan">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Lembaga Pendidikan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Lembaga</label>
                            <input type="text" name="nama_lembaga" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Jenis Pendidikan</label>
                            <select name="jenis_pendidikan_id" class="form-select" required>
                                <option value="">-- Pilih Jenis Pendidikan --</option>
                                <?php
                                include_once __DIR__ . "/../../../models/JenisPendidikan.php";
                                use App\Models\JenisPendidikan;
                                $jenisList = JenisPendidikan::all();
                                foreach ($jenisList as $j):
                                    ?>
                                    <option value="<?= $j['id'] ?>"><?= htmlspecialchars($j['nama_jenis']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Jenjang</label>
                            <input type="text" name="jenjang" class="form-control"
                                placeholder="Contoh: SD, SMP, SMA, Universitas" required>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Kota</label>
                            <input type="text" name="kota" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" placeholder="No. HP atau Telepon">
                        </div>

                        <div class="mb-3">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control" placeholder="https://example.com">
                        </div>

                        <div class="mb-3">
                            <label>Status Aktif</label>
                            <select name="aktif" class="form-select">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Lembaga Pendidikan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label>Nama Lembaga</label>
                            <input type="text" name="nama_lembaga" id="edit-nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Jenis Pendidikan</label>
                            <select name="jenis_pendidikan_id" id="edit-jenis" class="form-select" required>
                                <option value="">-- Pilih Jenis Pendidikan --</option>
                                <?php foreach ($jenisList as $j): ?>
                                    <option value="<?= $j['id'] ?>"><?= htmlspecialchars($j['nama_jenis']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Jenjang</label>
                            <input type="text" name="jenjang" id="edit-jenjang" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" id="edit-alamat" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Kota</label>
                            <input type="text" name="kota" id="edit-kota" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Kontak</label>
                            <input type="text" name="kontak" id="edit-kontak" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Website</label>
                            <input type="text" name="website" id="edit-website" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Status Aktif</label>
                            <select name="aktif" id="edit-aktif" class="form-select">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
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

    <!-- ======================== SCRIPT EDIT ======================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('edit-id').value = this.dataset.id;
                    document.getElementById('edit-nama').value = this.dataset.nama;
                    document.getElementById('edit-jenis').value = this.dataset.jenis;
                    document.getElementById('edit-jenjang').value = this.dataset.jenjang;
                    document.getElementById('edit-alamat').value = this.dataset.alamat;
                    document.getElementById('edit-kota').value = this.dataset.kota;
                    document.getElementById('edit-kontak').value = this.dataset.kontak;
                    document.getElementById('edit-website').value = this.dataset.website;
                    document.getElementById('edit-aktif').value = this.dataset.aktif;
                    document.getElementById('editForm').action = `/persyadha.org/manjadmin/lembaga-pendidikan/update/${this.dataset.id}`;

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