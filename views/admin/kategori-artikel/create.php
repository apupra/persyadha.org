<div id="main-content" class="container mt-4">
    <div class="page-heading mb-4">
        <h3>Tambah Kategori Artikel</h3>
        <p class="text-muted">Isi form berikut untuk menambahkan kategori artikel baru.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="/persyadha.org/manjadmin/kategori-artikel/store" method="POST">
                
                <!-- Nama Kategori -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control" maxlength="255" required>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" maxlength="255" placeholder="Opsional, otomatis dari nama">
                    <small class="text-muted">Jika dikosongkan, slug akan dibuat otomatis dari nama kategori.</small>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="/persyadha.org/manjadmin/kategori" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
