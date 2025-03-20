<!-- filepath: d:\Xampp\htdocs\Ichiraku-Project-2\app\views\login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="login">
        <label for="email">Correo:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Iniciar Sesión</button>
        <a href="index.php?action=register">¿No tienes cuenta? Regístrate</a>
    </form>
</body>
</html>