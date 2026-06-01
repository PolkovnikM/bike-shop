<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

$users = getUsers();
echo json_encode(['status' => 'success', 'data' => $users]);
?>