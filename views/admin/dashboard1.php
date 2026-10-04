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
                Selamat datang di Dashboard Admin Persyadha.
            </div>
        </div>
    </section>

    <div class="page-content">
        <section class="row">
            <!-- Ubah dari col-lg-9 menjadi col-12 agar full width -->
            <div class="col-12">
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

                    <!-- Postingan -->
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="bi bi-megaphone-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Postingan</h6>
                                        <h6 class="font-extrabold mb-0"><?= $total_post ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Pengunjung -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Statistik Pengunjung</h4>
                        <p class="text-muted mb-0">Grafik kunjungan akan tampil di sini.</p>
                    </div>
                    <div class="card-body">
                        <div id="chart-profile-visit"></div>
                    </div>
                </div>

                <!-- Tambahan data lain jika dibutuhkan -->
                <!-- Contoh: daftar artikel terbaru atau log aktivitas -->
                <!-- <div class="card mt-4">
                    <div class="card-header"><h4>Artikel Terbaru</h4></div>
                    <div class="card-body">...</div>
                </div> -->
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
