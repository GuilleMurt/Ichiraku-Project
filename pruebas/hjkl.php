



// config.php - Connexió a la base de dades
<?php
$host = 'localhost';
$dbname = 'animeDB';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la connexió: " . $e->getMessage());
}
?>

// AuthController.php - Controlador d'Autenticació
<?php
require_once 'app/models/User.php';
require_once 'config.php';

class AuthController {
    public function login() {
        require 'app/views/auth/login.php';
    }

    public function register() {
        require 'app/views/auth/register.php';
    }

    public function authenticate() {
        global $pdo;
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: /public/index.php");
        } else {
            echo "Credencials incorrectes";
        }
    }
}
?>

// User.php - Model de l'usuari
<?php
class User {
    public static function create($name, $email, $password) {
        global $pdo;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $hashedPassword]);
    }
}
?>

// login.php - Formulari d'inici de sessió
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /public/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <form action="/app/controllers/AuthController.php?action=authenticate" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contrasenya" required>
        <button type="submit">Iniciar Sessió</button>
    </form>
</body>
</html>

// register.php - Formulari de registre
<!DOCTYPE html>
<html>
<head>
    <title>Registre</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <form action="/app/controllers/UserController.php?action=register" method="POST">
        <input type="text" name="name" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Contrasenya" required>
        <button type="submit">Registrar-se</button>
    </form>
</body>
</html>























// Anime.php - Model d'anime
<?php
class Anime {
    public static function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM animes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM animes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

// AnimeController.php - Controlador d'animes
<?php
require_once 'app/models/Anime.php';
require_once 'config.php';

class AnimeController {
    public function index() {
        $animes = Anime::getAll();
        require 'app/views/anime/index.php';
    }

    public function show($id) {
        $anime = Anime::getById($id);
        require 'app/views/anime/show.php';
    }
}
?>

// index.php - Vista llistat d'animes
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

// show.php - Vista detall d'un anime
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

// Stats.php - Model d'estadístiques
<?php
class Stats {
    public static function getUserStats($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total FROM user_animes WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

// UserController.php - Controlador d'usuari
<?php
require_once 'app/models/User.php';
require_once 'app/models/Stats.php';
require_once 'config.php';

class UserController {
    public function profile() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/auth/login.php");
            exit;
        }

        $user = User::getById($_SESSION['user_id']);
        $stats = Stats::getUserStats($_SESSION['user_id']);
        require 'app/views/user/profile.php';
    }
}
?>







// Rating.php - Model de valoracions
<?php
class Rating {
    public static function addRating($userId, $animeId, $rating) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO ratings (user_id, anime_id, rating) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE rating = ?");
        return $stmt->execute([$userId, $animeId, $rating, $rating]);
    }

    public static function getAverageRating($animeId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE anime_id = ?");
        $stmt->execute([$animeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

// RatingController.php - Controlador de valoracions
<?php
require_once 'app/models/Rating.php';
require_once 'config.php';

class RatingController {
    public function rate() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/auth/login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            $animeId = $_POST['anime_id'];
            $rating = $_POST['rating'];
            Rating::addRating($userId, $animeId, $rating);
            header("Location: /app/views/anime/show.php?id=$animeId");
        }
    }
}
?>

// rate.php - Vista per puntuar anime
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

// Community.php - Model d'amics i comunitat
<?php
class Community {
    public static function addFriend($userId, $friendId) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO friends (user_id, friend_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $friendId]);
    }

    public static function getFriendsActivity($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT u.username, a.title FROM user_animes ua JOIN animes a ON ua.anime_id = a.id JOIN users u ON ua.user_id = u.id WHERE ua.user_id IN (SELECT friend_id FROM friends WHERE user_id = ?)");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

// CommunityController.php - Controlador d'amics i comunitat
<?php
require_once 'app/models/Community.php';
require_once 'config.php';

class CommunityController {
    public function addFriend() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /public/auth/login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_SESSION['user_id'];
            $friendId = $_POST['friend_id'];
            Community::addFriend($userId, $friendId);
            header("Location: /app/views/community/friends.php");
        }
    }
}
?>

// friends.php - Vista d'amics
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
