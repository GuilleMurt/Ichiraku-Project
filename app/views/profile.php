<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil de Usuario</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="public/css/profile.css">
</head>

<body>
  <div class="profile-skeleton">
    <!-- Skeleton para la portada -->
    <div class="skeleton-banner"></div>

    <!-- Skeleton para la tarjeta de perfil -->
    <div class="skeleton-profile-card">
      <div class="skeleton-profile-image"></div>
      <div class="skeleton-profile-info">
        <div class="skeleton skeleton-name"></div>
        <div class="skeleton skeleton-email"></div>
      </div>
      <div class="skeleton-stats">
        <div class="skeleton-stat">
          <div class="skeleton skeleton-icon"></div>
          <div class="skeleton skeleton-text"></div>
        </div>
        <div class="skeleton-stat">
          <div class="skeleton skeleton-icon"></div>
          <div class="skeleton skeleton-text"></div>
        </div>
        <div class="skeleton-stat">
          <div class="skeleton skeleton-icon"></div>
          <div class="skeleton skeleton-text"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="profile-page">
    <!-- Sección de Portada y Foto de Perfil -->
    <section class="profile-header">
      <div class="banner">
        <img src="public/img/about-pic.png" alt="Banner">
      </div>
      <div class="profile-card">
        <div class="profile-image">
          <img class="user-img" src="" alt="Foto de Perfil">
        </div>
        <div class="profile-info">
          <h1 class="user-name"></h1>
          <p class="user-email"></p>
        </div>
        <div class="stats">
          <div class="stat">
            <i class="fas fa-heart"></i>
            <span>300</span>
            <p>Favoritos</p>
          </div>
          <div class="stat">
            <i class="fas fa-book"></i>
            <span>120</span>
            <p>Animes Vistos</p>
          </div>
          <div class="stat">
            <i class="fas fa-users"></i>
            <span>800</span>
            <p>Seguidores</p>
          </div>
        </div>

        <nav class="profile-nav">
          <ul>
            <li><a href="#">Mis Animes</a></li>
            <li><a href="<?=url.'?controller=profile&action=editProfile'?>">Editar Perfil</a></li>
            <li><a href="<?=url.'?action=logout'?>">Cerrar Sesión</a></li>
          </ul>
        </nav>
      </div>
  </div>


  </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="config/parameters.js"></script>
  <script src="app/js/profile.js"></script>
</body>

</html>