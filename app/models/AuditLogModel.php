<?php
require_once __DIR__ . '/../config/Database.php';

class AuditLogModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public static function log($action_type, $description, $transaction_date) {
        $db = (new Database())->getConnection();
        
        $user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'System';
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        
        $stmt = $db->prepare("INSERT INTO audit_logs (user_name, action_type, description, transaction_date, ip_address) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_name, $action_type, $description, $transaction_date, $ip_address]);
    }

    public function getLogs($limit = 100, $offset = 0) {
        $stmt = $this->db->prepare("SELECT * FROM audit_logs ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countLogs() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM audit_logs");
        return $stmt->fetchColumn();
    }
}
