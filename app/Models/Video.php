<?php

namespace App\Models;

class Video
{
    private static function getDB()
    {
        static $conn;
        if (!isset($conn)) {
            include __DIR__ . "/../config/database.php";
            $conn = $db; // dari database.php
        }
        return $conn;
    }

    // Ambil semua video terbaru
    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM videos ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Ambil beberapa video terbaru (misalnya 5)
    public static function latest($limit = 5)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM videos ORDER BY created_at DESC LIMIT $limit";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Cari video berdasarkan ID
    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM videos WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah video baru
    public static function create($data)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO videos (title, link, description) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $data['title'], $data['link'], $data['description']);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }

    // Update video
    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE videos SET title = ?, link = ?, description = ? WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $data['title'], $data['link'], $data['description'], $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }

    // Hapus video
    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM videos WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }
}
