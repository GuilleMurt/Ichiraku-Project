<!DOCTYPE html>
<html>
<head>
    <title>Amics</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Els teus Amics</h1>
    <form method="POST" action="/app/controllers/CommunityController.php">
        <label for="friend_id">ID de l'amic:</label>
        <input type="number" name="friend_id" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>
