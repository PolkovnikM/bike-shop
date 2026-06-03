-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 01 2026 г., 14:20
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bike_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `stock`, `created_at`, `image`) VALUES
(1, 'Trek Marlin 5', 'Алюминиевая рама, 100 мм ход вилки, 21 скорость, дисковые механические тормоза.', 45990.00, 'mountain', 8, '2026-05-29 13:06:26', '/bike-shop/images/trek-marlin5.jpg'),
(2, 'Giant Talon 1', 'Алюминиевая рама ALUXX, вилка Suntour XCT с ходом 100 мм, 27 скоростей.', 58900.00, 'mountain', 5, '2026-05-29 13:06:26', '/bike-shop/images/giant-talon1.jpg'),
(3, 'Specialized Rockhopper', 'Легкая алюминиевая рама, вилка SR Suntour XCT, 24 скорости.', 62900.00, 'mountain', 4, '2026-05-29 13:06:26', '/bike-shop/images/specialized-rockhopper.jpg'),
(4, 'Merida Big.Nine 300', 'Алюминиевая рама, 29\" колеса, вилка XCT 100 мм, 16 скоростей.', 52500.00, 'mountain', 6, '2026-05-29 13:06:26', '/bike-shop/images/merida-bignine.jpg'),
(5, 'Trek Domane AL 2', 'Алюминиевая рама, 16 скоростей, комфортная геометрия для длинных поездок.', 78990.00, 'road', 3, '2026-05-29 13:06:26', '/bike-shop/images/trek-domane.jpg'),
(6, 'Giant Contend AR 3', 'Алюминиевая рама, 16 скоростей, дисковые механические тормоза.', 69900.00, 'road', 4, '2026-05-29 13:06:26', '/bike-shop/images/giant-contend.jpg'),
(7, 'Specialized Allez', 'Алюминиевая рама, карбоновая вилка, 16 скоростей.', 73900.00, 'road', 2, '2026-05-29 13:06:26', '/bike-shop/images/Specialized-Allez.jpg'),
(8, 'Electra Townie 7D', 'Алюминиевая рама, геометрия Flat Foot Technology, 7 скоростей.', 49900.00, 'city', 10, '2026-05-29 13:06:26', '/bike-shop/images/electra-townie.jpg'),
(9, 'Schwinn Wayfarer', 'Стальная рама, 7 скоростей, защита цепи, крылья, багажник.', 28900.00, 'city', 12, '2026-05-29 13:06:26', '/bike-shop/images/schwinn-wayfarer.jpg'),
(10, 'Giant Escape 3', 'Алюминиевая рама, 21 скорость, легкий и быстрый для города.', 36900.00, 'city', 15, '2026-05-29 13:06:26', '/bike-shop/images/giant-escape.jpg'),
(11, 'Trek Precaliber 20', 'Алюминиевая рама, 7 скоростей, защита цепи, подножка.', 26900.00, 'kids', 7, '2026-05-29 13:06:26', '/bike-shop/images/trek-precaliber.jpg'),
(12, 'Giant ARX 20', 'Алюминиевая рама, 21 скорость, амортизационная вилка.', 29900.00, 'kids', 5, '2026-05-29 13:06:26', '/bike-shop/images/giant-arx.jpg'),
(13, 'Specialized Jett 20', 'Алюминиевая рама, 7 скоростей, легкий вес.', 25900.00, 'kids', 6, '2026-05-29 13:06:26', '/bike-shop/images/specialized-jett.jpg'),
(14, 'Trek Allant+ 7S', 'Аккумулятор 500 Wh, двигатель Bosch Performance Line, до 120 км пробега.', 189900.00, 'electric', 2, '2026-05-29 13:06:26', '/bike-shop/images/trek-allant.jpg'),
(15, 'Giant Explore E+ 3', 'Аккумулятор 500 Wh, двигатель SyncDrive Sport, до 110 км.', 179000.00, 'electric', 3, '2026-05-29 13:06:26', '/bike-shop/images/giant-explore.jpg'),
(16, 'Specialized Turbo Vado 3.0', 'Аккумулятор 500 Wh, двигатель 250W, приложение для смартфона.', 199900.00, 'electric', 1, '2026-05-29 13:06:26', '/bike-shop/images/specialized-turbo.jpg'),
(17, 'Haro Downtown', 'Стальная рама, 20\" колеса, 25/9 передача, прочные обода.', 35900.00, 'bmx', 4, '2026-05-29 13:06:26', '/bike-shop/images/haro-downtown.jpg'),
(18, 'Kink Launch', 'Стальная рама, 20\" колеса, 25/9 передача, усиленная конструкция.', 38900.00, 'bmx', 3, '2026-05-29 13:06:26', '/bike-shop/images/kink-launch.jpg'),
(19, 'Sunday Primer', 'Стальная рама, 20\" колеса, подходит для начинающих.', 32900.00, 'bmx', 5, '2026-05-29 13:06:26', '/bike-shop/images/sunday-primer.jpg'),
(20, 'Marin Kentfield CS1', 'Алюминиевая рама, 21 скорость, дисковая тормозная система.', 47900.00, 'hybrid', 6, '2026-05-29 13:06:26', '/bike-shop/images/marin-kentfield.jpg'),
(21, 'Kona Dew', 'Алюминиевая рама, 16 скоростей, широкие шины, гидравлические дисковые тормоза.', 55900.00, 'hybrid', 4, '2026-05-29 13:06:26', '/bike-shop/images/kona-dew.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `age`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Администратор', 'admin@bike.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-05-29 13:06:26'),
(2, 'Пользователь', 'user@bike.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', '2026-05-29 13:06:26'),
(3, 'liniker hd', 'user123@bike.com', 18, '$2y$10$7Gx8D9APtyWVEFRyeoo4uu5YWl0xVToeEZlI95/xGmCsuPnv9Yqju', 'admin', '2026-05-31 15:44:55'),
(4, 'Админ', 'newadmin@test.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2026-05-31 16:13:07'),
(6, 'максим', 'user2.0@bike.com', 19, '$2y$10$FG1qgunKF3sN4wOHo4K5luCqIjaj4V5A84mA47Y.MnEEe2nBbBKWq', 'user', '2026-06-01 11:16:17');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
