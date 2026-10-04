<?php

namespace App\Models;

use mysqli;

class Profile
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
        $sql = "SELECT * FROM profiles ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        $profiles = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $profiles[] = $row;
            }
        }
        return $profiles;
    }

     public static function first()
    {
        $db = self::getDB();
        $query = $db->query("SELECT * FROM profiles ORDER BY id ASC LIMIT 1");
        return $query->fetch_assoc();
    }

    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM profiles WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public static function latest()
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM profiles ORDER BY updated_at DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public static function create($data)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO profiles 
            (title, subtitle, description, vision, mission, `values`, leader_message, leader_name, structure_image, profile_video, activity_image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'sssssssssss',
            $data['title'],
            $data['subtitle'],
            $data['description'],
            $data['vision'],
            $data['mission'],
            $data['values'],
            $data['leader_message'],
            $data['leader_name'],
            $data['structure_image'],
            $data['profile_video'],
            $data['activity_image']
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE profiles SET 
            title = ?, 
            subtitle = ?, 
            description = ?, 
            vision = ?, 
            mission = ?, 
            `values` = ?, 
            leader_message = ?, 
            leader_name = ?, 
            structure_image = ?, 
            profile_video = ?, 
            activity_image = ? 
            WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            'sssssssssssi',
            $data['title'],
            $data['subtitle'],
            $data['description'],
            $data['vision'],
            $data['mission'],
            $data['values'],
            $data['leader_message'],
            $data['leader_name'],
            $data['structure_image'],
            $data['profile_video'],
            $data['activity_image'],
            $id
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM profiles WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }
}
