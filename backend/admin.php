<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}
require_once 'C:/xampp/htdocs/bike-shop/backend/config/database.php';
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
        <h2>Логи авторизации</h2>
        <div class="table-container">
        <table class="logs-table">
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Email</th>
                    <th>Действие</th>
                    <th>IP</th>
                    <th>Сообщение</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = getDB();
                $stmt = $pdo->query("SELECT * FROM logs ORDER BY created_at DESC LIMIT 50");
                while ($log = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($log['created_at']) . "</td>";
                    echo "<td>" . htmlspecialchars($log['user_email']) . "</td>";
                    echo "<td>" . htmlspecialchars($log['action']) . "</td>";
                    echo "<td>" . htmlspecialchars($log['ip_address']) . "</td>";
                    echo "<td>" . htmlspecialchars($log['message']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="dashboard.php" class="btn">← Назад</a>
    </div>
    
    <script>
        fetch('/bike-shop/backend/api/users.php')
            .then(res => res.json())
            .then(data => {
                const container = document.getElementById('users-list');
                if (data.status === 'success' && data.data) {
                    let html = '<table border="1" style="width:100%; border-collapse: collapse;">';
                    html += '<tr><th>ID</th><th>Имя</th><th>Email</th><th>Роль</th></tr>';
                    data.data.forEach(user => {
                        html += `<tr>
                                    <td>${user.id}</td>
                                    <td>${user.name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.role}</td>
                                 </tr>`;
                    });
                    html += '</table>';
                    container.innerHTML = html;
                } else {
                    container.innerHTML = '<p>Ошибка загрузки</p>';
                }
            });
    </script>
</body>
</html>