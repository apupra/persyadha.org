<?php

namespace App\Models;

class Berita
{
    private static function getDB()
    {
        static $conn;
        if (!isset($conn)) {
            include __DIR__ . "/../config/database.php";
            $conn = $db; // pastikan $db dari database.php (mysqli_connect)
        }
        return $conn;
    }

    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT b.*, c.name AS category_name 
                FROM berita AS b
                LEFT JOIN berita_categories AS c ON b.category_id = c.id
                ORDER BY b.created_at DESC";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return array_map(fn($r) => (object)$r, $rows);
    }

    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT b.*, c.name AS category_name 
                FROM berita AS b
                LEFT JOIN berita_categories AS c ON b.category_id = c.id
                WHERE b.id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row ? (object)$row : null;
    }

    public static function latest($limit = 5)
    {
        $conn = self::getDB();
        $sql = "SELECT b.*, c.name AS category_name 
                FROM berita AS b
                LEFT JOIN berita_categories AS c ON b.category_id = c.id
                ORDER BY b.created_at DESC 
                LIMIT ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function create($data)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO berita (title, description, image, link, category_id) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            'ssssi',
            $data['title'],
            $data['description'],
            $data['image'],
            $data['link'],
            $data['category_id']
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }

    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE berita 
                SET title = ?, description = ?, image = ?, link = ?, category_id = ? 
                WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            'ssssii',
            $data['title'],
            $data['description'],
            $data['image'],
            $data['link'],
            $data['category_id'],
            $id
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) >= 0; // true meskipun tidak ada perubahan
    }

    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM berita WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }
}
