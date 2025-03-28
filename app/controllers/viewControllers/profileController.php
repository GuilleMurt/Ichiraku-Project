<?php

class profileController{
    public function index(){
        session_start(); // Inicia la sesión

        if (isset($_SESSION['user_id'])) {
            require_once("app/views/header.php");
            require_once("app/views/profile.php");
            require_once("app/views/footer.php");
            exit();
        } else {
            header("Location: index.php?controller=login");
            exit();
        }

    }

    public function editProfile() {
        session_start(); // Inicia la sesión

        if (isset($_SESSION['user_id'])) {
            require_once("app/views/header.php");
            require_once("app/views/editProfile.php");
            require_once("app/views/footer.php");
            exit();
        } else {
            header("Location: index.php?controller=login");
            exit();
        }
    }

}
?>