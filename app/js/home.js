const API_URL = "https://api.jikan.moe/v4/anime";
let currentPage = 1;
let totalPages = 1;

document.addEventListener("DOMContentLoaded", function () {
    // Intenta recuperar los datos almacenados
    const savedData = sessionStorage.getItem("animeData");
    const savedPage = sessionStorage.getItem("animePage");
    const savedTotalPages = sessionStorage.getItem("totalPages");

    if (savedData && savedPage && savedTotalPages) {
        currentPage = parseInt(savedPage);
        totalPages = parseInt(savedTotalPages);
        renderAnimes(JSON.parse(savedData));
        renderPagination(currentPage, totalPages);
    } else {
        loadAnimes(currentPage);
    }

    const searchInput = document.getElementById("search-input");
    const searchButton = document.getElementById("search-button");

    // Evento para buscar al hacer clic en el botón
    searchButton.addEventListener("click", function () {
        const query = searchInput.value.trim();
        if (query) {
            searchAnimes(query);
        } else {
            alert("Por favor, ingresa un término de búsqueda.");
        }
    });

    // Evento para buscar al presionar Enter
    searchInput.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            const query = searchInput.value.trim();
            if (query) {
                searchAnimes(query);
            } else {
                alert("Por favor, ingresa un término de búsqueda.");
            }
        }
    });
});

// Función para mostrar el skeleton antes de cargar los animes
function showSkeletons() {
    const dashboard = document.querySelector(".animes-dashboard");
    dashboard.innerHTML = ""; // Limpia antes de agregar nuevos

    for (let i = 0; i < 25; i++) {
        const skeletonCard = document.createElement("div");
        skeletonCard.classList.add("skeleton-card");

        skeletonCard.innerHTML = `
            <div class="skeleton skeleton-img"></div>
            <div class="skeleton skeleton-title"></div>
            <div class="skeleton skeleton-score"></div>
        `;

        dashboard.appendChild(skeletonCard);
    }
}

// Función para cargar animes de la API
function loadAnimes(page) {
    const dashboard = document.querySelector(".animes-dashboard");
    dashboard.innerHTML = ""; // Limpia la lista actual
    showSkeletons(); // Muestra los skeletons

    fetch(`${API_URL}?page=${page}&limit=25`)
        .then(response => response.json())
        .then(data => {
            dashboard.innerHTML = ""; // Elimina los skeletons
            const animes = data.data;
            totalPages = data.pagination.last_visible_page;

            // Guardar en sessionStorage para reutilizar después
            sessionStorage.setItem("animeData", JSON.stringify(animes));
            sessionStorage.setItem("animePage", page);
            sessionStorage.setItem("totalPages", totalPages);

            renderAnimes(animes);
            renderPagination(page, totalPages);
        })
        .catch(error => {
            console.error("Error al cargar los animes:", error);
        });
}

// Función para renderizar los animes
function renderAnimes(animes) {
    const dashboard = document.querySelector(".animes-dashboard");
    dashboard.innerHTML = ""; // Limpiar antes de agregar nuevos

    animes.forEach(anime => {
        const animeCard = document.createElement("div");
        animeCard.classList.add("anime-card");
        animeCard.id = anime.mal_id;

        animeCard.innerHTML = `
            <img src="${anime.images.jpg.image_url}" alt="${anime.title}">
            <h3>${anime.title}</h3>
            <p>⭐ ${anime.score || "N/A"}</p>
        `;

        // Añadir listener a la tarjeta
        animeCard.addEventListener("click", function () {
            console.log("Tarjeta clickeada, ID:", anime.mal_id);

            // Redirigir a una página de detalles o realizar otra acción
            window.location.href = `${ichirakuUrl}?controller=animeDetails&id=${anime.mal_id}`;
        });

        dashboard.appendChild(animeCard);
    });
}

// Función para renderizar la paginación
function renderPagination(current, total) {
    const pagination = document.querySelector(".pagination");
    pagination.innerHTML = ""; // Limpiar la paginación actual

    // Botón "Anterior"
    if (current > 1) {
        const prevButton = document.createElement("button");
        prevButton.textContent = "«";
        prevButton.addEventListener("click", () => changePage(current - 1));
        pagination.appendChild(prevButton);
    }

    // Números de página (máximo 5 visibles)
    const startPage = Math.max(1, current - 2);
    const endPage = Math.min(total, current + 2);

    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement("button");
        pageButton.textContent = i;
        if (i === current) {
            pageButton.classList.add("active");
        }
        pageButton.addEventListener("click", () => changePage(i));
        pagination.appendChild(pageButton);
    }

    // Botón "Siguiente"
    if (current < total) {
        const nextButton = document.createElement("button");
        nextButton.textContent = "»";
        nextButton.addEventListener("click", () => changePage(current + 1));
        pagination.appendChild(nextButton);
    }
}

// Función para cambiar de página y verificar si ya está en sessionStorage
function changePage(page) {
    const savedData = sessionStorage.getItem("animeData");
    const savedPage = sessionStorage.getItem("animePage");
    const savedTotalPages = sessionStorage.getItem("totalPages");

    if (savedData && parseInt(savedPage) === page && savedTotalPages) {
        totalPages = parseInt(savedTotalPages);
        renderAnimes(JSON.parse(savedData));
        renderPagination(page, totalPages);
    } else {
        loadAnimes(page);
    }
}

// Función para buscar animes
function searchAnimes(query) {
    const dashboard = document.querySelector(".animes-dashboard");
    dashboard.innerHTML = ""; // Limpia la lista actual
    showSkeletons(); // Muestra los skeletons

    const SEARCH_API_URL = `https://api.jikan.moe/v4/anime?q=${encodeURIComponent(query)}&limit=25`;

    fetch(SEARCH_API_URL)
        .then(response => response.json())
        .then(data => {
            dashboard.innerHTML = ""; // Elimina los skeletons
            const animes = data.data;

            if (animes.length > 0) {
                renderAnimes(animes);
            } else {
                dashboard.innerHTML = "<p>No se encontraron resultados para tu búsqueda.</p>";
            }
        })
        .catch(error => {
            console.error("Error al buscar animes:", error);
            dashboard.innerHTML = "<p>Ocurrió un error al realizar la búsqueda.</p>";
        });
}