<?php
require 'app/models/User.php';

class LoginController {
    public function index() {
        session_start();
    
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=home");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'login') {
                $this->login();
            } elseif ($action === 'register') {
                $this->register();
            }
        } elseif (isset($_GET['action']) && $_GET['action'] === 'register') {
            // Cargar la vista de registro si la acción es "register"
            require 'app/views/register.php';
        } else {
            require 'app/views/login.php';
        }
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
            echo '<p class="error">Error: Credenciales incorrectas.</p>';
            require 'app/views/login.php';
        }
    }

    private function register() {
        $user_name = $_POST['user_name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (User::registerUser($user_name, $email, $password)) {
            echo '<p class="success">Usuario registrado correctamente. Por favor, inicia sesión.</p>';
            require 'app/views/login.php';
        } else {
            echo '<p class="error">Error: No se pudo registrar el usuario.</p>';
            require 'app/views/register.php';
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