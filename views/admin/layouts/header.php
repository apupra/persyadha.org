<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Persyadha</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap & CSS -->
    <link rel="stylesheet" href="/persyadha.org/assets/admin/css/bootstrap.css">

    <link rel="stylesheet" href="/persyadha.org/assets/admin/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="/persyadha.org/assets/admin/vendors/iconly/bold.css">
    <link rel="stylesheet" href="/persyadha.org/assets/admin/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/persyadha.org/assets/admin/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/persyadha.org/assets/admin/css/app.css">

    <link rel="shortcut icon" href="/persyadha.org/assets/frontend/images/persyda.jpg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <?php require(__DIR__ . '/sidebar.php'); ?>

        <!-- MAIN CONTENT -->
        <div id="main" class='layout-navbar'>
            <header class="mb-3">
                <nav class="navbar navbar-expand navbar-light">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <div class="dropdown ms-auto">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">

                                        <!-- Menampilkan NAMA ADMIN -->
                                        <h6 class="mb-0 text-gray-600">
                                            <?= $_SESSION['admin']['name'] ?? 'Admin'; ?>
                                        </h6>

                                        <!-- Menampilkan ROLE ADMIN -->
                                        <p class="mb-0 text-sm text-gray-600">
                                            <?= ucfirst($_SESSION['admin']['role'] ?? 'Operator'); ?>
                                        </p>

                                    </div>

                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="/persyadha.org/assets/admin/images/faces/1.jpg" alt="User Avatar">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="/persyadha.org/"><i
                                            class="icon-mid bi bi-house me-2"></i>
                                        Home</a></li>
                                <li><a class="dropdown-item" href="/persyadha.org/manjadmin/logout"><i
                                            class="icon-mid bi bi-box-arrow-right me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>