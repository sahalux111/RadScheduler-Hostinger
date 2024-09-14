<?php
include_once '../config/db.php';

class Availability {
    public static function getByUserId($user_id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM availability WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
