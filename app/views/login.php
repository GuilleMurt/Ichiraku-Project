<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="public/css/login.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <div class="main-container">
    <?php if (isset($message)): ?>
      <div id="global-alert" class="alert alert-<?= $messageType ?> alert-dismissible fade show position-fixed start-50 translate-middle-x w-100 text-center" style="top: 200px; max-width: 500px; z-index: 9999;" role="alert">
      <?= htmlspecialchars($message) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tancar"></button>
    </div>
    <?php endif; ?>

    <div class="login-container">
      <div class="login-image">
        <img src="public/img/about-pic.png" alt="Login Illustration">
      </div>

      <div class="login-div">
        <img class="login-logo" src="public/img/ichiraku_logo.webp" alt="Login Illustration">
        <form action="index.php" method="POST">
          <input type="hidden" name="action" value="login">
          <label for="email">Correu:</label>
          <input type="email" id="email" name="email" required>
          <label for="password">Contrasenya:</label>
          <input type="password" id="password" name="password" required>
          <button type="submit">Iniciar Sessió</button>
          <a href="index.php?action=register">¿No tens compte? Regístra't</a>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  setTimeout(() => {
    const alert = document.querySelector('#global-alert');
    if (alert) {
      alert.classList.remove('show');
      alert.classList.add('fade');
      setTimeout(() => alert.remove(), 500);
    }
  }, 5000);
  </script>


</body>

</html>