<?php
/**
 * Endpoint login user.
 * Menerima POST JSON: { "username": "...", "password": "..." }
 * Mengembalikan JSON hasil autentikasi.
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
} else {
    $data = $_POST;
}

if (!isset($data['username'], $data['password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Username and password required']);
    exit;
}

$auth = new AuthController($pdo);
$result = $auth->login($data['username'], $data['password']);
echo json_encode($result);
