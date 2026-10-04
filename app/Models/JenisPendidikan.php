<?php
namespace App\Models;

class JenisPendidikan
{
    private static function getDB()
    {
        static $conn;
        if (!isset($conn)) {
            include __DIR__ . "/../config/database.php";
            $conn = $db;
        }
        return $conn;
    }

    // Ambil semua data
    public static function all()
    {
        $conn = self::getDB();
        $result = mysqli_query($conn, "SELECT * FROM jenis_pendidikan ORDER BY id ASC");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function find($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM jenis_pendidikan WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Simpan data baru
    public static function create($nama, $keterangan)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "INSERT INTO jenis_pendidikan (nama_jenis, keterangan) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $nama, $keterangan);
        return mysqli_stmt_execute($stmt);
    }

    // Update data
    public static function updateData($id, $nama, $keterangan)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "UPDATE jenis_pendidikan SET nama_jenis = ?, keterangan = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssi", $nama, $keterangan, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Hapus data
    public static function delete($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "DELETE FROM jenis_pendidikan WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}
