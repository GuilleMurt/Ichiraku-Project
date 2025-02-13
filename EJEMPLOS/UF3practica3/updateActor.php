<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir actor</title>
    <?php require_once('funcions.php'); ?>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>
    <header><h1 class="titolheader">Actors</h1> <img class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
    <div class="pagina">
        <?php
            $idActor = $_POST['id'];
            $nomActor = $_POST['nom'];
            $idPais = $_POST['pais'];
            $imatgeActor = ($_POST['imatge'] == '') ? "./imatges/senseImatge.webp" : $_POST['imatge'];

            $pdo = conectarBD($basededades, $usuari, $contrasenya);
            updateActor($pdo,$idActor ,$nomActor, $idPais, $imatgeActor);

        ?>
        <button onclick="window.location.href='actors.php'">Tornar</button>
    </div>
    <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
</body>
</html>