<?php
require 'config/BBDD.php';

function Registrar($usuari, $correu, $contrasenya) {
    global $pdo;
    $sql = "INSERT INTO usuaris (nom_usuari, correu_usuari, contrasenya_usuari) VALUES (:usuari, :correu, :contrasenya)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuari', $usuari, PDO::PARAM_STR);
    $stmt->bindParam(':correu', $correu, PDO::PARAM_STR);
    $stmt->bindParam(':contrasenya', $contrasenya, PDO::PARAM_STR);
    return $stmt->execute();
}
?>