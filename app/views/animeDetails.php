<!-- filepath: d:\Xampp\htdocs\Ichiraku-Project-2\app\views\animeDetails.php -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalles del Anime</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/styles.css">
  <link rel="stylesheet" href="public/css/animeDetails.css">
</head>

<body>
  <div id="notification-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;"></div>

  <div id="skeleton-loader" class="skeleton-container">
    <!-- Banner -->
    <div class="skeleton skeleton-banner"></div>

    <!-- Info Card -->
    <div class="skeleton-info">
      <div class="skeleton skeleton-poster"></div>
      <div class="skeleton-meta">
        <div class="skeleton skeleton-title"></div>
        <div class="skeleton skeleton-stat-line"></div>
        <div class="skeleton skeleton-stat-line"></div>
        <div class="skeleton skeleton-stat-line"></div>
      </div>
      <div class="skeleton skeleton-button"></div>
    </div>

    <!-- Descripción -->
    <div class="skeleton-description">
      <div class="skeleton skeleton-title"></div>
      <div class="skeleton skeleton-paragraph"></div>
      <div class="skeleton skeleton-paragraph"></div>
      <div class="skeleton skeleton-paragraph"></div>
      <div class="skeleton skeleton-paragraph"></div>
    </div>

    <!-- Detalles -->
    <div class="skeleton-details">
      <div class="skeleton skeleton-title"></div>
      <div class="skeleton skeleton-line"></div>
      <div class="skeleton skeleton-line"></div>
      <div class="skeleton skeleton-line"></div>
    </div>
  </div>


  <div class="anime-details">
    <!-- Sección de cabecera -->
    <section class="anime-header">
      <div class="anime-banner">
        <img class="banner-img" src="" alt="Banner del Anime">
      </div>
      <div class="anime-info">
        <div class="anime-poster">
          <img class="poster-img" src="" alt="Poster del Anime">
        </div>
        <div class="anime-meta">
          <div class="title-container">
            <h1 class="anime-title"></h1>
            <button type="button" id="progressBtn" class="btn btn-primary" data-bs-toggle="modal"
              data-bs-target="#animeModal">

            </button>
          </div>
          <p class="anime-score"><i class="fas fa-star"></i> <span>0</span></p>
          <p class="anime-episodes"><strong>Episodis:</strong> <span>0</span></p>
          <p class="anime-status"><strong>Estat:</strong> <span>Desconegut</span></p>
          <p class="anime-year"><strong>Any:</strong> <span>Desconegut</span></p>
        </div>
      </div>
    </section>

    <!-- Modal de Bootstrap -->
    <div class="modal fade" id="animeModal" tabindex="-1" aria-labelledby="animeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="animeModalLabel">Editar Progres</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="animeProgressForm">
              <!-- Select para el estado -->
              <div class="mb-3">
                <label for="animeStatus" class="form-label">Estat</label>
                <select class="form-select" id="animeStatus">
                  <option value="1">Vist</option>
                  <option value="2">Seguint</option>
                  <option value="3">Pensant Veure</option>
                  <option value="4">Deixat</option>
                </select>
              </div>
              <!-- Input para el episodio actual -->
              <div class="mb-3">
                <label for="currentEpisode" class="form-label">Episodi Actual</label>
                <input type="number" class="form-control" id="currentEpisode" min="0" placeholder="Episodio">
              </div>
              <!-- Input para la valoración -->
              <div class="mb-3">
                <label for="animeRating" class="form-label">Valoració</label>
                <input type="number" class="form-control" id="animeRating" min="0" max="10" step="0.1"
                  placeholder="Valoració (0-10)">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tancar</button>
            <button type="button" class="btn btn-primary" id="saveProgressButton">Desar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Sección de descripción -->
    <section class="anime-description">
      <h2>Descripció</h2>
      <p class="description-text">Carregant descripció...</p>
    </section>

    <!-- Sección de detalles adicionales -->
    <section class="anime-details-extra">
      <h2>Detalls</h2>
      <ul>
        <li><strong>Géneres:</strong> <span class="anime-genres">Carregant...</span></li>
        <li><strong>Estudis:</strong> <span class="anime-studio">Carregant...</span></li>
        <li><strong>Duració:</strong> <span class="anime-duration">Carregant...</span></li>
      </ul>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app/js/animeDetails.js"></script>
</body>

</html>