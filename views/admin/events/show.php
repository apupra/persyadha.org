<div class="container mt-5" id="main-content">
    <div class="mb-4 text-start">
        <h2 class="fw-bold">Detail Event</h2>
        <p class="text-muted">Informasi lengkap mengenai event ini.</p>
    </div>

    <?php if (!empty($event)): ?>
        <div class="row g-4">
            <!-- Poster -->
            <div class="col-lg-5 col-md-6 d-flex">
                <div class="card shadow-lg border-0 overflow-hidden poster-card w-100">
                    <?php if (!empty($event['poster'])): ?>
                        <img src="http://<?= $_SERVER['HTTP_HOST'] ?>/persyadha.org/public<?= htmlspecialchars($event['poster']) . '?v=' . time() ?>" 
                             class="card-img-top rounded" 
                             alt="Poster <?= htmlspecialchars($event['title']) ?>" 
                             style="object-fit: cover; width: 100%; height: 100%;">
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center rounded h-100">
                            <span class="text-muted">Tidak ada poster</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Detail Event -->
            <div class="col-lg-7 col-md-6 d-flex">
                <div class="card shadow-lg border-0 p-4 detail-card w-100 d-flex flex-column">
                    <h3 class="fw-bold mb-3"><?= htmlspecialchars($event['title']) ?></h3>

                    <p class="mb-1"><strong>Lokasi:</strong> <?= htmlspecialchars($event['location']) ?></p>
                    <p class="mb-1"><strong>Tanggal:</strong>
                        <?= !empty($event['start_date']) ? date("d M Y", strtotime($event['start_date'])) : '-' ?>
                        <?php if (!empty($event['end_date'])): ?>
                            s/d <?= date("d M Y", strtotime($event['end_date'])) ?>
                        <?php endif; ?>
                    </p>
                    <p class="mb-1"><strong>Jam:</strong>
                        <?= !empty($event['start_time']) ? $event['start_time'] : '-' ?>
                        <?php if (!empty($event['end_time'])): ?>
                            - <?= $event['end_time'] ?>
                        <?php endif; ?>
                    </p>
                    <p class="mb-3"><strong>Status:</strong>
                        <?php if ($event['status'] === 'upcoming'): ?>
                            <span class="badge bg-warning text-dark">Upcoming</span>
                        <?php elseif ($event['status'] === 'ongoing'): ?>
                            <span class="badge bg-info">Ongoing</span>
                        <?php else: ?>
                            <span class="badge bg-success">Done</span>
                        <?php endif; ?>
                    </p>

                    <div class="mb-3 flex-grow-1 overflow-auto">
                        <h5>Deskripsi:</h5>
                        <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
                    </div>

                    <?php if (!empty($event['link_registration'])): ?>
                        <p>
                            <a href="<?= htmlspecialchars($event['link_registration']) ?>" target="_blank" 
                               class="btn btn-success btn-sm text-white">
                                Link Pendaftaran
                            </a>
                        </p>
                    <?php endif; ?>

                    <div class="d-flex gap-2 mt-auto">
                        <a href="/persyadha.org/manjadmin/events/edit/<?= $event['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="/persyadha.org/manjadmin/events" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('.card-img-top').forEach(img => {
                img.addEventListener('mouseover', () => img.style.transform = 'scale(1.05)');
                img.addEventListener('mouseout', () => img.style.transform = 'scale(1)');
            });

            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('mouseover', () => btn.style.transform = 'scale(1.05)');
                btn.addEventListener('mouseout', () => btn.style.transform = 'scale(1)');
            });
        </script>
    <?php else: ?>
        <div class="alert alert-danger">Event tidak ditemukan.</div>
    <?php endif; ?>
</div>
