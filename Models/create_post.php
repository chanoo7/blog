<?php
class ActivityLog {
    public static function logAction($admin_id, $action) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO activity_log (admin_id, action) VALUES (?, ?)");
        return $stmt->execute([$admin_id, $action]);
    }

    public static function getAllLogs() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM activity_log ORDER BY timestamp DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
