<?php

namespace App\Models;

class Category
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

    // Ambil semua kategori
    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM article_categories ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);

        $categories = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }
        }
        return $categories;
    }


    // Cari kategori berdasarkan ID
    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM article_categories WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah kategori baru
    public static function create($data)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO article_categories (name, slug) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $data['name'], $data['slug']);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // Update kategori
    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE article_categories SET name = ?, slug = ? WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssi', $data['name'], $data['slug'], $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // Hapus kategori
    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM article_categories WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    public static function withArticleCount()
    {
        $conn = self::getDB();
        $sql = "
        SELECT ac.*, COUNT(a.id) AS articles_count
        FROM article_categories ac
        LEFT JOIN articles a ON a.category_id = ac.id
        GROUP BY ac.id
    ";

        $result = mysqli_query($conn, $sql);
        $categories = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }
        }

        return $categories;
    }

    // Cari kategori berdasarkan slug
    public static function findBySlug($slug)
    {
        $conn = self::getDB();
        $sql = "SELECT * FROM article_categories WHERE slug = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $slug);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

}
