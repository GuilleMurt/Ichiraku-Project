<?php
require_once 'app/models/Community.php';
require_once 'config.php';

class CommunityController {
    public function addFriend() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/auth/login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            $friendId = $_POST['friend_id'];
            Community::addFriend($userId, $friendId);
            header("Location: /app/views/community/friends.php");
        }
    }
}
?>