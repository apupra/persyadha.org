<?php

namespace App\Models;

use mysqli;

class Figure
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

    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM figures ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public static function find($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM figures WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    public static function findBySlug($slug)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM figures WHERE slug = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $slug);
        mysqli_stmt_execute($stmt);

        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    public static function create($data)
    {
        $conn = self::getDB();

        $sql = "INSERT INTO figures (name, slug, photo, biography) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss",
            $data['name'], $data['slug'], $data['photo'], $data['biography']
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE figures SET name=?, slug=?, photo=?, biography=? WHERE id=? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi",
            $data['name'], $data['slug'], $data['photo'], $data['biography'], $id
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function delete($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "DELETE FROM figures WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }

    public static function getPaginated($limit, $offset)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM figures ORDER BY id DESC LIMIT ? OFFSET ?");
        mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $data = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public static function countAll()
    {
        $conn = self::getDB();
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM figures");
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];
    }
}
