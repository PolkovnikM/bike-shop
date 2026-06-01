<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/bike-shop/style.css">
</head>
<body>
    <div class="auth-container">
        <h1>Велосипеды</h1>
        <h2>Регистрация</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="error">
                <?php if ($_GET['error'] === 'exists') echo 'Email уже существует'; ?>
                <?php if ($_GET['error'] === 'email') echo 'Неверный email'; ?>
                <?php if ($_GET['error'] === 'password') echo 'Пароли не совпадают'; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="success">Регистрация успешна! <a href="login.php">Войти</a></div>
        <?php endif; ?>
        <form action="register_handler.php" method="POST">
            <input type="text" name="name" placeholder="Имя" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="number" name="age" placeholder="Возраст">
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="confirm_password" placeholder="Подтверждение пароля" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
    </div>
</body>
</html>