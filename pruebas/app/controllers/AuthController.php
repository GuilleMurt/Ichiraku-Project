<?php
require_once 'app/models/User.php';
require_once 'config.php';

class AuthController {
    public function login() {
        require 'app/views/auth/login.php';
    }

    public function register() {
        require 'app/views/auth/register.php';
    }

    public function authenticate() {
        global $pdo;
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: /public/index.php");
        } else {
            echo "Credencials incorrectes";
        }
    }
}
?>