<!DOCTYPE html>
<html>
<head>
    <title>Puntua l'Anime</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Puntua l'Anime</h1>
    <form method="POST" action="/app/controllers/RatingController.php">
        <input type="hidden" name="anime_id" value="<?= $_GET['id'] ?>">
        <label for="rating">Puntuació (1-10):</label>
        <input type="number" name="rating" min="1" max="10" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>