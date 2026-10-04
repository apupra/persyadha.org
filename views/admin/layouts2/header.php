<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<!DOCTYPE html>
<html lang="id">

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin - Persyarikatan Dakwah Al-Haromain</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .sidebar { transition: width 0.3s ease; }
    .sidebar.collapsed { width: 5rem; }
    .sidebar.collapsed .sidebar-text { display: none; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex">
      <?php require(__DIR__ . '/sidebar.php'); ?>