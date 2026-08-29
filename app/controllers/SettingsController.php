<?php
class SettingsController {
    public function lock_date() {
        require_once __DIR__ . '/../models/SettingsModel.php';
        require_once __DIR__ . '/../models/AuditLogModel.php';
        
        $settingsModel = new SettingsModel();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $settingsModel->setLockDate('');
                AuditLogModel::log('Tanggal Penguncian Dihapus', 'Tanggal penguncian dihapus', date('Y-m-d'));
                header("Location: " . BASE_URL . "settings/lock_date?msg=success_delete");
                exit;
            } else {
                $date = trim($_POST['lock_date']);
                $settingsModel->setLockDate($date);
                AuditLogModel::log('Tanggal Penguncian Diatur', "Tanggal diatur menjadi: {$date}", date('Y-m-d'));
                header("Location: " . BASE_URL . "settings/lock_date?msg=success_save");
                exit;
            }
        }

        $current_lock_date = $settingsModel->getLockDate();
        
        require_once __DIR__ . '/../views/settings/lock_date.php';
    }
}
