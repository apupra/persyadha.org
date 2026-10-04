<?php
namespace App\Models;

class LembagaPendidikan
{
    // === Koneksi ke Database ===
    private static function getDB()
    {
        static $conn;
        if (!isset($conn)) {
            include __DIR__ . "/../config/database.php";
            $conn = $db;
        }
        return $conn;
    }

    // === Ambil semua data ===
    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT lp.*, jp.nama_jenis 
                FROM lembaga_pendidikan lp
                LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
                ORDER BY lp.nama_lembaga ASC";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // === Cari berdasarkan ID ===
    public static function find($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare(
            $conn,
            "SELECT lp.*, jp.nama_jenis 
             FROM lembaga_pendidikan lp
             LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
             WHERE lp.id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // === Simpan data baru ===
    public static function create($data)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO lembaga_pendidikan 
            (nama_lembaga, jenis_pendidikan_id, alamat, kota, jenjang, kontak, website, aktif)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sisssssi",
            $data['nama_lembaga'],
            $data['jenis_pendidikan_id'],
            $data['alamat'],
            $data['kota'],
            $data['jenjang'],
            $data['kontak'],
            $data['website'],
            $data['aktif']
        );

        return mysqli_stmt_execute($stmt);
    }

    // === Update data ===
    public static function update($id, $data)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE lembaga_pendidikan 
             SET nama_lembaga = ?, jenis_pendidikan_id = ?, alamat = ?, kota = ?, 
                 jenjang = ?, kontak = ?, website = ?, aktif = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sisssssii",
            $data['nama_lembaga'],
            $data['jenis_pendidikan_id'],
            $data['alamat'],
            $data['kota'],
            $data['jenjang'],
            $data['kontak'],
            $data['website'],
            $data['aktif'],
            $id
        );

        return mysqli_stmt_execute($stmt);
    }

    // === Hapus data ===
    public static function delete($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "DELETE FROM lembaga_pendidikan WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    // === Filter berdasarkan kota ===
    // === Ambil semua kota unik ===
    public static function getCities()
    {
        $conn = self::getDB();
        $sql = "SELECT DISTINCT kota FROM lembaga_pendidikan WHERE kota IS NOT NULL AND kota <> '' ORDER BY kota ASC";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // === Filter berdasarkan kota ===
    public static function byKota($kota)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "
            SELECT lp.*, jp.nama_jenis 
            FROM lembaga_pendidikan lp
            LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
            WHERE lp.kota LIKE ?
        ");
        $search = "%$kota%";
        mysqli_stmt_bind_param($stmt, "s", $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // === Filter berdasarkan jenis ===
    public static function byJenis($namaJenis)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "
            SELECT lp.*, jp.nama_jenis 
            FROM lembaga_pendidikan lp
            LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
            WHERE jp.nama_jenis = ?
        ");
        mysqli_stmt_bind_param($stmt, "s", $namaJenis);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // === Filter kombinasi kota + jenis ===
    public static function filterByCityAndType($kota, $namaJenis)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "
            SELECT lp.*, jp.nama_jenis 
            FROM lembaga_pendidikan lp
            LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
            WHERE lp.kota = ? AND jp.nama_jenis = ?
        ");
        mysqli_stmt_bind_param($stmt, "ss", $kota, $namaJenis);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // === Statistik per jenis ===
    public static function countByJenis()
    {
        $conn = self::getDB();
        $sql = "
            SELECT jp.nama_jenis, COUNT(lp.id) AS total
            FROM lembaga_pendidikan lp
            LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
            GROUP BY jp.nama_jenis
        ";
        $result = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[$row['nama_jenis']] = $row['total'];
        }
        return $data;
    }

    // === Hitung total lembaga ===
    public static function total()
    {
        $conn = self::getDB();
        $sql = "SELECT COUNT(*) AS total FROM lembaga_pendidikan";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result)['total'] ?? 0;
    }

    public static function byJenisId($jenisId)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "
        SELECT lp.*, jp.nama_jenis 
        FROM lembaga_pendidikan lp
        LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
        WHERE lp.jenis_pendidikan_id = ?
    ");
        mysqli_stmt_bind_param($stmt, "i", $jenisId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function paginate($limit, $offset)
    {
        $conn = self::getDB();
        $sql = "SELECT lp.*, jp.nama_jenis 
            FROM lembaga_pendidikan lp
            LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
            ORDER BY lp.nama_lembaga ASC
            LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function paginateFiltered($limit, $offset, $city, $type)
    {
        $conn = self::getDB();

        $conditions = [];
        if (!empty($city)) {
            $conditions[] = "lp.kota LIKE '%" . mysqli_real_escape_string($conn, $city) . "%'";
        }
        if (!empty($type)) {
            $conditions[] = "jp.nama_jenis = '" . mysqli_real_escape_string($conn, $type) . "'";
        }

        $where = count($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

        $sql = "SELECT lp.*, jp.nama_jenis 
            FROM lembaga_pendidikan lp
            LEFT JOIN jenis_pendidikan jp ON lp.jenis_pendidikan_id = jp.id
            $where
            ORDER BY lp.nama_lembaga ASC
            LIMIT $limit OFFSET $offset";

        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function countFiltered($city, $type)
    {
        $conn = self::getDB();

        $conditions = [];
        if (!empty($city)) {
            $conditions[] = "kota LIKE '%" . mysqli_real_escape_string($conn, $city) . "%'";
        }
        if (!empty($type)) {
            $conditions[] = "jenis_pendidikan_id IN (SELECT id FROM jenis_pendidikan WHERE nama_jenis = '" . mysqli_real_escape_string($conn, $type) . "')";
        }
        $where = count($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

        $sql = "SELECT COUNT(*) AS total FROM lembaga_pendidikan $where";

        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result)['total'] ?? 0;
    }



}
