<div id="main-content">
    <div class="page-heading" style="margin-top: -30px !important;">
        <div class="page-title">
            <h3 style="margin-top: 0; margin-bottom: 10px;">Dashboard Admin</h3>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Halo, <?= $_SESSION['admin']['username'] ?? 'Admin'; ?>!</h4>
            </div>
            <div class="card-body">
                Anda berhasil login ke Dashboard Admin Persyadha.
            </div>
        </div>
    </section>

    <div class="page-heading">

    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">

                    <!-- Event -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="bi bi-calendar-event-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Event</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_event ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Berita -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="bi bi-newspaper"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Berita</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_berita ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Artikel -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-journal-text"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Artikel</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_artikel ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Video -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="bi bi-play-btn-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Video</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_video ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kitab -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="bi bi-book-half"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Kitab</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_kitab ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Galeri -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="bi bi-images"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Galeri</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_galeri ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tokoh -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="bi bi-person-badge-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Tokoh</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_tokoh ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lembaga Pendidikan -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-building"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Lembaga Pendidikan</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_lembaga_pendidikan ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Unit Kerja -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="bi bi-briefcase-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Unit Kerja</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_unit_kerja ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Unit Kerja Terbaru -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4>Unit Kerja Terbaru</h4>
                                <a href="/persyadha.org/manjadmin/lembaga-cabang" class="btn btn-primary btn-sm">
                                    Selengkapnya
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped align-middle">
                                        <thead>
                                            <tr>
                                                <th>Logo</th>
                                                <th>Nama Cabang</th>
                                                <th>Kota</th>
                                                <th>Website</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php if (!empty($data)): ?>
                                                <?php foreach ($data as $row): ?>
                                                    <tr id="row-<?= $row['id'] ?>">

                                                        <td>
                                                            <?php if (!empty($row['logo'])): ?>
                                                                <img src="/persyadha.org/public/uploads/cabang/<?= htmlspecialchars($row['logo']) ?>"
                                                                    alt="Logo"
                                                                    style="width:50px;height:50px;object-fit:cover;border-radius:5px;">
                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td><?= htmlspecialchars($row['nama_cabang']) ?></td>

                                                        <td><?= htmlspecialchars($row['kota'] ?: '-') ?></td>

                                                        <td>
                                                            <?php if (!empty($row['website'])): ?>
                                                                <a href="<?= htmlspecialchars($row['website']) ?>" target="_blank"
                                                                    class="text-primary">Lihat</a>
                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted">Belum ada data lembaga
                                                        cabang.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>
                                </div>

                                <!-- Tombol Selengkapnya di bawah -->
                                <div class="text-center mt-3">
                                    <a href="/persyadha.org/manjadmin/lembaga-cabang"
                                        class="btn btn-outline-primary btn-sm">
                                        Lihat Semua Unit Kerja
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Event dan Lembaga Pendidikan Terbaru -->
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Event Terbaru</h4>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($events)): ?>
                                    <?php foreach ($events as $row): ?>
                                        <div class="row mb-4 text-center">
                                            <h6 class="fw-bold mb-2">
                                                <?= htmlspecialchars(mb_strimwidth(strip_tags($row['title']), 0, 25, '...')) ?>
                                            </h6>

                                            <div class="col-12">
                                                <?php if (!empty($row['poster'])): ?>
                                                    <img src="/persyadha.org/public<?= htmlspecialchars($row['poster']) . '?v=' . time() ?>"
                                                        alt="Poster <?= htmlspecialchars($row['title']) ?>"
                                                        style="height: 100px; width: 100%; object-fit: cover; border-radius: 10px;">
                                                <?php else: ?>
                                                    <div class="text-muted">Poster tidak tersedia</div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-12 mt-2">
                                                <hr>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-center text-muted">Belum ada event.</p>
                                <?php endif; ?>

                                <div class="text-center mt-2">
                                    <a href="/persyadha.org/manjadmin/events" class="btn btn-primary btn-sm">Lihat
                                        Semua</a>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Lembaga Pendidikan Terbaru</h4>
                                <a href="/persyadha.org/manjadmin/lembaga-pendidikan"
                                    class="btn btn-sm btn-primary">Lihat Semua</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Nama Lembaga</th>
                                                <th>Jenis</th>
                                                <th>Kota</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($lembaga_pendidikan_terbaru)): ?>
                                                <?php foreach ($lembaga_pendidikan_terbaru as $row): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($row['nama_lembaga']) ?></td>
                                                        <td><?= htmlspecialchars($row['nama_jenis'] ?? '-') ?></td>
                                                        <td><?= htmlspecialchars($row['kota'] ?? '-') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">
                                                        Belum ada data lembaga pendidikan terbaru.
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="/persyadha.org/assets/admin/images/faces/1.jpg" alt="Face 1" />
                            </div>
                            <div class="ms-3 name">
                                <!-- Menampilkan NAMA ADMIN -->
                                <h5 class="font-bold">
                                    <?= $_SESSION['admin']['name'] ?? 'Admin'; ?>
                                </h5>

                                <!-- Menampilkan ROLE ADMIN -->
                                <h6 class="text-muted mb-0">
                                    <?= ucfirst($_SESSION['admin']['role'] ?? 'Operator'); ?>
                                </h6>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Admin</h4>
                    </div>

                    <div class="card-content pb-4">
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $row): ?>
                                <div class="recent-message d-flex px-4 py-3 align-items-center">

                                    <!-- Avatar -->
                                    <div class="avatar avatar-lg">
                                        <img src="/persyadha.org/assets/admin/images/faces/<?= rand(1, 6) ?>.jpg" />
                                    </div>

                                    <!-- Data Admin -->
                                    <div class="name ms-4">
                                        <h5 class="mb-1"><?= htmlspecialchars($row['name']) ?></h5>
                                        <!-- <h6 class="text-muted mb-0"><?= htmlspecialchars($row['email']) ?></h6> -->

                                        <!-- Badge role -->
                                        <span class="badge bg-info mt-1">
                                            <?= htmlspecialchars($row['role']) ?>
                                        </span>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center text-muted py-4">Belum ada admin.</p>
                        <?php endif; ?>

                        <?php if ($userRole === 'admin'): ?>
                            <div class="px-4">
                                <a href="/persyadha.org/manjadmin/users"
                                    class="btn btn-block btn-xl btn-light-primary font-bold mt-3">
                                    Kelola Akun
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h4>Visitors Profile</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-visitors-profile"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p><?= date("Y") ?> &copy; Persyadha</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill"></i></span></p>
            </div>
        </div>
    </footer>
</div>