<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persyada Al Haromain</title>
    <!-- Memuatkan Google Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Memuatkan Tailwind CSS untuk reka bentuk yang moden dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuatkan Font Awesome untuk ikon-ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/persyadha.org/assets/frontend/images/persyda.jpg" type="image/x-icon">
    <style>
        /* Mendefinisikan warna kustom untuk tema hijau tua dan hijau aksen */
        :root {
            --dark-green: #003333;
            --accent-green: #33CCCC;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .text-green-main {
            color: var(--dark-green);
        }

        .bg-green-main {
            background-color: var(--dark-green);
        }

        .hover\:text-green-accent:hover {
            color: var(--accent-green);
        }

        /* Style untuk pop-up dropdown */
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 50;
            border-radius: 0.5rem;
            padding: 0.5rem;
        }

        .dropdown-item a {
            display: block;
            padding: 0.5rem 1rem;
            color: var(--dark-green);
            transition: background-color 0.3s;
        }

        .dropdown-item a:hover {
            background-color: #f0f0f0;
            border-radius: 0.375rem;
        }

        /* Style untuk pop-up tanggal dan waktu */
        .date-time-box,
        .language-box {
            top: 100%;
            right: 0;
            display: none;
        }

        /* Style untuk kotak pencarian (dikembalikan ke versi awal) */
        .search-box {
            position: absolute;
            top: 100%;
            right: 0;
            width: 320px;
            padding: 1rem;
            background-color: white;
            z-index: 40;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
            /* Default hidden */
            border-radius: 0.75rem;
        }

        @media (max-width: 767px) {
            .search-box {
                width: 100%;
                /* Lebar penuh di perangkat seluler */
                left: 0;
            }
        }

        /* Kontainer untuk poster yang akan digulir secara horizontal */
        .poster-wrapper {
            display: flex;
        }

        .poster-item {
            flex-shrink: 0;
            width: 100%;
        }

        .video-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        /* Kelas untuk menonaktifkan transisi */
        .no-transition {
            transition: none !important;
        }

        @media (min-width: 768px) {
            .video-grid {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        .video-main {
            grid-column: span 2;
            grid-row: span 2;
        }

        /* Menggunakan objek-fit cover untuk memastikan video mengisi ruang tanpa distorsi */
        video {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        /* Mengubah warna teks pada mode malam */
        .dark .bg-gray-100 {
            background-color: #1a202c;
        }

        .dark .bg-white {
            background-color: #2d3748;
        }

        .dark .text-gray-800 {
            color: #e2e8e0;
        }

        .dark .text-gray-600 {
            color: #a0aec0;
        }

        .dark .text-gray-700 {
            color: #cbd5e0;
        }

        .dark .bg-gray-200 {
            background-color: #4a5568;
        }
    </style>

    
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-500">

<?php require(__DIR__ . '/navbar.php'); ?>