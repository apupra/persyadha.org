<?php
namespace App\Controllers;

class AuthController
{
    private $db;

    public function __construct()
    {
        require __DIR__ . '/../../app/config/database.php';
        $this->db = $db; // mysqli_connect dari config

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showLogin()
    {
        if (isset($_SESSION['admin'])) {
            header("Location: /persyadha.org/manjadmin/dashboard");
            exit;
        }

        require __DIR__ . '/../../views/admin/auth/login.php';
    }

    public function doLogin()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Email dan password wajib diisi!";
            header("Location: /persyadha.org/manjadmin/login");
            exit;
        }

        // ==== Prepared Statement (lebih aman) ====
        $stmt = mysqli_prepare($this->db, "SELECT id, email, name, password, role FROM admins WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);

        // ==== Verifikasi ====
        if ($admin && password_verify($password, $admin['password'])) {

            $_SESSION['admin'] = [
                'id'    => $admin['id'],
                'email' => $admin['email'],
                'name'  => $admin['name'],
                'role'  => $admin['role']
            ];

            header("Location: /persyadha.org/manjadmin/dashboard");
            exit;
        }

        // gagal login
        $_SESSION['error'] = "Email atau password salah!";
        header("Location: /persyadha.org/manjadmin/login");
        exit;
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: /persyadha.org/manjadmin/login");
        exit;
    }
}
