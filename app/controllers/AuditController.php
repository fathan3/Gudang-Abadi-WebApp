<?php
class AuditController {
    public function index() {
        require_once __DIR__ . '/../models/AuditLogModel.php';
        
        $auditModel = new AuditLogModel();
        
        $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        if ($page < 1) $page = 1;
        $limit = 50;
        $offset = ($page - 1) * $limit;
        
        $logs = $auditModel->getLogs($limit, $offset);
        $total = $auditModel->countLogs();
        $totalPages = ceil($total / $limit);
        
        require_once __DIR__ . '/../views/audit/index.php';
    }
}
