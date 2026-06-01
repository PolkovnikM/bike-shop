<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getDB();
    }
    public function getAll() {
        $stmt = $this->pdo->query("SELECT id, name, email, age, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT id, name, email, age, role FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data) {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return ['status' => 'error', 'message' => 'Неверный формат email'];
        }
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$data['email']]);
        if ($stmt->fetch()) {
            return ['status' => 'error', 'message' => 'Email уже существует'];
        }
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            return ['status' => 'error', 'message' => 'name, email, password обязательны'];
        }
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, age, password_hash) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['name'], $data['email'], $data['age'] ?? null, $hash]);
        
        return [
            'status' => 'success',
            'message' => 'Пользователь создан',
            'user' => [
                'id' => $this->pdo->lastInsertId(),
                'name' => $data['name'],
                'email' => $data['email'],
                'age' => $data['age'] ?? null
            ]
        ];
    }
}
?>