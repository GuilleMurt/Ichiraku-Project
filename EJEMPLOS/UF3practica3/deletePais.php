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
        $idPais = $_GET['idPais'];
        $pdo = conectarBD($basededades, $usuari, $contrasenya);
        $dadesPais = consultarPais($pdo, $idPais);
    ?>
    <header><h1 class="titolheader">Eliminar: <?php echo $dadesPais['nombrePais'] ?></h1> <img onclick="window.location.href='paisos.php'" class="imatgeheader" src="./imatges/flechaizq.png" alt="Tornar"></header>
    <div class="pagina">
        <?php 

            deletePais($pdo, $idPais);
        ?>
        <button onclick="window.location.href='paisos.php'">Tornar</button>
    </div>
    <footer><p>Pràctica 3 - UF3 |  Lluc Moreno</p></footer>
</body>
</html>