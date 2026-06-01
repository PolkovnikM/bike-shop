<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    public function getAll() {
        $users = $this->userModel->getAll();
        echo json_encode(['status' => 'success', 'data' => $users]);
    }
    public function getById($id) {
        $user = $this->userModel->getById($id);
        if (!$user) {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Пользователь не найден']);
            return;
        }
        echo json_encode(['status' => 'success', 'data' => $user]);
    }
    public function create() {
        $input = json_decode(file_get_contents('php://input'), true);
        $result = $this->userModel->create($input);
        
        if ($result['status'] === 'error') {
            http_response_code(400);
        } else {
            http_response_code(201);
        }
        echo json_encode($result);
    }
}
?>