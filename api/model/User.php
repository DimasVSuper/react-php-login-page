<?php
class User {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambahkan method register
    public function register($username, $password, $email) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO users (username, password, email) VALUES (?, ?, ?)"
            );
            $result = $stmt->execute([$username, $password, $email]);
            return $result; // <-- PENTING: harus ada return
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>