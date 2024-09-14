<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == 'admin') {
            header('Location: /admin/dashboard.php');
        } elseif ($user['role'] == 'doctor') {
            header('Location: /doctor/dashboard.php');
        } elseif ($user['role'] == 'qa_radiographer') {
            header('Location: /qa/dashboard.php');
        }
    } else {
        echo "Invalid login credentials.";
    }
}
?>
