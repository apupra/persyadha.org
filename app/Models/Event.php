<?php

namespace App\Models;

use mysqli;

class Event
{
    
    private static function getDB()
    {
        static $conn;
        if (!isset($conn)) {
            // load koneksi
            include __DIR__ . "/../config/database.php";
            $conn = $db; // pastikan return variabel $db dari database.php
        }
        return $conn;
    }

    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM events ORDER BY start_date DESC";
        $result = mysqli_query($conn, $sql);

        $events = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $events[] = $row;
            }
        }
        return $events;
    }

    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM events WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public static function create($data)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO events 
            (title, description, location, start_date, end_date, start_time, end_time, poster, link_registration, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        $title = $data['title'];
        $description = $data['description'];
        $location = $data['location'];
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $poster = $data['poster'];
        $link_registration = $data['link_registration'];
        $status = $data['status'];
        mysqli_stmt_bind_param($stmt, 'ssssssssss', $title, $description, $location, $start_date, $end_date, $start_time, $end_time, $poster, $link_registration, $status);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE events SET 
            title = ?, 
            description = ?, 
            location = ?, 
            start_date = ?, 
            end_date = ?, 
            start_time = ?, 
            end_time = ?, 
            poster = ?, 
            link_registration = ?, 
            status = ? 
            WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        $title = $data['title'];
        $description = $data['description'];
        $location = $data['location'];
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $poster = $data['poster'];
        $link_registration = $data['link_registration'];
        $status = $data['status'];
        mysqli_stmt_bind_param($stmt, 'sssssssssii', $title, $description, $location, $start_date, $end_date, $start_time, $end_time, $poster, $link_registration, $status, $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM events WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }
}

