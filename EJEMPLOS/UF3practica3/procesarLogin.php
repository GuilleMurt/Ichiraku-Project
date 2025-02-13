<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./CSS/styles.css">
    <?php require_once 'funcions.php';?>
</head>
<body>
    <div class="pagina">
        <?php
            $pdo = conectarBD($basededades, $usuari ,$contrasenya);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['usuari'] ?? '';
                $pass = $_POST['contrasenya'] ?? '';
                $validacio = validarUsuari($pdo, $nombre, $pass);
                if ($validacio) {
                    header("Location: menu.php");
                    exit();
                } else {?>
                    <h1>Usuari o contrasenya incorrectes</h1>
                    <button onclick="window.location.href='index.php'">Tornar</button>
                <?php }
            }
        ?>
    </div>

</body>
</html>
