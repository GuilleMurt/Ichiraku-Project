<?php
class Stats {
    public static function getUserStats($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM user_animes WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>