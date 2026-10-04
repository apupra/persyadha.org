<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "web-persyadha";

// Membuat koneksi ke database
$db = mysqli_connect($host, $user, $pass, $db_name);

// Cek koneksi
if (!$db) {
    die("Gagal terhubung ke database: " . mysqli_connect_error());
}
?>
