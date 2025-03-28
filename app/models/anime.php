<?php
require 'config/BBDD.php';

class Anime {
    protected $anime_id;
    protected $title;
    protected $description;
    protected $year;
    protected $genre;
    protected $total_chapters;

    public function __construct() {}

    // Obtener todos los animes
    public static function getAllAnimes() {
        $conn = db::connect();
        $sql = "SELECT * FROM animes";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un anime por su ID
    public static function getAnimeById($anime_id) {
        $conn = db::connect();
        $sql = "SELECT * FROM animes WHERE anime_id = :anime_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar un nuevo anime
    public static function registerAnime($title, $description, $year, $genre, $total_chapters) {
        $conn = db::connect();
        $sql = "INSERT INTO animes (title, description, year, genre, total_chapters) 
                VALUES (:title, :description, :year, :genre, :total_chapters)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->bindParam(':total_chapters', $total_chapters, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar un anime
    public static function updateAnime($anime_id, $title, $description, $year, $genre, $total_chapters) {
        $conn = db::connect();
        $sql = "UPDATE animes 
                SET title = :title, description = :description, year = :year, genre = :genre, total_chapters = :total_chapters 
                WHERE anime_id = :anime_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':year', $year, PDO::PARAM_INT);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->bindParam(':total_chapters', $total_chapters, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Eliminar un anime
    public static function deleteAnime($anime_id) {
        $conn = db::connect();
        $sql = "DELETE FROM animes WHERE anime_id = :anime_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Getters y Setters
    public function getAnimeId() {
        return $this->anime_id;
    }

    public function setAnimeId($anime_id) {
        $this->anime_id = $anime_id;
        return $this;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
        return $this;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
        return $this;
    }

    public function getTotalChapters() {
        return $this->total_chapters;
    }

    public function setTotalChapters($total_chapters) {
        $this->total_chapters = $total_chapters;
        return $this;
    }
}
/* function ObtenerTodosLosAnimes() {
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
} */
?>