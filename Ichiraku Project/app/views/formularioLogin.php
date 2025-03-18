<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ichiraku Project</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <section class="pagina">
        <div class="formulari">
            <form action="index.php" method="POST">
                <h1 id="titolIndex">Inicia sessió</h1>
                <label for="correu">Correu:</label>
                <input type="text" id="correu" name="correu" placeholder="Introdueix el teu correu" required>
                <label for="contrasenya">Contrasenya:</label>
                <input type="password" id="contrasenya" name="contrasenya" placeholder="Introdueix la contrasenya" required>
                <button name="accio" value="login" type="submit">Inicia Sessió</button>
            </form>
            <form action="index.php" method="POST">
                <button name="accio" value="registre" type="submit">Registra't</button>
            </form>
        </div>
    </section>
</body>
</html>