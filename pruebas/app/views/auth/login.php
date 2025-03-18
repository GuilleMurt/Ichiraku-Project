<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /public/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <form action="/app/controllers/AuthController.php?action=authenticate" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contrasenya" required>
        <button type="submit">Iniciar Sessió</button>
    </form>
</body>
</html>