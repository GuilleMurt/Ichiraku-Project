<?php

require 'config/BBDD.php';

function LoginCorreu ($correu){
    global $pdo;
    // comprobar si el correu existeix en la base de dades
    $sql = "SELECT COUNT(*) FROM usuaris WHERE correu_usuari = :correu";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correu', $correu, PDO::PARAM_STR);
    $stmt->execute();

    $correuComprobat = $stmt->fetchColumn();
    return $correuComprobat > 0;

}

function LoginContrasenya ($contrasenya,$correu){
    global $pdo;
    // comprobar si la contrasenya existeix en la base de dades
    $sql = "SELECT contrasenya_usuari FROM usuaris WHERE correu_usuari = :correu";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':correu', $correu, PDO::PARAM_STR);
    $stmt->execute();
    
    $contrasenyaComprobat = $stmt->fetchColumn();
    // return password_verify($contrasenya, $contrasenyaComprobat);
    if($contrasenya == $contrasenyaComprobat){
        return true;
    }else{
        return false;
    }
}
