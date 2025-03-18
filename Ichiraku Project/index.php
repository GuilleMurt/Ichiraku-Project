<?php
session_start();
require 'app/controllers/mainControllers.php';
require 'app/controllers/registerController.php';
require 'app/controllers/animeController.php';

// Si el usuario no está autenticado, mostrar el formulario de inicio de sesión
if (!isset($_SESSION['usuario_id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accio'])) {
        if ($_POST['accio'] === 'login') {
            $correu = $_POST['correu'];
            $contrasenya = $_POST['contrasenya'];
            if (Comprobarusuari($correu, $contrasenya)) {
                $_SESSION['usuario_id'] = ObtenerIdUsuario($correu); // Guardar el ID del usuario en la sesión
                header("Location: /index.php");
                exit();
            } else {
                echo '<p class="error">Error: El usuario no existe o la contraseña es incorrecta.</p>';
                MostrarLogin();
            }
        } elseif ($_POST['accio'] === 'registre') {
            if (isset($_POST['usuari']) && isset($_POST['correu']) && isset($_POST['contrasenya'])) {
                $usuari = $_POST['usuari'];
                $correu = $_POST['correu'];
                $contrasenya = $_POST['contrasenya'];
                RegistrarUsuario($usuari, $correu, $contrasenya);
            } else {
                MostrarRegistro();
            }
        }
    } else {
        MostrarLogin();
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accio'])) {
        if ($_POST['accio'] === 'agregarValoracion') {
            $id_anime = $_POST['id_anime'];
            $id_usuari = $_SESSION['usuario_id']; // Obtener el ID del usuario logueado
            $puntuacio = $_POST['puntuacio'];
            $comentari = $_POST['comentari'];
            AgregarValoracion($id_anime, $id_usuari, $puntuacio, $comentari);
        } elseif ($_POST['accio'] === 'actualizarEstadoAnime') {
            $id_anime = $_POST['id_anime'];
            $id_usuari = $_SESSION['usuario_id'];
            $id_estat = $_POST['id_estat'];
            ActualizarEstadoAnime($id_usuari, $id_anime, $id_estat);
        } elseif ($_POST['accio'] === 'logout') {
            session_destroy();
            header("Location: /index.php");
            exit();
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['accio'])) {
        if ($_GET['accio'] === 'detalleAnime' && isset($_GET['id_anime'])) {
            $id_anime = $_GET['id_anime'];
            MostrarAnime($id_anime);
        } else {
            MostrarAnimes();
        }
    } else {
        MostrarAnimes();
    }
} else {
    MostrarLogin();
}

?>
