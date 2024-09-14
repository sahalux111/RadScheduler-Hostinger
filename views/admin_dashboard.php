<?php
session_start();
if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: /');
    exit;
}
include_once '../controllers/AdminController.php';
$adminController = new AdminController();
$doctors = $adminController->getAllDoctors();
$qa_users = $adminController->getAllQAUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/resources/styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>

    <h2>Doctors Availability</h2>
    <?php foreach ($doctors as $doctor): ?>
        <p>Doctor: <?= $doctor['username']; ?> - Available from: <?= $doctor['start_time']; ?> to <?= $doctor['end_time']; ?></p>
    <?php endforeach; ?>

    <h2>QA Availability</h2>
    <?php foreach ($qa_users as $qa): ?>
        <p>QA: <?= $qa['username']; ?> - Available from: <?= $qa['start_time']; ?> to <?= $qa['end_time']; ?></p>
    <?php endforeach; ?>

    <h2>Add Note for Doctor</h2>
    <form action="/controllers/AdminController.php" method="POST">
        <label for="doctor_id">Select Doctor:</label>
        <select name="doctor_id" id="doctor_id">
            <?php foreach ($doctors as $doctor): ?>
                <option value="<?= $doctor['id']; ?>"><?= $doctor['username']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="note">Note:</label>
        <textarea id="note" name="note" required></textarea>
        <input type="submit" value="Add Note">
    </form>

    <a href="/controllers/AuthController.php?action=logout">Logout</a>
</body>
</html>
