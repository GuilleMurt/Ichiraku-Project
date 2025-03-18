<?php
require 'app/controllers/AnimeController.php';
$controller = new AnimeController();
$controller->show($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($anime['title']) ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1><?= htmlspecialchars($anime['title']) ?></h1>
    <p><?= htmlspecialchars($anime['description']) ?></p>
</body>
</html>