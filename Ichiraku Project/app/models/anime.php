<?php
require 'config/BBDD.php';

function ObtenerTodosLosAnimes() {
    global $pdo;
    $sql = "SELECT * FROM animes";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function ObtenerAnimePorId($id_anime) {
    global $pdo;
    $sql = "SELECT * FROM animes WHERE id_anime = :id_anime";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_anime', $id_anime, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function ObtenerValoracionesPorAnime($id_anime) {
    global $pdo;
    $sql = "SELECT v.*, u.nom_usuari FROM valoracions v JOIN usuaris u ON v.id_usuari = u.id_usuari WHERE id_anime = :id_anime";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_anime', $id_anime, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function AgregarValoracionAnime($id_anime, $id_usuari, $puntuacio, $comentari) {
    global $pdo;
    $sql = "INSERT INTO valoracions (id_anime, id_usuari, puntuacio, comentari) VALUES (:id_anime, :id_usuari, :puntuacio, :comentari)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_anime', $id_anime, PDO::PARAM_INT);
    $stmt->bindParam(':id_usuari', $id_usuari, PDO::PARAM_INT);
    $stmt->bindParam(':puntuacio', $puntuacio, PDO::PARAM_STR);
    $stmt->bindParam(':comentari', $comentari, PDO::PARAM_STR);
    return $stmt->execute();
}

function ActualizarEstadoAnimeBD($id_usuari, $id_anime, $id_estat) {
    global $pdo;
    $sql = "INSERT INTO usuari_anime (id_usuari, id_anime, id_estat) VALUES (:id_usuari, :id_anime, :id_estat)
            ON DUPLICATE KEY UPDATE id_estat = :id_estat";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_usuari', $id_usuari, PDO::PARAM_INT);
    $stmt->bindParam(':id_anime', $id_anime, PDO::PARAM_INT);
    $stmt->bindParam(':id_estat', $id_estat, PDO::PARAM_INT);
    return $stmt->execute();
}
?>