<?php

require 'config/BBDD.php';

function LoginCorreu($correu) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM usuaris WHERE correu_usuari = :correu";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correu', $correu, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

function LoginContrasenya($contrasenya, $correu) {
    global $pdo;
    $sql = "SELECT contrasenya_usuari FROM usuaris WHERE correu_usuari = :correu";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correu', $correu, PDO::PARAM_STR);
    $stmt->execute();
    $contrasenyaComprobat = $stmt->fetchColumn();
    return $contrasenya === $contrasenyaComprobat;
}
?>
