<?php
require_once __DIR__ . '/../config/Database.php';

class SettingsModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getLockDate() {
        $stmt = $this->db->query("SELECT setting_value FROM settings WHERE setting_key = 'lock_date'");
        $val = $stmt->fetchColumn();
        return $val !== false && $val !== null ? (string)$val : '';
    }

    public function setLockDate($date) {
        $stmt = $this->db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES ('lock_date', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
        return $stmt->execute([$date, $date]);
    }
}
