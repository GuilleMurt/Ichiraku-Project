<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ichiraku Project</title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <div class="header">
        <div class="logo">
            <a href="<?=url.'?controller=home'?>" id="home-link"><img class="logo-ichiraku" src="public/img/ichiraku_logo.webp" alt=""></a>
        </div>
        <div id="menu-header">
            <nav class="nav-header">
                <ul id="navComputer">
                    <li><a href="<?=url.'?controller=home'?>" class="nav-link">Inici</a></li>
                    <li><a href="<?=url.'?controller=about'?>" class="nav-link">Sobre Nosaltres</a></li>
                    <li><a href="<?=url.'?controller=serviciosIT'?>" class="nav-link">Llista Anime</a></li>
                </ul>
            </nav>
        </div>
        <ul class="user-header">
          <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="userDropdown"></a>
            <ul class="dropdown-menu" id="dropdownMenu">
              <li><a href="<?=url.'?controller=profile'?>" class="dropdown-item">
              <i class="fas fa-user"></i>
                Perfil
            </a></li>
              <li><a href="<?=url.'?action=logout'?>" class="dropdown-item logout-link">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a></li>
            </ul>
          </li>
        </ul>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="config/parameters.js"></script>
<script src="app/js/header.js"></script>
</body>
</html>