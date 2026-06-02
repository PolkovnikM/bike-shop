<?php
session_start();
header('Content-Type: application/json');
require_once '../config/database.php';
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Требуется авторизация']);
    exit;
}
$userId = $_SESSION['user_id'];
$input = json_decode(file_get_contents('php://input'), true);
$cart = $input['cart'] ?? [];
if (empty($cart)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Корзина пуста']);
    exit;
}
$pdo = getDB();
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
$pdo->beginTransaction();
try {
    // Создаем запись в orders
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    $stmt->execute([$userId, $total]);
    $orderId = $pdo->lastInsertId();
    // Создаем записи в order_items
    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($cart as $item) {
        $stmt->execute([$orderId, $item['id'], $item['quantity'], $item['price']]);
    }
    //Обновляем количество товаров на складе
    $stmt = $pdo->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    foreach ($cart as $item) {
        $stmt->execute([$item['quantity'], $item['id']]);
    }
    
    $pdo->commit();
    echo json_encode([
        'status' => 'success',
        'message' => 'Заказ оформлен',
        'order_id' => $orderId,
        'total' => $total
    ]);
} catch (Exception $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Ошибка оформления заказа']);
}
?>