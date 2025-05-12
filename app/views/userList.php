<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Animes</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/userList.css">
  <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
  <div class="container mt-5">
    <h1 class="text-center mb-4">Els Meus Animes</h1>

    <!-- Contenedor de los animes -->
    <div id="anime-list"></div>

    <div id="skeleton-loader" class="skeleton-container">
      <!-- Skeleton para una sección -->
      <div class="skeleton-section">
        <h2 class="skeleton skeleton-title"></h2>
        <div class="skeleton-cards">
          <!-- Skeleton para una tarjeta -->
          <div class="skeleton-card">
            <div class="skeleton skeleton-image"></div>
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text"></div>
          </div>
          <div class="skeleton-card">
            <div class="skeleton skeleton-image"></div>
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text"></div>
          </div>
          <div class="skeleton-card">
            <div class="skeleton skeleton-image"></div>
            <div class="skeleton skeleton-text"></div>
            <div class="skeleton skeleton-text"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="notification-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;"></div>
  
  <!-- Modal para editar anime -->
  <div class="modal fade" id="editAnimeModal" tabindex="-1" aria-labelledby="editAnimeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editAnimeModalLabel">Editar Anime</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editAnimeForm">
            <div class="mb-3">
              <label for="animeTitle" class="form-label">Títol</label>
              <input type="text" class="form-control" id="animeTitle" readonly>
            </div>
            <div class="mb-3">
              <label for="animeStatus" class="form-label">Estat</label>
              <select class="form-select" id="animeStatus">
                <option value="2">Seguint</option>
                <option value="3">Pensant Veure</option>
                <option value="4">Deixat</option>
                <option value="1">Vist</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="animeChapter" class="form-label">Capítol</label>
              <input type="number" class="form-control" id="animeChapter" min="0">
            </div>
            <div class="mb-3">
              <label for="animeChapter" class="form-label">Puntuació</label>
              <input type="number" class="form-control" id="animeRating" min="0" max="10">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tancar</button>
          <button type="button" class="btn btn-primary" id="saveAnimeChanges">Desar Canvis</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="config/parameters.js"></script>
  <script src="app/js/userList.js"></script>
</body>

</html>