<?php

namespace App\Models;

use mysqli;

class Gallery
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
    // GET ALL GALLERY ITEMS
    // ===========================
    public static function all()
    {
        $conn = self::getDB();

        $sql = "SELECT galleries.*, figures.name AS figure_name
                FROM galleries
                LEFT JOIN figures ON figures.id = galleries.figure_id
                ORDER BY galleries.id DESC";

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
    // FIND GALLERY ITEM BY ID
    // ===========================
    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM galleries WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // ===========================
    // FIND ALL IMAGES OF A FIGURE
    // ===========================
    public static function findByFigure($figureId)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM galleries WHERE figure_id = ? ORDER BY id DESC";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $figureId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // ===========================
    // CREATE NEW GALLERY ITEM
    // ===========================
    public static function create($data)
    {
        $conn = self::getDB();

        $sql = "INSERT INTO galleries (figure_id, title, description, image)
                VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        $figureId    = $data['figure_id'];
        $title       = $data['title'];
        $description = $data['description'];
        $image       = $data['image'];

        mysqli_stmt_bind_param($stmt, "isss",
            $figureId, $title, $description, $image
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // ===========================
    // UPDATE GALLERY
    // ===========================
    public static function update($id, $data)
    {
        $conn = self::getDB();

        $sql = "UPDATE galleries SET
                    figure_id = ?,
                    title = ?,
                    description = ?,
                    image = ?
                WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        $figureId    = $data['figure_id'];
        $title       = $data['title'];
        $description = $data['description'];
        $image       = $data['image'];

        mysqli_stmt_bind_param($stmt, "isssi",
            $figureId, $title, $description, $image, $id
        );

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // ===========================
    // DELETE GALLERY ITEM
    // ===========================
    public static function delete($id)
    {
        $conn = self::getDB();

        $sql = "DELETE FROM galleries WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }

    public static function findByFigureId($figure_id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM galleries WHERE figure_id = ? ORDER BY id DESC");
        mysqli_stmt_bind_param($stmt, "i", $figure_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }
}
