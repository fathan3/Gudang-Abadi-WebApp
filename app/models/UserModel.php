<?php
require_once __DIR__ . '/../config/Database.php';

class UserModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function register($username, $password, $nama_lengkap, $role = 'stok_harian') {
        // Check if username already exists
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            throw new Exception("Username sudah digunakan!");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, nama_lengkap, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $hashed_password, $nama_lengkap, $role]);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT id, username, nama_lengkap, role, created_at FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT id, username, nama_lengkap, role, created_at FROM users ORDER BY created_at ASC");
        return $stmt->fetchAll();
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateUser($id, $nama_lengkap, $role, $password = null) {
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET nama_lengkap = ?, role = ?, password = ? WHERE id = ?");
            return $stmt->execute([$nama_lengkap, $role, $hashed, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE users SET nama_lengkap = ?, role = ? WHERE id = ?");
            return $stmt->execute([$nama_lengkap, $role, $id]);
        }
    }
}
