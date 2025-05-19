<?php
require 'app/models/User.php';

class LoginController {
    public function index() {
        session_start();

        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=home");
            exit();
        }

        // Definir variables para el mensaje y tipo de alerta
        $message = null;
        $messageType = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'login') {
                list($message, $messageType) = $this->login();
                require 'app/views/login.php';
                return;
            } elseif ($action === 'register') {
                list($message, $messageType) = $this->register();
                require 'app/views/login.php'; // redirige a login tras registrar
                return;
            }
        } elseif (isset($_GET['action']) && $_GET['action'] === 'register') {
            require 'app/views/register.php';
            return;
        }

        require 'app/views/login.php';
    }

    private function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userId = User::verifyPassword($email, $password);
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_email'] = $email;
            header("Location: index.php?controller=home");
            exit();
        } else {
            return ["Credenciales incorrectas.", "danger"];
        }
    }

    private function register() {
        $user_name = $_POST['user_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $emailExists = User::getUserByEmail($email);
        if ($emailExists) {
            return ["El correo ya está en uso.", "danger"];
        }

        if (User::registerUser($user_name, $email, $password)) {
            return ["Usuario registrado correctamente. Por favor, inicia sesión.", "success"];
        } else {
            return ["No se pudo registrar el usuario.", "danger"];
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>
