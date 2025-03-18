<?php
require_once 'app/models/User.php';
require_once 'app/models/Stats.php';
require_once 'config.php';

class UserController {
    public function profile() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/auth/login.php");
            exit;
        }

        $user = User::getById($_SESSION['user_id']);
        $stats = Stats::getUserStats($_SESSION['user_id']);
        require 'app/views/user/profile.php';
    }
}
?>
