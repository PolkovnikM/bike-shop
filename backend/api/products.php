<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

try {
    $products = getProducts();
    
    if (empty($products)) {
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Товары не найдены'
        ]);
    } else {
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $products
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Ошибка сервера: ' . $e->getMessage()
    ]);
}
?>