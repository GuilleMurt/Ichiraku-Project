<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Afegir Pais</title>
        <link rel="stylesheet" href="./CSS/styles.css">
        <?php require_once 'funcions.php';?>
    </head>
    <body>
        <div class="pagina">
        <header><h1 class="titolheader">Actors</h1> <img class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
            <h1>Afegir pais</h1>
            <form class="formulari" action="insertPais.php" method="post">
                <label for="nom">Pais:</label>
                <input type="text" name="nom" id="nom" placeholder="Introdueix el nom del pais..." required><br><br>
                <button type="submit">Afegir</button>
            </form>
        </div>
        <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
    </body>
</html>