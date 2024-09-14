<?php
include_once '../config/db.php';
include_once '../models/User.php';
include_once '../models/Note.php';

class AdminController {
    public function getAllDoctors() {
        return User::getUsersByRole('doctor');
    }

    public function getAllQAUsers() {
        return User::getUsersByRole('qa_radiographer');
    }

    public function addNoteForDoctor($doctor_id, $note) {
        return Note::create($doctor_id, $note);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminController = new AdminController();
    $adminController->addNoteForDoctor($_POST['doctor_id'], $_POST['note']);
    header('Location: /views/admin_dashboard.php');
}
?>
