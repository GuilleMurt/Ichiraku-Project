<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pràctica 3</title>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>
    <div class="pagina">
        <form class="formulari" action="procesarLogin.php" method="post">
            <h1 id="titolIndex">Inicia sessió</h1>
            <label for="usuari">Usuari:</label>
            <input type="text" id="usuari" name="usuari" placeholder="Introdueix el teu nom d'usuari" required>
            <label for="contrasenya">Contrasenya:</label>
            <input type="password" id="contrasenya" name="contrasenya" placeholder="Introdueix la contrasenya" required>
            
            <button type="submit">Accedir</button>
        </form>
    </div>
</body>
</html>