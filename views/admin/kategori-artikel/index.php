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
                    <h3 style="margin-top: 0; margin-bottom: 10px;">Data Kategori Artikel</h3>
                    <p class="text-subtitle text-muted">Daftar kategori artikel yang tersedia</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kategori Artikel</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tabel Kategori Artikel</h5>
                    <a href="/persyadha.org/manjadmin/kategori-artikel/create" class="btn btn-primary btn-sm">
                        + Tambah Kategori Artikel
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($categories)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($categories as $cat): ?>
                                        <tr id="row-<?= $cat['id'] ?>">
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($cat['name']) ?></td>
                                            <td><?= htmlspecialchars($cat['slug']) ?></td>
                                            <td>
                                                <div class="d-flex justify-content gap-1">
                                                    <a href="/persyadha.org/manjadmin/kategori-artikel/edit/<?= $cat['id'] ?>"
                                                        class="btn btn-sm btn-warning rounded-circle" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn" title="Hapus"
                                                        data-id="<?= $cat['id'] ?>"
                                                        data-url="/persyadha.org/manjadmin/kategori-artikel/delete/<?= $cat['id'] ?>">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada kategori artikel.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- SweetAlert2 -->
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

    <!-- Konfirmasi hapus dengan Ajax -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const url = this.dataset.url;

                    Swal.fire({
                        title: 'Apakah Anda yakin ingin menghapus data?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Iya',
                        cancelButtonText: 'Tidak',
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(url, {
                                method: 'POST',
                                headers: { 'X-Requested-With': 'XMLHttpRequest' }
                            })
                                .then(res => res.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: data.success ? 'success' : 'error',
                                        title: data.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    if (data.success) {
                                        const row = document.getElementById(`row-${id}`);
                                        if (row) row.remove();
                                    }
                                })
                                .catch(() => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi kesalahan!',
                                        text: 'Coba lagi nanti.'
                                    });
                                });
                        }
                    });
                });
            });
        });
    </script>
</div>