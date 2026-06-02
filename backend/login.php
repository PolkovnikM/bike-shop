<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход - Велосипеды</title>
    <link rel="stylesheet" href="/bike-shop/style.css">
</head>
<body>
    <div class="auth-container">
        <h1>Велосипеды</h1>
        <h2>Вход в систему</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="error">Неверный email или пароль</div>
        <?php endif; ?>
        <form action="auth.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>
        <p>Нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>
        <a href="/bike-shop/index.php"> На главную</a>
    </div>
</body>
</html>