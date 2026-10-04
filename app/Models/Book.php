<?php

namespace App\Models;

use mysqli;

class Book
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
    // GET ALL BOOKS
    // ===========================
    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT books.*, figures.name AS figure_name 
                FROM books 
                LEFT JOIN figures ON figures.id = books.figure_id
                ORDER BY books.id DESC";
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
    // FIND BOOK BY ID
    // ===========================
    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM books WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // ===========================
    // FIND ALL BOOKS OF A FIGURE
    // ===========================
    public static function findByFigure($figureId)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM books WHERE figure_id = ? ORDER BY year DESC";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $figureId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    // ===========================
    // CREATE BOOK
    // ===========================
    public static function create($data)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO books (figure_id, title, description, cover, year)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        $figureId   = $data['figure_id'];
        $title      = $data['title'];
        $description = $data['description'];
        $cover      = $data['cover'];
        $year       = $data['year'];

        mysqli_stmt_bind_param($stmt, 'isssi', 
            $figureId, $title, $description, $cover, $year
        );

        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }

    // ===========================
    // UPDATE BOOK
    // ===========================
    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE books SET 
                    figure_id = ?, 
                    title = ?, 
                    description = ?, 
                    cover = ?, 
                    year = ?
                WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);

        $figureId   = $data['figure_id'];
        $title      = $data['title'];
        $description = $data['description'];
        $cover      = $data['cover'];
        $year       = $data['year'];

        mysqli_stmt_bind_param($stmt, 'isssii', 
            $figureId, $title, $description, $cover, $year, $id
        );

        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }

    // ===========================
    // DELETE BOOK
    // ===========================
    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM books WHERE id = ? LIMIT 1";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_affected_rows($stmt);
    }

     public static function findByFigureId($figure_id)
    {
        $conn = self::getDB();
        $stmt = mysqli_prepare($conn, "SELECT * FROM books WHERE figure_id = ? ORDER BY year DESC");
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
