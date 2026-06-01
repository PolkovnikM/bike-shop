<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

$products = getProducts();
echo json_encode(['status' => 'success', 'data' => $products]);
?>