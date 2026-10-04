<?php
namespace App\Models;

class LembagaCabang
{
    // === Koneksi ke Database ===
    private static function getDB()
    {
        static $conn;
        if (!isset($conn)) {
            include __DIR__ . "/../config/database.php"; // pastikan $db ada di file ini
            $conn = $db;
        }
        return $conn;
    }

    // === Ambil semua data ===
    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM lembaga_cabang ORDER BY nama_cabang ASC";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // === Cari berdasarkan ID ===
    public static function find($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM lembaga_cabang WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // === Simpan data baru ===
    public static function create($data)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "
            INSERT INTO lembaga_cabang (nama_cabang, logo, kota, alamat, telepon, email, website)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        mysqli_stmt_bind_param(
            $stmt,
            "sssssss",
            $data['nama_cabang'],
            $data['logo'],
            $data['kota'],
            $data['alamat'],
            $data['telepon'],
            $data['email'],
            $data['website']
        );
        return mysqli_stmt_execute($stmt);
    }

    // === Update data ===
    public static function update($id, $data)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "
            UPDATE lembaga_cabang SET
                nama_cabang = ?, logo = ?, kota = ?, alamat = ?, telepon = ?, email = ?, website = ?, updated_at = NOW()
            WHERE id = ?
        ");
        mysqli_stmt_bind_param(
            $stmt,
            "sssssssi",
            $data['nama_cabang'],
            $data['logo'],
            $data['kota'],
            $data['alamat'],
            $data['telepon'],
            $data['email'],
            $data['website'],
            $id
        );
        return mysqli_stmt_execute($stmt);
    }

    // === Hapus data ===
    public static function delete($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "DELETE FROM lembaga_cabang WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    // === Ambil semua kota unik ===
    public static function getCities()
    {
        $conn = self::getDB();
        $sql = "SELECT DISTINCT kota FROM lembaga_cabang WHERE kota IS NOT NULL AND kota <> '' ORDER BY kota ASC";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // === Filter berdasarkan kota ===
    public static function byKota($kota)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM lembaga_cabang WHERE kota LIKE ?");
        $search = "%$kota%";
        mysqli_stmt_bind_param($stmt, "s", $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // === Hitung total cabang ===
    public static function total()
    {
        $conn = self::getDB();
        $sql = "SELECT COUNT(*) AS total FROM lembaga_cabang";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result)['total'] ?? 0;
    }
}
