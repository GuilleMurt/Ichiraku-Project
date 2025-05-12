<?php
require_once 'config/db.php';

class UserAnimes {
    protected $anime_users_id;
    protected $user_id;
    protected $anime_id;
    protected $stat_id;
    protected $chapter;
    protected $updated_at;

    public function __construct() {}

    // Obtener todos los registros de anime_users
    public static function getAllUserAnimes() {
        $conn = db::connect();
        $sql = "SELECT * FROM anime_users";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un registro por su ID
    public static function getUserAnimeById($anime_users_id) {
        $conn = db::connect();
        $sql = "SELECT * FROM anime_users WHERE anime_users_id = :anime_users_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anime_users_id', $anime_users_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener todos los animes de un usuario
    public static function getUserAnimesByUserId($user_id) {
        $conn = db::connect();
        $sql = "SELECT * FROM anime_users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener si un anime es registrado para un usuario
    public static function getUserAnimeByUserAndAnimeId($user_id, $anime_id) {
        $conn = db::connect();
        $sql = "SELECT * FROM anime_users WHERE user_id = :user_id AND anime_id = :anime_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar un nuevo anime para un usuario
    public static function registerUserAnime($user_id, $anime_id, $stat_id, $chapter, $rating) {
        $conn = db::connect();
        $sql = "INSERT INTO anime_users (user_id, anime_id, stat_id, chapter, rating, updated_at) 
                VALUES (:user_id, :anime_id, :stat_id, :chapter, :rating, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->bindParam(':stat_id', $stat_id, PDO::PARAM_INT);
        $stmt->bindParam(':chapter', $chapter, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Actualizar un registro de anime para un usuario
    public static function updateUserAnime($anime_id, $user_id, $chapter, $stat_id, $rating) {
        $conn = db::connect();
    
        $sql = "UPDATE anime_users 
                SET stat_id = :stat_id, chapter = :chapter, rating = :rating, updated_at = NOW()
                WHERE anime_id = :anime_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':chapter', $chapter, PDO::PARAM_INT);
        $stmt->bindParam(':stat_id', $stat_id, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
    
        $result = $stmt->execute();
    
        // Verificar si la actualización fue exitosa
        if ($result) {
            $sql2 = "SELECT * FROM anime_users WHERE anime_id = :anime_id AND user_id = :user_id";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
            $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt2->execute();
    
            // Devolver los datos actualizados
            return $stmt2->fetch(PDO::FETCH_ASSOC);
        } else {
            // Si la actualización falla, devolver false o un mensaje de error
            return false;
        }
    }

    // Obtener los capítulos de un anime para un usuario
    public static function getUserAnimeChapters($anime_id, $user_id) {
        $conn = db::connect();
        $sql = "SELECT * FROM anime_users WHERE anime_id = :anime_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anime_id', $anime_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar un registro de anime para un usuario
    public static function deleteUserAnime($anime_users_id) {
        $conn = db::connect();
        $sql = "DELETE FROM anime_users WHERE anime_users_id = :anime_users_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':anime_users_id', $anime_users_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Getters y Setters
    public function getAnimeUsersId() {
        return $this->anime_users_id;
    }

    public function setAnimeUsersId($anime_users_id) {
        $this->anime_users_id = $anime_users_id;
        return $this;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
        return $this;
    }

    public function getAnimeId() {
        return $this->anime_id;
    }

    public function setAnimeId($anime_id) {
        $this->anime_id = $anime_id;
        return $this;
    }

    public function getStatId() {
        return $this->stat_id;
    }

    public function setStatId($stat_id) {
        $this->stat_id = $stat_id;
        return $this;
    }

    public function getChapter() {
        return $this->chapter;
    }

    public function setChapter($chapter) {
        $this->chapter = $chapter;
        return $this;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
        return $this;
    }
}
?>