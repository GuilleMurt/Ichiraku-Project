<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar pais</title>
    <?php require 'funcions.php' ?>
    <link rel="stylesheet" href="./CSS/styles.css">
</head>
<body>
    <?php 
        $idPais = $_GET['idPais'];
        $pdo = conectarBD($basededades, $usuari, $contrasenya);
        $dadesPais = consultarPais($pdo, $idPais);
    ?>
    <header><h1 class="titolheader">Eliminar: <?php echo $dadesPais['nombrePais'] ?></h1> <img onclick="window.location.href='paisos.php'" class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
    <div class="pagina">
        <h2>Estàs segur de que vols eliminar "<?php echo $dadesPais['nombrePais']?>"</h2>
        <div class="botonsmenu">
            <button onclick="window.location.href='paisos.php'">Cancelar</button>
            <button onclick="window.location.href='deletePais.php?idPais=<?php echo $idPais?>'">Eliminar</button>
        </div>
        
    </div>
    <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
</body>
</html>