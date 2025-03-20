<?php
require_once 'config/db.php';

class User {
    public static function getUserByEmail($email) {
        $conn = db::connect();
        $sql = "SELECT * FROM users WHERE user_email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function verifyPassword($email, $password) {
        $user = self::getUserByEmail($email);
        if ($user && password_verify($password, $user['user_password'])) {
            return $user['user_id']; // Retorna el ID del usuario si las credenciales son correctas
        }
        return false;
    }

    public static function registerUser($user_name, $email, $password) {
        $conn = db::connect();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>