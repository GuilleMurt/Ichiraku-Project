<?php
require 'config/BBDD.php';
require 'app/models/register.php';

function MostrarRegistro() {
    require 'app/views/registre.php';
}

function RegistrarUsuario($usuari, $correu, $contrasenya) {
    if (Registrar($usuari, $correu, $contrasenya)) {
        echo '<p class="success">Usuario registrado correctamente. Por favor, inicia sesión.</p>';
        MostrarLogin();
    } else {
        echo '<p class="error">Error: No se pudo registrar el usuario.</p>';
        MostrarRegistro();
    }
}
?>