<?php
require_once __DIR__ . '/../config/Database.php';

class SettingsModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getLockDate() {
        $stmt = $this->db->query("SELECT setting_value FROM settings WHERE setting_key = 'lock_date'");
        return $stmt->fetchColumn();
    }

    public function setLockDate($date) {
        $stmt = $this->db->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'lock_date'");
        return $stmt->execute([$date]);
    }
}
