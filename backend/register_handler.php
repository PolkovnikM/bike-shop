<?php
require_once 'config/database.php';
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$age = !empty($_POST['age']) ? (int)$_POST['age'] : null;
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if (empty($name) || empty($email) || empty($password)) {
    header('Location: register.php?error=empty');
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: register.php?error=email');
    exit;
}
if ($password !== $confirm) {
    header('Location: register.php?error=password');
    exit;
}
$pdo = getDB();
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    header('Location: register.php?error=exists');
    exit;
}
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (name, email, age, password_hash) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $email, $age, $hash]);
header('Location: register.php?success=1');
exit;
?>