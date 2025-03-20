<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ichiraku Project</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/header.css">
</head>
<body>
<header>
    <div class="header">
        <div class="logo">
            <a href="<?=url.'?controller=home'?>"><img class="logo-ichiraku" src="public/img/ichiraku_logo.webp" alt=""></a>
        </div>
        <div id="menu-header">
            <nav class="nav-header">
                <ul id="navComputer">
                    <li><a href="<?=url.'?controller=formacion'?>" class="nav-link">Inici</a></li>
                    <li><a href="<?=url.'?controller=calendario'?>" class="nav-link">Navegar</a></li>
                    <li><a href="<?=url.'?controller=serviciosIT'?>" class="nav-link">Llista Anime</a></li>
                </ul>
            </nav>
        </div>
        <ul class="user-header">
          <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="userDropdown">Usuari</a>
            <ul class="dropdown-menu" id="dropdownMenu">
              <li><a href="<?=url.'?controller=perfil'?>" class="dropdown-item">Perfil</a></li>
              <li><a href="index.php?action=logout" class="dropdown-item">Logout</a></li>
            </ul>
          </li>
        </ul>
    </div>
</header>

<script src="app/js/header.js"></script>
</body>
</html>