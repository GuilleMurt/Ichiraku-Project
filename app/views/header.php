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
    <div class="ichiraku-header">
        <div class="ichiraku-logo">
            <a href="<?=url.'?controller=home'?>" id="home-link"><img class="ichiraku-logo-img" src="public/img/ichiraku_logo.webp" alt=""></a>
        </div>
        <div id="menu-header">
            <nav class="ichiraku-nav-header">
                <ul id="navComputer">
                    <li><a href="<?=url.'?controller=home'?>" class="ichiraku-nav-link">Inici</a></li>
                    <li><a href="<?=url.'?controller=about'?>" class="ichiraku-nav-link">Sobre Nosaltres</a></li>
                    <li><a href="<?=url.'?controller=userList'?>" class="ichiraku-nav-link">Llista Anime</a></li>
                </ul>
            </nav>
        </div>
        <ul class="ichiraku-user-header">
          <li class="ichiraku-dropdown">
            <a href="#" class="ichiraku-nav-link ichiraku-dropdown-toggle" id="userDropdown"></a>
            <ul class="ichiraku-dropdown-menu" id="dropdownMenu">
              <li><a href="<?=url.'?controller=profile'?>" class="ichiraku-dropdown-item">
              <i class="fas fa-user"></i>
                Perfil
            </a></li>
              <li><a href="<?=url.'?action=logout'?>" class="ichiraku-dropdown-item ichiraku-logout-link">
                <i class="fas fa-sign-out-alt"></i>
                Sortir
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