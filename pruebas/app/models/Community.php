<?php
class Community {
    public static function addFriend($userId, $friendId) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO friends (user_id, friend_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $friendId]);
    }

    public static function getFriendsActivity($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT u.username, a.title FROM user_animes ua JOIN animes a ON ua.anime_id = a.id JOIN users u ON ua.user_id = u.id WHERE ua.user_id IN (SELECT friend_id FROM friends WHERE user_id = ?)");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>