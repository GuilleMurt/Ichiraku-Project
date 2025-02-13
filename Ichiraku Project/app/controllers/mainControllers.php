<?php
require 'config/BBDD.php';
require 'app/models/Login.php';

function MostrarLogin() {
    require 'app/views/formularioLogin.php';
}

function Comprobarusuari($correu, $contrasenya) {
    //llamamos a la funcion LoginCorreu
    $loginCorreu = LoginCorreu($correu);
    if ($loginCorreu){
        $loginContrasenya = LoginContrasenya($contrasenya,$correu);
        if ($loginContrasenya){
            return true;
        } else {
            return false;
        }
    }else{
        return false;
    }
}