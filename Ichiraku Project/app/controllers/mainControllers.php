<?php
require 'config/BBDD.php';
require 'app/models/login.php';

function MostrarLogin() {
    require 'app/views/formularioLogin.php';
}

function Comprobarusuari($correu, $contrasenya) {
    $loginCorreu = LoginCorreu($correu);
    if ($loginCorreu) {
        $loginContrasenya = LoginContrasenya($contrasenya, $correu);
        if ($loginContrasenya) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function ObtenerIdUsuario($correu) {
    global $pdo;
    $sql = "SELECT id_usuari FROM usuaris WHERE correu_usuari = :correu";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correu', $correu, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}
?>