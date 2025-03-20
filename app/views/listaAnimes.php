<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Animes - Ichiraku Project</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="pagina">
        <h1>Lista de Animes</h1>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Año</th>
                    <th>Género</th>
                    <th>Total Episodios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($animes as $anime): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($anime['titol']); ?></td>
                        <td><?php echo htmlspecialchars($anime['any']); ?></td>
                        <td><?php echo htmlspecialchars($anime['genere']); ?></td>
                        <td><?php echo htmlspecialchars($anime['total_episodis']); ?></td>
                        <td>
                            <a href="index.php?accio=detalleAnime&id_anime=<?php echo $anime['id_anime']; ?>">Ver Detalles</a>
                            <form action="index.php" method="POST" style="display:inline;">
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
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>