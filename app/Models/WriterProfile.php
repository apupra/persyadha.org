<?php

namespace App\Models;

use mysqli;

class WriterProfile
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
        $sql = "SELECT * FROM writer_profiles ORDER BY id DESC";
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
        $stmt = mysqli_prepare($conn, "SELECT * FROM writer_profiles WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    public static function findByAdmin($admin_id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM writer_profiles WHERE admin_id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $admin_id);
        mysqli_stmt_execute($stmt);

        return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    }

    public static function create($data)
    {
        $conn = self::getDB();

        $sql = "INSERT INTO writer_profiles 
                (admin_id, bio, foto_profile, instagram, facebook, is_verified, verified_at)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "issssis",
            $data['admin_id'],
            $data['bio'],
            $data['foto_profile'],
            $data['instagram'],
            $data['facebook'],
            $data['is_verified'],
            $data['verified_at']
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function update($id, $data)
    {
        $conn = self::getDB();

        $sql = "UPDATE writer_profiles 
                SET bio=?, foto_profile=?, instagram=?, facebook=?, is_verified=?, verified_at=? 
                WHERE id=? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssisi",
            $data['bio'],
            $data['foto_profile'],
            $data['instagram'],
            $data['facebook'],
            $data['is_verified'],
            $data['verified_at'],
            $id
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function delete($id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "DELETE FROM writer_profiles WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }

    public static function countAll()
    {
        $conn = self::getDB();
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM writer_profiles");
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];
    }
}
