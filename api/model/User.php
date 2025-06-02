<?php
/**
 * Class User
 * Model untuk operasi database pada tabel users.
 */
class User {
    /**
     * @var PDO $pdo Koneksi database PDO
     */
    private $pdo;

    /**
     * Konstruktor User
     * 
     * @param PDO $pdo Koneksi database PDO
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Cari user berdasarkan username.
     *
     * @param string $username Username yang dicari
     * @return array|false Data user dalam bentuk array, atau false jika tidak ditemukan
     */
    public function findByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Registrasi user baru.
     *
     * @param string $username Username baru
     * @param string $password Password (sudah di-hash)
     * @param string $email Email user
     * @return bool True jika berhasil, false jika gagal
     */
    public function register($username, $password, $email) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO users (username, password, email) VALUES (?, ?, ?)"
            );
            $result = $stmt->execute([$username, $password, $email]);
            return $result;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Cari user berdasarkan email.
     *
     * @param string $email Email yang dicari
     * @return array|false Data user dalam bentuk array, atau false jika tidak ditemukan
     */
    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>