<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Països</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <?php require_once 'funcions.php';?>
</head>
<body>
    <header><h1 class="titolheader">Països</h1> <img onclick="window.location.href='menu.php'" class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>

    <div class="pagina">
        <?php 
            $pdo = conectarBD($basededades, $usuari ,$contrasenya);
            mostrarPaisos($pdo);
        ?>
        <button id="botoAfegir" onclick="window.location.href='afegirPais.php'">Afegir Pais</button>
    </div>
    <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
</body>
</html>