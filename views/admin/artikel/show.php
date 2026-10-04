<!-- File: views/admin/artikel/show.php -->
<div id="main-content" class="container mt-4">
    <div class="page-heading mb-4">
        <h3>Detail Artikel</h3>
        <p class="text-muted">Informasi lengkap artikel.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (!empty($artikel)): ?>
                <h4 class="card-title mb-2"><?= htmlspecialchars($artikel['title']) ?></h4>

                <div class="mb-2 text-muted">
                    <strong>Kategori:</strong>
                    <?= !empty($artikel['category_name']) ? htmlspecialchars($artikel['category_name']) : '-' ?>
                    &nbsp;•&nbsp;
                    <strong>Author:</strong>
                    <?= !empty($artikel['author_name']) ? htmlspecialchars($artikel['author_name']) : '-' ?>
                </div>

                <?php if (!empty($artikel['poster'])): ?>
                    <div class="mb-3 text-center">
                        <img src="/persyadha.org/public<?= htmlspecialchars($artikel['poster']) . '?v=' . time() ?>"
                             alt="Poster <?= htmlspecialchars($artikel['title']) ?>"
                             class="img-fluid rounded shadow"
                             style="max-height: 400px; object-fit: contain;">
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <h6>Konten:</h6>
                    <p><?= nl2br(htmlspecialchars($artikel['content'])) ?></p>
                </div>

                <div class="mb-3">
                    <strong>Status:</strong>
                    <span class="badge bg-primary"><?= htmlspecialchars($artikel['status']) ?></span>
                </div>

                <div class="mb-3 text-muted">
                    <small>
                        Dibuat: <?= !empty($artikel['created_at']) ? date('d-m-Y H:i', strtotime($artikel['created_at'])) : '-' ?>
                        &nbsp;•&nbsp;
                        Terakhir: <?= !empty($artikel['updated_at']) ? date('d-m-Y H:i', strtotime($artikel['updated_at'])) : '-' ?>
                    </small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/persyadha.org/manjadmin/artikel" class="btn btn-secondary">Kembali</a>

                    <div>
                        <a href="/persyadha.org/manjadmin/artikel/edit/<?= $artikel['id'] ?>" class="btn btn-warning">Edit</a>

                        <button id="btn-delete" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Artikel tidak tersedia.</div>
                <a href="/persyadha.org/manjadmin/artikel" class="btn btn-secondary">Kembali</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- SweetAlert2 (jika belum ada di footer) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('btn-delete')?.addEventListener('click', function () {
    Swal.fire({
        title: 'Yakin ingin menghapus artikel ini?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Iya, hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6'
    }).then((res) => {
        if (res.isConfirmed) {
            fetch('/persyadha.org/manjadmin/artikel/destroy/<?= $artikel['id'] ?>', {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                Swal.fire({
                    icon: data.success ? 'success' : 'error',
                    title: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                if (data.success) {
                    // kembali ke daftar setelah sukses hapus
                    setTimeout(() => {
                        window.location.href = '/persyadha.org/admin/artikel';
                    }, 800);
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Terjadi kesalahan. Coba lagi nanti.', 'error');
            });
        }
    });
});
</script>
