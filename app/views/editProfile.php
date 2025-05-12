<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Perfil</title>
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="public/css/editProfile.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <!-- Skeleton de carga -->
  <div class="edit-profile-skeleton" style="display: block;">
    <div class="skeleton-banner"></div>
    <div class="skeleton-profile-card">
      <div class="skeleton-img"></div>
      <div class="skeleton-text"></div>
      <div class="skeleton-text"></div>
      <div class="skeleton-text"></div>
    </div>
  </div>

  <!-- Página de edición del perfil -->
  <div class="edit-profile-page" style="display: none;">
    <!-- Sección de Portada y Foto de Perfil -->
    <section class="profile-header">
      <div class="banner">
        <img src="public/img/about-pic.png" alt="Banner">
      </div>
      <div class="profile-card">
        <!-- Foto de Perfil -->
        <div class="profile-image">
          <img class="user-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRH0HIgct6YSTIJPU-eGd9Vtgslh8vnXT4wWg&s" alt="Foto de Perfil">
        </div>

        <!-- Formulario para editar el perfil -->
        <form action="" method="POST">
          <div class="input-field">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" placeholder="Ingrese su nombre" required>
          </div>
          <div class="input-field">
            <label for="email">Correu Electrónic</label>
            <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required>
          </div>

          <!-- Cambiar foto de perfil -->
          <div class="file-input">
            <label for="profile-img">Cambiar Foto de Perfil</label>
            <input type="file" id="profile-img" name="profile-img" accept="image/*">
          </div>

          <!-- Botón para guardar cambios -->
          <button type="submit" class="btn-save">Desar Canvis</button>
        </form>

        <!-- Barra de navegación -->
        <nav class="profile-nav">
          <ul>
            <li><a href="<?=url.'?controller=profile'?>">El Meu Perfil</a></li>
            <li><a href="#">Cambiar Contrasenya</a></li>
          </ul>
        </nav>
      </div>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="config/parameters.js"></script>
  <script src="app/js/editProfile.js"></script>
</body>

</html>
