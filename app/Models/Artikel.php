<?php

namespace App\Models;

class Artikel
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

    // Ambil artikel terbaru
    public static function latest($limit = 4)
    {
        $conn = self::getDB();
        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                LEFT JOIN admins ad ON a.author_id = ad.id
                ORDER BY a.created_at DESC
                LIMIT ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $artikels = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $artikels[] = $row;
        }
        return $artikels;
    }

    // Ambil semua artikel
    public static function all()
    {
        $conn = self::getDB();
        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                LEFT JOIN admins ad ON a.author_id = ad.id
                ORDER BY a.created_at DESC";
        $result = mysqli_query($conn, $sql);

        $artikels = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $artikels[] = $row;
        }
        return $artikels;
    }

    // Cari artikel berdasarkan ID
    public static function find($id)
    {
        $conn = self::getDB();
        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                LEFT JOIN admins ad ON a.author_id = ad.id
                WHERE a.id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Tambah artikel
    public static function create($data)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO articles (title, slug, content, author_id, category_id, poster, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            'sssisss',
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['author_id'],
            $data['category_id'],
            $data['poster'],
            $data['status']
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // Update artikel
    public static function update($id, $data)
    {
        $conn = self::getDB();
        $sql = "UPDATE articles 
                SET title = ?, slug = ?, content = ?, author_id = ?, category_id = ?, poster = ?, status = ? 
                WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            'sssisssi',
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['author_id'],
            $data['category_id'],
            $data['poster'],
            $data['status'],
            $id
        );
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // Hapus artikel
    public static function delete($id)
    {
        $conn = self::getDB();
        $sql = "DELETE FROM articles WHERE id = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt);
    }

    // Cari artikel berdasarkan slug
    public static function findBySlug($slug)
    {
        $conn = self::getDB();
        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                LEFT JOIN admins ad ON a.author_id = ad.id
                WHERE a.slug = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $slug);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Mengecek apakah tabel punya kolom views
    private static function hasViewsColumn()
    {
        $conn = self::getDB();
        $res = mysqli_query($conn, "SHOW COLUMNS FROM articles LIKE 'views'");
        return ($res && mysqli_num_rows($res) > 0);
    }

    // Tambah view
    public static function addView($articleId)
    {
        $conn = self::getDB();
        $sql = "INSERT INTO article_views (article_id) VALUES (?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $articleId);
        mysqli_stmt_execute($stmt);

        if (self::hasViewsColumn()) {
            mysqli_query($conn, "UPDATE articles SET views = views + 1 WHERE id = $articleId");
        }
    }

    // Artikel paling populer (all time)
    public static function mostPopular($limit = 5)
    {
        $conn = self::getDB();
        if (self::hasViewsColumn()) {
            $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name, a.views AS views_count
                    FROM articles a
                    LEFT JOIN article_categories c ON a.category_id = c.id
                    LEFT JOIN admins ad ON a.author_id = ad.id
                    ORDER BY a.views DESC
                    LIMIT ?";
        } else {
            $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name, COUNT(v.id) AS views_count
                    FROM articles a
                    LEFT JOIN article_categories c ON a.category_id = c.id
                    LEFT JOIN admins ad ON a.author_id = ad.id
                    LEFT JOIN article_views v ON a.id = v.article_id
                    GROUP BY a.id
                    ORDER BY views_count DESC
                    LIMIT ?";
        }

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $artikels = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $artikels[] = $row;
        }
        return $artikels;
    }

    // Artikel populer hari ini
    public static function popularToday($limit = 5)
    {
        $conn = self::getDB();
        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name, COUNT(v.id) AS views_count
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                LEFT JOIN admins ad ON a.author_id = ad.id
                LEFT JOIN article_views v 
                       ON a.id = v.article_id 
                      AND DATE(v.viewed_at) = CURDATE()
                GROUP BY a.id
                ORDER BY views_count DESC
                LIMIT ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $artikels = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $artikels[] = $row;
        }
        return $artikels;
    }

    // Artikel populer per kategori
    public static function popularByCategory($categoryId, $limit = 5)
    {
        $conn = self::getDB();
        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name, COUNT(v.id) AS views_count
                FROM articles a
                LEFT JOIN article_categories c ON a.category_id = c.id
                LEFT JOIN admins ad ON a.author_id = ad.id
                LEFT JOIN article_views v ON a.id = v.article_id
                WHERE a.category_id = ?
                GROUP BY a.id
                ORDER BY views_count DESC
                LIMIT ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $categoryId, $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $artikels = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $artikels[] = $row;
        }
        return $artikels;
    }

    // Ambil semua artikel berdasarkan kategori
    public static function byCategory($categoryId)
    {
        $conn = self::getDB();
        $sql = "
        SELECT a.*, c.name AS category_name
        FROM articles a
        LEFT JOIN article_categories c ON a.category_id = c.id
        WHERE a.category_id = ?
        ORDER BY a.created_at DESC
    ";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $categoryId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $articles = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $articles[] = $row;
            }
        }
        return $articles;
    }

    public static function countAll()
    {
        $conn = self::getDB();
        $sql = "SELECT COUNT(*) AS total FROM articles";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result)['total'] ?? 0;
    }


    public static function latestPaginated($limit, $offset)
    {
        $conn = self::getDB();

        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name
            FROM articles a
            LEFT JOIN article_categories c ON a.category_id = c.id
            LEFT JOIN admins ad ON a.author_id = ad.id
            ORDER BY a.created_at DESC
            LIMIT ?, ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $offset, $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Ambil artikel utama (artikel terbaru)
    public static function latestOne()
    {
        $conn = self::getDB();

        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name
            FROM articles a
            LEFT JOIN article_categories c ON a.category_id = c.id
            LEFT JOIN admins ad ON a.author_id = ad.id
            ORDER BY a.created_at DESC
            LIMIT 1";

        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    // Ambil artikel untuk paginasi, dimulai setelah artikel utama
    public static function latestExceptOne($limit, $offset)
    {
        $conn = self::getDB();

        // offset + 1 → supaya artikel pertama dilewati
        $start = $offset + 1;

        $sql = "SELECT a.*, c.name AS category_name, ad.name AS author_name
            FROM articles a
            LEFT JOIN article_categories c ON a.category_id = c.id
            LEFT JOIN admins ad ON a.author_id = ad.id
            ORDER BY a.created_at DESC
            LIMIT ?, ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $start, $limit);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
