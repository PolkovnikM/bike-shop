<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode([
        'status' => 'error',
        'message' => 'Доступ запрещён. Требуются права администратора'
    ]);
    exit;
}
try {
    $users = getUsers();
    
    if (empty($users)) {
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Пользователи не найдены'
        ]);
    } else {
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $users
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