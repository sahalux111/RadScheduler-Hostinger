<?php
session_start();
if ($_SESSION['user']['role'] !== 'doctor') {
    header('Location: /');
    exit;
}
include_once '../controllers/DoctorController.php';
$doctorController = new DoctorController();
$availability = $doctorController->getAvailability($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="/resources/styles.css">
</head>
<body>
    <h1>Doctor Dashboard</h1>

    <h2>Your Availability</h2>
    <p>Available from: <?= $availability['start_time']; ?> to <?= $availability['end_time']; ?></p>

    <h2>Your Breaks</h2>
    <p>Break start: <?= $availability['break_start']; ?> to Break end: <?= $availability['break_end']; ?></p>

    <a href="/controllers/AuthController.php?action=logout">Logout</a>
</body>
</html>

