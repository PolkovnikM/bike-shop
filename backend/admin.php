<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <link rel="stylesheet" href="/bike-shop/style.css">
</head>
<body>
    <div class="container">
        <h1>Админ-панель</h1>
        <h2>Список пользователей</h2>
        <div id="users-list"></div>
        <a href="dashboard.php" class="btn">← Назад</a>
    </div>
    <script>
        fetch('/bike-shop/backend/api/users.php')
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('users-list');
                if (data.status === 'success') {
                    container.innerHTML = '<table border="1"><tr><th>ID</th><th>Имя</th><th>Email</th><th>Роль</th></tr>' +
                        data.data.map(u => `<tr><td>${u.id}</td><td>${u.name}</td><td>${u.email}</td><td>${u.role}</td></tr>`).join('') +
                        '</table>';
                } else {
                    container.innerHTML = '<p>Ошибка загрузки</p>';
                }
            });
    </script>
</body>
</html>