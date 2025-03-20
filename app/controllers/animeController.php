<?php
require 'config/BBDD.php';
require 'app/models/anime.php';

function MostrarAnimes() {
    $animes = ObtenerTodosLosAnimes();
    require 'app/views/listaAnimes.php';
}

function MostrarAnime($id_anime) {
    $anime = ObtenerAnimePorId($id_anime);
    $valoraciones = ObtenerValoracionesPorAnime($id_anime);
    require 'app/views/detalleAnime.php';
}

function AgregarValoracion($id_anime, $id_usuari, $puntuacio, $comentari) {
    if (AgregarValoracionAnime($id_anime, $id_usuari, $puntuacio, $comentari)) {
        header("Location: /index.php?accio=detalleAnime&id_anime=$id_anime");
        exit();
    } else {
        echo '<p class="error">Error: No se pudo agregar la valoración.</p>';
        MostrarAnime($id_anime);
    }
}

function ActualizarEstadoAnime($id_usuari, $id_anime, $id_estat) {
    if (ActualizarEstadoAnimeBD($id_usuari, $id_anime, $id_estat)) {
        header("Location: /index.php");
        exit();
    } else {
        echo '<p class="error">Error: No se pudo actualizar el estado del anime.</p>';
        MostrarAnimes();
    }
}
?>