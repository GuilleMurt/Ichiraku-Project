<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actors</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <?php require_once 'funcions.php';?>

</head>
<body>
    <header><h1 class="titolheader">Actors</h1> <img onclick="window.location.href='menu.php'" class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>

    <div class="pagina">
        
    <form action="buscarActor.php" method="GET" class="buscador">
            <input class="inputbusqueda" type="text" name="busqueda" id="inputbusqueda" placeholder="Introdueix el nom del actor/actriu...">
            <button type="submit" id="botobusqueda">Buscar</button>
    </form>
    <?php
        $pdo = conectarBD($basededades, $usuari ,$contrasenya);
        mostrarActors($pdo);
    ?>
    <button id="botoAfegir" onclick="window.location.href='afegirActor.php'">Afegir Actor</button>
    <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
</div>
</body>
</html>