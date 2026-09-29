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

    public function users() {
        require_once __DIR__ . '/../models/UserModel.php';
        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $nama_lengkap = trim($_POST['nama_lengkap']);
            $role = $_POST['role'];

            try {
                $userModel->register($username, $password, $nama_lengkap, $role);
                header("Location: " . BASE_URL . "settings/users?msg=success_user_create");
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $usersList = $userModel->getAllUsers();
        require_once __DIR__ . '/../views/settings/users.php';
    }

    public function delete_user() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0 && $id != $_SESSION['user_id']) {
            require_once __DIR__ . '/../models/UserModel.php';
            $userModel = new UserModel();
            $userModel->deleteUser($id);
            header("Location: " . BASE_URL . "settings/users?msg=success_user_delete");
            exit;
        }
        header("Location: " . BASE_URL . "settings/users?msg=error_delete");
        exit;
    }
}
