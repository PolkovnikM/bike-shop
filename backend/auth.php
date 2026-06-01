<?php
session_start();
require_once 'config/database.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    header('Location: login.php?error=empty');
    exit;
}
$pdo = getDB();
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password_hash'])) {
    writeLog($email, 'FAIL_LOGIN', 'Неверный пароль');
    header('Location: login.php?error=invalid');
    exit;
}
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_role'] = $user['role'];

writeLog($email, 'SUCCESS_LOGIN', 'Вход выполнен');
header('Location: dashboard.php');
exit;
?>