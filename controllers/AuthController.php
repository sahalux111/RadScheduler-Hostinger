<?php
session_start();
include_once '../config/db.php';

class AuthController {
    public function __construct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->login($_POST['username'], $_POST['password']);
        } elseif (isset($_GET['action']) && $_GET['action'] === 'logout') {
            $this->logout();
        }
    }

    public function login($username, $password) {
        global $conn;

        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['user'] = $user;
            header('Location: /');
        } else {
            echo "Invalid credentials!";
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /views/login.php');
    }
}

new AuthController();
