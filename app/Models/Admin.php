<?php

namespace App\Models;

use mysqli;

class Admin
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
        $sql = "SELECT * FROM admins ORDER BY id DESC";
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
        $stmt = mysqli_prepare($conn, "SELECT * FROM admins WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    public static function findByEmail($email)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM admins WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    public static function create($data)
    {
        $conn = self::getDB();

        $sql = "INSERT INTO admins (name, email, password, role) 
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $data['name'],
            $data['email'],
            $data['password'], // pastikan sudah di-hash bcrypt sebelumnya
            $data['role']
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function update($id, $data)
    {
        $conn = self::getDB();

        $sql = "UPDATE admins SET name=?, email=?, role=? WHERE id=? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $data['name'],
            $data['email'],
            $data['role'],
            $id
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function delete($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "DELETE FROM admins WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }

    public static function getPaginated($limit, $offset)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM admins ORDER BY id DESC LIMIT ? OFFSET ?");
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
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM admins");
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];
    }
}
