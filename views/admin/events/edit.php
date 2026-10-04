<div id="main-content" class="container mt-4">
    <div class="page-heading mb-4">
        <h3>Edit Event</h3>
        <p class="text-muted">Ubah data event sesuai kebutuhan.</p>
    </div>

    <div class="card">
        <div class="card-body">
           <form action="/persyadha.org/manjadmin/events/update/<?= $event['id'] ?>" method="POST" enctype="multipart/form-data">
                <!-- Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Event</label>
                    <input type="text" name="title" id="title" 
                           class="form-control" 
                           value="<?= htmlspecialchars($event['title']) ?>" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="4"><?= htmlspecialchars($event['description']) ?></textarea>
                </div>

                <!-- Lokasi -->
                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" name="location" id="location" 
                           class="form-control"
                           value="<?= htmlspecialchars($event['location']) ?>">
                </div>

                <!-- Tanggal Mulai & Selesai -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" 
                               class="form-control" 
                               value="<?= htmlspecialchars($event['start_date']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" 
                               class="form-control"
                               value="<?= htmlspecialchars($event['end_date']) ?>">
                    </div>
                </div>

                <!-- Jam Mulai & Selesai -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="start_time" class="form-label">Jam Mulai</label>
                        <input type="time" name="start_time" id="start_time" 
                               class="form-control"
                               value="<?= htmlspecialchars($event['start_time']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="end_time" class="form-label">Jam Selesai</label>
                        <input type="time" name="end_time" id="end_time" 
                               class="form-control"
                               value="<?= htmlspecialchars($event['end_time']) ?>">
                    </div>
                </div>

                <!-- Poster -->
                <div class="mb-3">
                    <label for="poster" class="form-label">Poster (gambar)</label>
                    <?php if (!empty($event['poster'])): ?>
                        <div class="mb-2">
                           <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/persyadha.org/public<?= htmlspecialchars($event['poster']) . '?v=' . time() ?>"
                                 alt="Poster lama" style="max-height: 120px; object-fit: cover;">
                        </div>
                        <small class="text-muted">Upload file baru jika ingin mengganti poster.</small>
                    <?php endif; ?>
                    <input type="file" name="poster" id="poster" class="form-control" accept="image/*">
                </div>

                <!-- Link Pendaftaran -->
                <div class="mb-3">
                    <label for="link_registration" class="form-label">Link Pendaftaran</label>
                    <input type="url" name="link_registration" id="link_registration" 
                           class="form-control" 
                           value="<?= htmlspecialchars($event['link_registration']) ?>" 
                           placeholder="https://...">
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="upcoming" <?= $event['status'] === 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
                        <option value="ongoing" <?= $event['status'] === 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                        <option value="done" <?= $event['status'] === 'done' ? 'selected' : '' ?>>Done</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="/persyadha.org/manjadmin/events" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
