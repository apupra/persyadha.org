<?php
namespace App\Middleware;

class RoleMiddleware
{
    public static function allow($roles = [])
    {
        if (!isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }

        $userRole = $_SESSION['admin']['role'];

        if (!in_array($userRole, $roles)) {
            // LANGSUNG LOAD HALAMAN FORBIDDEN
            require __DIR__ . '/../../views/admin/forbidden.php';
            exit; // pastikan stop script
        }
    }

    public static function onlyAdmin()
    {
        self::allow(['admin']);
    }

    public static function hanyaPenulisDanOperator()
    {
        self::allow(['operator', 'penulis']);
    }
}
