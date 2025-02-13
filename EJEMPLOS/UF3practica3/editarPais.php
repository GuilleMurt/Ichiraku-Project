<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Actor</title>
        <link rel="stylesheet" href="./CSS/styles.css">
        <?php require_once 'funcions.php'?>
    </head>
    <body>
        <?php 
            $idPais = $_GET['idPais'];
            $pdo = conectarBD($basededades, $usuari, $contrasenya);
            $dadesPais = consultarPais($pdo, $idPais);
        ?>
        <header><h1 class="titolheader">Editar: <?php echo $dadesPais['nombrePais'] ?></h1> <img onclick="window.location.href='paisos.php'" class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
        <div class="pagina">
            <form class="formulari" action="updatePais.php" method="post">
                <input type="hidden" name="id" value="<?php echo $idPais ?>">
                <label for="nom">Pais:</label>
                <input type="text" value="<?php echo $dadesPais['nombrePais'] ?>" name="nom" id="nom" placeholder="Introdueix el nom del pais..." required><br>
                <button type="submit">Editar</button>
            </form>
        </div>
        <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
    </body>
</html>