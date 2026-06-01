<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$resource = $path[2] ?? '';
$id = $path[3] ?? null;

switch ($method) {
    case 'GET':
        if ($resource === 'users') {
            if ($id) {
                $user = getUserById($id);
                if ($user) {
                    echo json_encode(['status' => 'success', 'data' => $user]);
                } else {
                    http_response_code(404);
                    echo json_encode(['status' => 'error', 'message' => 'Пользователь не найден']);
                }
            } else {
                echo json_encode(['status' => 'success', 'data' => getUsers()]);
            }
        } 
        elseif ($resource === 'products') {
            $products = getProducts();
            echo json_encode(['status' => 'success', 'data' => $products]);
        }
        else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Endpoint не найден']);
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(['status' => 'error', 'message' => 'Метод не разрешён']);
        break;
}
?>