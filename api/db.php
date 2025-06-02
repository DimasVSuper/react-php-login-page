<?php
/**
 * Koneksi ke database menggunakan PDO.
 * 
 * @var string $host Host database
 * @var string $db   Nama database
 * @var string $user Username database
 * @var string $pass Password database
 * @var PDO    $pdo  Instance PDO yang digunakan untuk query
 */

$host = 'localhost';
$db   = 'loginpage_db';
$user = 'root';
$pass = ''; // ganti sesuai password MySQL Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
?>