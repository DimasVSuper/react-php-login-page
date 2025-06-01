<?php
require_once __DIR__ . '/../model/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login($username, $password) {
        $user = $this->userModel->findByUsername($username);
        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Invalid password'];
        }
        unset($user['password']); // Jangan kirim password ke frontend
        return ['success' => true, 'user' => $user];
    }

    public function register($username, $password, $email) {
        if ($this->userModel->findByUsername($username)) {
            return ['success' => false, 'message' => 'Username sudah digunakan'];
        }
        if ($this->userModel->findByEmail($email)) {
            return ['success' => false, 'message' => 'Email sudah digunakan'];
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->userModel->register($username, $hashedPassword, $email);
        if ($result) {
            return ['success' => true, 'message' => 'Registration successful'];
        } else {
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }
}
?>