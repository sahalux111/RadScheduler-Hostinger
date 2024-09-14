<?php
include_once '../config/db.php';
include_once '../models/User.php';
include_once '../models/Note.php';

class QAController {
    public function getAllDoctors() {
        return User::getUsersByRole('doctor');
    }

    public function getAvailability($qa_id) {
        return Availability::getByUserId($qa_id);
    }

    public function addNoteForQA($qa_id, $note) {
        return Note::create($qa_id, $note);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qaController = new QAController();
    $qaController->addNoteForQA($_SESSION['user']['id'], $_POST['note']);
    header('Location: /views/qa_dashboard.php');
}
?>
