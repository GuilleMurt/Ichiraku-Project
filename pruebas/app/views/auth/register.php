<!DOCTYPE html>
<html>
<head>
    <title>Registre</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <form action="/app/controllers/UserController.php?action=register" method="POST">
        <input type="text" name="name" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contrasenya" required>
        <button type="submit">Registrar-se</button>
    </form>
</body>
</html>