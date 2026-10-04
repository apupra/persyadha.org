<?php
namespace App\Models;

class PosterPendidikan
{
    // Koneksi database
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
        $sql = "SELECT * FROM poster_pendidikan ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Ambil data aktif saja
    public static function aktif()
    {
        $conn = self::getDB();
        $result = mysqli_query($conn, "SELECT * FROM poster_pendidikan WHERE aktif = 1 ORDER BY id DESC");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Ambil satu data berdasarkan ID
    public static function find($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM poster_pendidikan WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Simpan data baru
    public static function create($data)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, 
            "INSERT INTO poster_pendidikan (gambar, judul, tautan, aktif) 
             VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssi", 
            $data['gambar'], 
            $data['judul'], 
            $data['tautan'], 
            $data['aktif']
        );
        return mysqli_stmt_execute($stmt);
    }

    // Update data
    public static function update($id, $data)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn,
            "UPDATE poster_pendidikan 
             SET gambar = ?, judul = ?, tautan = ?, aktif = ?
             WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sssii", 
            $data['gambar'], 
            $data['judul'], 
            $data['tautan'], 
            $data['aktif'],
            $id
        );
        return mysqli_stmt_execute($stmt);
    }

    // Hapus data
    public static function delete($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "DELETE FROM poster_pendidikan WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }
}
