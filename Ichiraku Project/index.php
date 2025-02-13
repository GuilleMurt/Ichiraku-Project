<?php
require 'app/controllers/mainControllers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    if (isset($_POST['accio']) && $_POST['accio'] === 'login'){
        $correu = $_POST['correu'];
        $contrasenya = $_POST['contrasenya'];
        if (Comprobarusuari($correu, $contrasenya)){
            header("Location: /appmenu.php");
            exit();
        }else{
            echo '<p class="error">Error: El usuario no existe o la contraseña es incorrecta.</p>';
            MostrarLogin();
        }
    }
}else {
    MostrarLogin();
}

?>