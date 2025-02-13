<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar actor</title>
        <?php require_once 'funcions.php';?>
        <link rel="stylesheet" href="./CSS/styles.css">
    </head>
    <body>
        <?php 
            $idActor = $_GET['idActor'];
            $pdo = conectarBD($basededades, $usuari, $contrasenya);
            $dadesactor = consultarActor($pdo, $idActor);
        ?>
        <header><h1 class="titolheader">Eliminar: <?php echo $dadesActor['nombreActor'] ?></h1> <img onclick="window.location.href='actors.php'" class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
        <div class="pagina">
            <?php 
                deleteActor($pdo, $idActor);
            ?>
            <button onclick="window.location.href='actors.php'">Tornar</button>
        </div>
        <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
    </body>
</html>