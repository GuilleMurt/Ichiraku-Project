<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Anime - Ichiraku Project</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="pagina">
        <h1><?php echo htmlspecialchars($anime['titol']); ?></h1>
        <p><?php echo htmlspecialchars($anime['descripcio']); ?></p>
        <p><strong>Año:</strong> <?php echo htmlspecialchars($anime['any']); ?></p>
        <p><strong>Género:</strong> <?php echo htmlspecialchars($anime['genere']); ?></p>
        <p><strong>Total Episodios:</strong> <?php echo htmlspecialchars($anime['total_episodis']); ?></p>

        <h2>Valoraciones</h2>
        <?php foreach ($valoraciones as $valoracion): ?>
            <div class="valoracion">
                <p><strong><?php echo htmlspecialchars($valoracion['nom_usuari']); ?>:</strong> <?php echo htmlspecialchars($valoracion['puntuacio']); ?>/10</p>
                <p><?php echo htmlspecialchars($valoracion['comentari']); ?></p>
            </div>
        <?php endforeach; ?>

        <h2>Agregar Valoración</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="accio" value="agregarValoracion">
            <input type="hidden" name="id_anime" value="<?php echo $anime['id_anime']; ?>">
            <label for="puntuacio">Puntuación:</label>
            <input type="number" id="puntuacio" name="puntuacio" min="1" max="10" step="0.1" required>
            <label for="comentari">Comentario:</label>
            <textarea id="comentari" name="comentari" required></textarea>
            <button type="submit">Enviar</button>
        </form>

        <h2>Actualizar Estado</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="accio" value="actualizarEstadoAnime">
            <input type="hidden" name="id_anime" value="<?php echo $anime['id_anime']; ?>">
            <select name="id_estat">
                <option value="1">Vist</option>
                <option value="2">Seguint</option>
                <option value="3">Pensat Veure</option>
                <option value="4">Deixat</option>
            </select>
            <button type="submit">Actualizar</button>
        </form>

        <h2>Cerrar Sesión</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="accio" value="logout">
            <button type="submit">Log Out</button>
        </form>
    </div>
</body>
</html>