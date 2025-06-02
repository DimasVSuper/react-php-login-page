<?php
/**
 * Endpoint registrasi user baru.
 * Menerima POST JSON: { "username": "...", "password": "...", "email": "..." }
 * Mengembalikan JSON hasil registrasi.
 */

header('Access-Control-Allow-Origin: http://localhost:5173'); // Atau ganti * dengan asal frontend Anda
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/controller/AuthController.php';

// Ambil data dari JSON atau form
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if (stripos($contentType, 'application/json') !== false) {
    $data = json_decode(file_get_contents('php://input'), true);
    file_put_contents('debug.txt', print_r($data, true));
} else {
    $data = $_POST;
}

if (!isset($data['username'], $data['password'], $data['email'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'All fields required']);
    exit;
}

$auth = new AuthController($pdo);
$result = $auth->register($data['username'], $data['password'], $data['email']);
echo json_encode($result);
?>