<?php
session_start();

// Autoloader
spl_autoload_register(function ($class) {
    $prefix = "App\\";
    $base_dir = __DIR__ . "/app/";

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace("\\", "/", $relative_class) . ".php";

    if (file_exists($file)) require $file;
});

// Load helper & database
// require_once __DIR__ . '/app/Helpers/functions.php';
require_once __DIR__ . '/app/config/database.php';

// Load Router class
require_once __DIR__ . '/core/Router.php';

// Buat instance router
$router = new Router();

// Load routes (disini `$router` sudah ada)
require_once __DIR__ . '/routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Hapus prefix /persyadha.org dari URI
$uri = preg_replace('#^/persyadha\.org#', '', $uri);

// Kalau kosong, default ke '/'
if ($uri === '') $uri = '/';

$method = $_SERVER['REQUEST_METHOD'];

// Dispatch ke controller sesuai route
$router->dispatch($uri, $method);
