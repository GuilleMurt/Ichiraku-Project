<?php
require_once 'app/models/Rating.php';
require_once 'config.php';

class RatingController {
    public function rate() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/auth/login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            $animeId = $_POST['anime_id'];
            $rating = $_POST['rating'];
            Rating::addRating($userId, $animeId, $rating);
            header("Location: /app/views/anime/show.php?id=$animeId");
        }
    }
}
?>