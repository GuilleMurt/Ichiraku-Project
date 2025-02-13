<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pais</title>
    <?php require_once('funcions.php'); ?>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>
    <header><h1 class="titolheader">Països</h1> <img class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
    <div class="pagina">
        <?php
            $idPais = $_POST['id'];
            $nomPais = $_POST['nom'];
            $pdo = conectarBD($basededades, $usuari, $contrasenya);
            updatePais($pdo, $idPais, $nomPais);
        ?>
        <button onclick="window.location.href='paisos.php'">Tornar</button>
    </div>
    <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
</body>
</html>