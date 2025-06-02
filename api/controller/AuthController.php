<?php
require_once __DIR__ . '/../model/User.php';

/**
 * Class AuthController
 * Controller untuk autentikasi user (login & register).
 */
class AuthController {
    /**
     * @var User $userModel Model user untuk operasi database
     */
    private $userModel;

    /**
     * Konstruktor AuthController
     *
     * @param PDO $pdo Koneksi database PDO
     */
    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    /**
     * Proses login user.
     *
     * @param string $username Username user
     * @param string $password Password user (plain)
     * @return array Hasil login (success, message, user)
     */
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

    /**
     * Proses registrasi user baru.
     *
     * @param string $username Username baru
     * @param string $password Password baru (plain)
     * @param string $email Email user
     * @return array Hasil registrasi (success, message)
     */
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