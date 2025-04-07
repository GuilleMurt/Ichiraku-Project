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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#animeModal">
              Editar Progreso
            </button>
          </div>
          <p class="anime-score"><i class="fas fa-star"></i> <span>0</span></p>
          <p class="anime-episodes"><strong>Episodios:</strong> <span>0</span></p>
          <p class="anime-status"><strong>Estado:</strong> <span>Desconocido</span></p>
          <p class="anime-year"><strong>Año:</strong> <span>Desconocido</span></p>
        </div>
      </div>
    </section>

    <!-- Modal de Bootstrap -->
    <div class="modal fade" id="animeModal" tabindex="-1" aria-labelledby="animeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="animeModalLabel">Editar Progreso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="animeProgressForm">
              <!-- Select para el estado -->
              <div class="mb-3">
                <label for="animeStatus" class="form-label">Estado</label>
                <select class="form-select" id="animeStatus">
                  <option value="watching">Viendo</option>
                  <option value="completed">Completado</option>
                  <option value="on_hold">En Pausa</option>
                  <option value="dropped">Abandonado</option>
                  <option value="plan_to_watch">Plan para Ver</option>
                </select>
              </div>
              <!-- Input para el episodio actual -->
              <div class="mb-3">
                <label for="currentEpisode" class="form-label">Episodio Actual</label>
                <input type="number" class="form-control" id="currentEpisode" min="0" placeholder="Episodio">
              </div>
              <!-- Input para la valoración -->
              <div class="mb-3">
                <label for="animeRating" class="form-label">Valoración</label>
                <input type="number" class="form-control" id="animeRating" min="0" max="10" step="0.1"
                  placeholder="Valoración (0-10)">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="saveProgressButton">Guardar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Sección de descripción -->
    <section class="anime-description">
      <h2>Descripción</h2>
      <p class="description-text">Cargando descripción...</p>
    </section>

    <!-- Sección de detalles adicionales -->
    <section class="anime-details-extra">
      <h2>Detalles</h2>
      <ul>
        <li><strong>Géneros:</strong> <span class="anime-genres">Cargando...</span></li>
        <li><strong>Estudio:</strong> <span class="anime-studio">Cargando...</span></li>
        <li><strong>Duración:</strong> <span class="anime-duration">Cargando...</span></li>
      </ul>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app/js/animeDetails.js"></script>
</body>

</html>