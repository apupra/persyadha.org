<div id="main-content" class="container mt-4">
    <div class="page-heading mb-4">
        <h3>Tambah Artikel Baru</h3>
        <p class="text-muted">Isi form berikut untuk menambahkan artikel baru.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="/persyadha.org/manjadmin/artikel/store" method="POST" enctype="multipart/form-data">
                
                <!-- Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Artikel</label>
                    <input type="text" name="title" id="title" class="form-control" maxlength="255" required>
                </div>

                <!-- Konten -->
                <div class="mb-3">
                    <label for="content" class="form-label">Konten</label>
                    <textarea name="content" id="content" class="form-control" rows="6" required></textarea>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Poster -->
                <div class="mb-3">
                    <label for="poster" class="form-label">Poster (gambar)</label>
                    <input type="file" name="poster" id="poster" class="form-control" accept="image/*">
                    <small class="text-muted">Opsional. Format yang didukung: JPG, PNG, GIF</small>
                </div>

                <!-- Status 
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="draft" selected>Draft</option>
                        <option value="pending">Pending</option>
                        <option value="published">Published</option>
                    </select>
                </div> -->

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="/persyadha.org/manjadmin/artikel" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
