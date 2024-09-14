<?php
session_start();
if ($_SESSION['user']['role'] !== 'qa_radiographer') {
    header('Location: /');
    exit;
}
include_once '../controllers/QAController.php';
$qaController = new QAController();
$doctors = $qaController->getAllDoctors();
$availability = $qaController->getAvailability($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QA Dashboard</title>
    <link rel="stylesheet" href="/resources/styles.css">
</head>
<body>
    <h1>QA Dashboard</h1>

    <h2>Your Availability</h2>
    <p>Available from: <?= $availability['start_time']; ?> to <?= $availability['end_time']; ?></p>

    <h2>Doctors Availability</h2>
    <?php foreach ($doctors as $doctor): ?>
        <p>Doctor: <?= $doctor['username']; ?> - Available from: <?= $doctor['start_time']; ?> to <?= $doctor['end_time']; ?></p>
    <?php endforeach; ?>

    <h2>Add Note</h2>
    <form action="/controllers/QAController.php" method="POST">
        <label for="note">Note:</label>
        <textarea id="note" name="note" required></textarea>
        <input type="submit" value="Add Note">
    </form>

    <a href="/controllers/AuthController.php?action=logout">Logout</a>
</body>
</html>
