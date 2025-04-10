<?php
require_once 'config/db.php';

class Anime {
    protected $anime_id;
    protected $title;
    protected $image;
    protected $total_chapters;
    protected $status;

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
    public static function registerAnime($anime_id, $title, $image, $total_chapters, $status) {
        $conn = db::connect();
        $sql = "INSERT INTO animes (anime_id, title, image, total_chapters, status) 
                VALUES (:anime_id, :title, :image, :total_chapters, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':total_chapters', $total_chapters, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
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

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function getTotalChapters() {
        return $this->total_chapters;
    }

    public function setTotalChapters($total_chapters) {
        $this->total_chapters = $total_chapters;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
}
?>