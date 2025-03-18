<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Ichiraku Project</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="pagina">
        <form class="formulari" action="index.php" method="POST">
            <h1 id="titolIndex">Registra't</h1>
            <label for="usuari">Usuari:</label>
            <input type="text" id="usuari" name="usuari" placeholder="Introdueix el teu nom d'usuari" required>
            <label for="correu">Correu:</label>
            <input type="email" id="correu" name="correu" placeholder="Introdueix el teu correu" required>
            <label for="contrasenya">Contrasenya:</label>
            <input type="password" id="contrasenya" name="contrasenya" placeholder="Introdueix la contrasenya" required>
            <button name="accio" value="registre" type="submit">Registra't</button>
        </form>
    </div>
</body>
</html>