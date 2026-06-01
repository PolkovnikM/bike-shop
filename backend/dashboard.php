<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role'];
$isAdmin = ($user_role === 'admin');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="/bike-shop/style.css">
</head>
<body>
    <div class="container">
        <h1>Велосипеды</h1>
        <h2>Личный кабинет</h2>
        <p>Добро пожаловать, <strong><?php echo htmlspecialchars($user_name); ?></strong>!</p>
        <p>Роль: <?php echo $isAdmin ? 'Администратор' : 'Пользователь'; ?></p>
        <?php if ($isAdmin): ?>
            <div class="admin-panel">
                <h3>Админ-панель</h3>
                <p>Управление пользователями и товарами</p>
                <a href="admin.php" class="btn">Перейти в админ-панель</a>
            </div>
        <?php endif; ?>
        <div class="links">
            <a href="/bike-shop/index.php" class="btn">Перейти в магазин</a>
            <a href="logout.php" class="btn logout">Выйти</a>
        </div>
    </div>
</body>
</html>