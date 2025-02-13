<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar actor</title>
        <?php require_once 'funcions.php' ?>
        <link rel="stylesheet" href="./CSS/styles.css">
    </head>
    <body>
        <?php 
            $idActor = $_GET['idActor'];
            $pdo = conectarBD($basededades, $usuari, $contrasenya);
            $dadesActor = consultarActor($pdo, $idActor);
        ?>
    <header><h1 class="titolheader">Eliminar: <?php echo $dadesActor['nombreActor'] ?></h1> <img onclick="window.location.href='actors.php'" class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
        <div class="pagina">
            <h2>Estàs segur de que vols eliminar a "<?php echo $dadesActor['nombreActor']?>"</h2>
            <div class="botonsmenu">
                <button onclick="window.location.href='actors.php'">Cancelar</button>
                <button onclick="window.location.href='deleteActor.php?idActor=<?php echo $idActor?>'">Eliminar</button>
            </div>
            
        </div>
        <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
    </body>
</html>