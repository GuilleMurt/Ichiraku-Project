<?php
class Rating {
    public static function addRating($userId, $animeId, $rating) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO ratings (user_id, anime_id, rating) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE rating = ?");
        return $stmt->execute([$userId, $animeId, $rating, $rating]);
    }

    public static function getAverageRating($animeId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE anime_id = ?");
        $stmt->execute([$animeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>