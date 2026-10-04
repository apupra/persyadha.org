<div id="main-content" class="container mt-4">
    <div class="page-heading mb-4">
        <h3>Edit Artikel</h3>
        <p class="text-muted">Ubah data artikel sesuai kebutuhan.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="/persyadha.org/manjadmin/artikel/update/<?= $artikel['id'] ?>" method="POST" enctype="multipart/form-data">
                
                <!-- Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Artikel</label>
                    <input type="text" name="title" id="title" class="form-control" 
                           value="<?= htmlspecialchars($artikel['title']) ?>" maxlength="255" required>
                </div>

                <!-- Konten -->
                <div class="mb-3">
                    <label for="content" class="form-label">Konten</label>
                    <textarea name="content" id="content" class="form-control" rows="6" required><?= htmlspecialchars($artikel['content']) ?></textarea>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= $artikel['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Poster -->
                <div class="mb-3">
                    <label for="poster" class="form-label">Poster (gambar)</label>
                    <input type="file" name="poster" id="poster" class="form-control" accept="image/*">
                    <?php if (!empty($artikel['poster'])): ?>
                        <div class="mt-2">
                            <img src="/persyadha.org/public<?= htmlspecialchars($artikel['poster']) ?>" 
                                 alt="Poster" style="max-height: 100px; object-fit: cover;">
                        </div>
                        <input type="hidden" name="old_poster" value="<?= htmlspecialchars($artikel['poster']) ?>">
                    <?php endif; ?>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="draft" <?= $artikel['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="pending" <?= $artikel['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="published" <?= $artikel['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="/persyadha.org/manjadmin/artikel" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
