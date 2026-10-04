<?php

namespace App\Models;

class Post
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
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function latest($limit = 5)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM posts WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

   public static function create($data)
{
    $conn = self::getDB();
    $sql = "INSERT INTO posts (title, category, link, description) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $data['title'], $data['category'], $data['link'], $data['description']);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt) > 0;
}

public static function update($id, $data)
{
    $conn = self::getDB();
    $sql = "UPDATE posts SET title = ?, category = ?, link = ?, description = ? WHERE id = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssi', $data['title'], $data['category'], $data['link'], $data['description'], $id);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt) > 0;
}


    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM posts WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }
}
