<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registre</title>
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="public/css/register.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <?php if (isset($message)): ?>
  <div class="global-alert alert alert-<?= $messageType ?> alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($message) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tancar"></button>
  </div>
  <?php endif; ?>


  <div class="register-container">

    <!-- Lado izquierdo: Formulario -->
    <div class="register-form-side">
      <form action="index.php" method="POST">
        <input type="hidden" name="action" value="register">
        <label for="user_name">Nom d'Usuari:</label>
        <input type="text" id="user_name" name="user_name" required>
        <label for="email">Correu:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Contrasenya:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Registrar-se</button>
        <a href="index.php">Tornar al login</a>
      </form>
    </div>

    <!-- Lado derecho: Ilustración -->
    <div class="register-image-side">
      <img src="public/img/register.webp" alt="Registre Il·lustració">
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  setTimeout(() => {
    const alert = document.querySelector('.global-alert');
    if (alert) {
      alert.classList.remove('show');
      alert.classList.add('fade');
      setTimeout(() => alert.remove(), 500);
    }
  }, 5000);
  </script>


</body>

</html>