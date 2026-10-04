<?php

namespace App\Models;

use mysqli;

class Download
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

    // ===========================
    // GET ALL DOWNLOADS
    // ===========================
    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT downloads.*, figures.name AS figure_name 
                FROM downloads
                LEFT JOIN figures ON figures.id = downloads.figure_id
                ORDER BY downloads.id DESC";

        $result = mysqli_query($conn, $sql);

        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    // ===========================
    // FIND DOWNLOAD BY ID
    // ===========================
    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM downloads WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // ===========================
    // FIND DOWNLOADS BY FIGURE
    // ===========================
    public static function findByFigure($figureId)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM downloads WHERE figure_id = ? ORDER BY id DESC";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $figureId);
        mysqli_stmt_execute($stmt);

        $res = mysqli_stmt_get_result($stmt);

        $data = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $data[] = $row;
        }

        return $data;
    }

    // ===========================
    // CREATE DOWNLOAD
    // ===========================
    public static function create($data)
    {
        $conn = self::getDB();

        $sql = "INSERT INTO downloads (figure_id, type, title, description, drive_link)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        $figureId   = $data['figure_id'];
        $type       = $data['type'];
        $title      = $data['title'];
        $description = $data['description'];
        $driveLink  = $data['drive_link'];

        mysqli_stmt_bind_param($stmt, "issss", 
            $figureId, $type, $title, $description, $driveLink
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // ===========================
    // UPDATE DOWNLOAD
    // ===========================
    public static function update($id, $data)
    {
        $conn = self::getDB();

        $sql = "UPDATE downloads SET 
                    figure_id = ?, 
                    type = ?, 
                    title = ?, 
                    description = ?, 
                    drive_link = ?
                WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        $figureId   = $data['figure_id'];
        $type       = $data['type'];
        $title      = $data['title'];
        $description = $data['description'];
        $driveLink  = $data['drive_link'];

        mysqli_stmt_bind_param($stmt, "issssi",
            $figureId, $type, $title, $description, $driveLink, $id
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // ===========================
    // DELETE DOWNLOAD
    // ===========================
    public static function delete($id)
    {
        $conn = self::getDB();

        $sql = "DELETE FROM downloads WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }
}
