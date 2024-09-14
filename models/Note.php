<?php
include_once '../config/db.php';

class Note {
    public static function create($user_id, $note_text) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO notes (user_id, note_text) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $note_text);
        return $stmt->execute();
    }
}
?>
