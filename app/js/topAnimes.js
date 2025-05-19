document.addEventListener("DOMContentLoaded", async () => {
  const podium = document.getElementById("top-podium-container");
  const container = document.getElementById("top-animes-container");

  function showSkeletons() {
    const podium = document.getElementById("top-podium-container");
    const container = document.getElementById("top-animes-container");
  
    podium.innerHTML = "";
    container.innerHTML = "";
  
    // Top 3 skeletons
    for (let i = 0; i < 3; i++) {
      const col = document.createElement("div");
      col.className = "col-4 podium-col";
      col.innerHTML = `
        <div class="skeleton-card">
          <div class="skeleton-img"></div>
          <div class="skeleton-line" style="width: 80%;"></div>
          <div class="skeleton-line" style="width: 60%;"></div>
          <div class="skeleton-line" style="width: 40%;"></div>
        </div>
      `;
      podium.appendChild(col);
    }
  
    // Grid skeletons (12 tarjetas)
    for (let i = 0; i < 12; i++) {
      const col = document.createElement("div");
      col.className = "col-sm-6 col-md-4 col-lg-3 mb-4";
      col.innerHTML = `
        <div class="skeleton-card">
          <div class="skeleton-img"></div>
          <div class="skeleton-line" style="width: 80%;"></div>
          <div class="skeleton-line" style="width: 60%;"></div>
          <div class="skeleton-line" style="width: 40%;"></div>
        </div>
      `;
      container.appendChild(col);
    }
  }

  showSkeletons(); // Muestra los skeletons  

  try {
    const res = await fetch("http://topanimes.animeencatala.cat/api/index.php?api_key=123456789");
    const data = await res.json();

    // Limpiar skeletons antes de mostrar contenido real
    podium.innerHTML = "";
    container.innerHTML = "";


    const podiumOrder = [1, 0, 2]; // #2, #1, #3

    // Mostrar top 3 en orden personalizado
    podiumOrder.forEach((i, pos) => {
      const anime = data[i];
      const rank = i + 1;

      const card = document.createElement("div");
      card.className = `col-4 podium-col podium-${rank}`;
      card.id = anime.id;

      card.innerHTML = `
        <div class="card anime-card ${getPodiumClass(rank)}">
          <div class="rank-badge">#${rank}</div>
          <img src="${anime.image}" class="card-img-top" alt="${anime.title}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">${anime.title}</h5>
            <p class="card-text mt-auto">Estat: ${anime.status || "N/A"}</p>
            <p class="card-text mt-auto">Generes: ${anime.genres || "N/A"}</p>
            <p class="card-text mt-auto">Episodis: ${anime.episodes || "N/A"}</p>
            <p class="card-text mt-auto">⭐ ${anime.score || "N/A"}</p>
          </div>
        </div>
      `;

      card.addEventListener("click", function () {
        // Redirigir a una página de detalles o realizar otra acción
        window.location.href = `${ichirakuUrl}?controller=animeDetails&id=${anime.id}`;
      });

      podium.appendChild(card);
    });

    // Mostrar el resto (del 4 en adelante)
    data.slice(3).forEach((anime, index) => {
      const rank = index + 4;
      const card = document.createElement("div");
      card.className = "col-sm-6 col-md-4 col-lg-3 mb-4";
      card.id = anime.id;

      card.innerHTML = `
        <div class="card h-100 shadow-sm anime-card">
          <div class="rank-badge">#${rank}</div>
          <img src="${anime.image}" class="card-img-top" alt="${anime.title}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">${anime.title}</h5>
            <p class="card-text mt-auto">Estat: ${anime.status || "N/A"}</p>
            <p class="card-text mt-auto">Generes: ${anime.genres || "N/A"}</p>
            <p class="card-text mt-auto">Episodis: ${anime.episodes || "N/A"}</p>
            <p class="card-text mt-auto">⭐ ${anime.score || "N/A"}</p>
          </div>
        </div>
      `;

      card.addEventListener("click", function () {
        // Redirigir a una página de detalles o realizar otra acción
        window.location.href = `${ichirakuUrl}?controller=animeDetails&id=${anime.id}`;
      });

      container.appendChild(card);
    });
  } catch (error) {
    container.innerHTML = "<p class='text-danger text-center'>No se pudo cargar el ranking de animes.</p>";
    console.error("Error al obtener datos del API:", error);
  }

  function getPodiumClass(rank) {
    if (rank === 1) return "podium-gold";
    if (rank === 2) return "podium-silver";
    if (rank === 3) return "podium-bronze";
    return "";
  }
});
