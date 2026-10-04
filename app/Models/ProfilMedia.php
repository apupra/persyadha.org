<?php

namespace App\Models;

use mysqli;

class ProfileMedia
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
        $sql = "SELECT * FROM profile_media ORDER BY created_at DESC";
        $result = mysqli_query($conn, $sql);

        $media = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $media[] = $row;
            }
        }
        return $media;
    }

    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM profile_media WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public static function getByProfile($profile_id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM profile_media WHERE profile_id = ? ORDER BY id ASC";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $profile_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $media = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $media[] = $row;
            }
        }
        return $media;
    }

    public static function create($data)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO profile_media (profile_id, type, title, url, thumbnail) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'issss',
            $data['profile_id'],
            $data['type'],
            $data['title'],
            $data['url'],
            $data['thumbnail']
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE profile_media SET 
            profile_id = ?, 
            type = ?, 
            title = ?, 
            url = ?, 
            thumbnail = ? 
            WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'issssi',
            $data['profile_id'],
            $data['type'],
            $data['title'],
            $data['url'],
            $data['thumbnail'],
            $id
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM profile_media WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }
}
