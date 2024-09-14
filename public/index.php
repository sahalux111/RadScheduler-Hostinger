<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /views/login.php');
    exit;
}

$user = $_SESSION['user'];
if ($user['role'] == 'admin') {
    header('Location: /views/admin_dashboard.php');
} elseif ($user['role'] == 'doctor') {
    header('Location: /views/doctor_dashboard.php');
} elseif ($user['role'] == 'qa_radiographer') {
    header('Location: /views/qa_dashboard.php');
} else {
    echo "Invalid user role!";
}
?>
