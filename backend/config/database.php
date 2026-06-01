<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'bike_shop');
define('DB_USER', 'root');
define('DB_PASS', '');
function getDB() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die(json_encode(['status' => 'error', 'message' => 'Ошибка БД']));
    }
}

function writeLog($login, $action, $message = '') {
    $dir = __DIR__ . '/../logs';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $file = $dir . '/auth.log';
    $line = "[" . date('Y-m-d H:i:s') . "] | IP: " . $_SERVER['REMOTE_ADDR'] . " | Логин: $login | Действие: $action\n";
    file_put_contents($file, $line, FILE_APPEND);
}

function getUsers() {
    $pdo = getDB();
    $stmt = $pdo->query("SELECT id, name, email, age, role FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProducts() {
    $pdo = getDB();
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>