<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Afegir Actor</title>
        <link rel="stylesheet" href="./CSS/styles.css">
        <?php require_once 'funcions.php'?>
        <script src="./scripts/vistaPreviaImatge.js"></script>
    </head>
    <body>
        <script src=""></script>
        <header><h1 class="titolheader">Actors</h1> <img onclick="window.location.href='actors.php'" class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
        <div class="pagina">
            <form class="formulari" action="insertActor.php" method="post">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom" placeholder="Introdueix el nom complet de l'actor..." required><br>
                <label for="pais">Pais:</label>
                <select name="pais" required>
                <?php
                    $pdo = conectarBD($basededades, $usuari, $contrasenya);
                    omplirSelector($pdo);
                ?>
                </select><br>
                <label for="imatge">Imatge:</label>
                <input type="text" name="imatge" id="imatge" placeholder="Introdueix la direcció de la imatge 'https://...'">
                <h2>Vista prèvia</h2>
                <img class="imatgeVistaPrevia" id="imatgeVP" src="./imatges/senseImatge.webp" alt="No s'ha trobat la imatge"><br>
                <button type="submit">Afegir</button>
            </form>
        </div>
        <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
    </body>
</html>