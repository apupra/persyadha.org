<div id="main-content" class="container mt-4">
    <div class="page-heading mb-4">
        <h3>Edit Kategori Artikel</h3>
        <p class="text-muted">Ubah data kategori artikel sesuai kebutuhan.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="/persyadha.org/manjadmin/kategori-artikel/update/<?= $category['id'] ?>" method="POST">
                
                <!-- Nama Kategori -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control" 
                           value="<?= htmlspecialchars($category['name']) ?>" maxlength="255" required>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" 
                           value="<?= htmlspecialchars($category['slug']) ?>" maxlength="255" placeholder="Opsional">
                    <small class="text-muted">Slug bisa dikosongkan, otomatis dibuat dari nama kategori.</small>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="/persyadha.org/manjadmin/kategori" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
