<?php
require 'app/controllers/AnimeController.php';
$controller = new AnimeController();
$controller->index();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Llistat d'Animes</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Llistat d'Animes</h1>
    <ul>
        <?php foreach ($animes as $anime): ?>
            <li>
                <a href="/app/views/anime/show.php?id=<?= $anime['id'] ?>">
                    <?= htmlspecialchars($anime['title']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>