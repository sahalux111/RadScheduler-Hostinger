<?php
include_once '../config/db.php';

class User {
    public static function getUsersByRole($role) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE role = ?");
        $stmt->bind_param("s", $role);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
