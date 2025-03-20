<!-- filepath: d:\Xampp\htdocs\Ichiraku-Project-2\app\views\register.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/register.css">
</head>
<body>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="register">
        <label for="user_name">Nom d'Usuari:</label>
        <input type="text" id="user_name" name="user_name" required>
        <label for="email">Correu:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contrasenya:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Registrar-se</button>
        <a href="index.php">Tornar al login</a>
    </form>
</body>
</html>