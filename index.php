<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Велосипеды - интернет-магазин велосипедов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Велосипеды</h1>
        </div>
        <nav>
            <a href="#" id="catalog-link">Каталог</a>
            <a href="#" id="cart-link">Корзина (<span id="cart-count">0</span>)</a>
            <a href="widgets.html">Виджеты</a>
            <?php if ($isLoggedIn): ?>
                <a href="backend/dashboard.php"><?php echo htmlspecialchars($userName); ?></a>
                <a href="backend/logout.php">Выход</a>
            <?php else: ?>
                <a href="backend/login.php">Вход</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <div id="catalog-section">
            <h2>Каталог велосипедов</h2>
            <div class="filter-container">
                <label for="category-filter">Фильтр по типу:</label>
                <select id="category-filter">
                    <option value="all">Все велосипеды</option>
                    <option value="mountain">Горные</option>
                    <option value="road">Шоссейные</option>
                    <option value="city">Городские</option>
                    <option value="kids">Детские</option>
                    <option value="electric">Электровелосипеды</option>
                    <option value="bmx">BMX / Трюковые</option>
                    <option value="hybrid">Гибридные</option>
                </select>
            </div>
            <div id="products-grid" class="products-grid">
                <div class="loading">Загрузка...</div>
            </div>
        </div>

        <div id="cart-section" style="display: none;">
            <h2>Корзина</h2>
            <div id="cart-items"></div>
            <div class="cart-total">
                <strong>Итого: <span id="cart-total">0</span> ₽</strong>
            </div>
            <button id="checkout-btn" class="btn-checkout">Оформить заказ</button>
        </div>
    </main>

    <footer>
        <p>© 2026 Велосипеды. Все права защищены.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>