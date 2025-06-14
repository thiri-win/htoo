<?php

echo "hello, world<br>";
// try {
//     $pdo = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');
//     echo "SQLite connection successful!";
// } catch (PDOException $e) {
//     echo "SQLite connection failed: " . $e->getMessage();
//     die(); // Stop execution if the connection fails
// }
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Request::capture());
