const API_URL = "https://api.jikan.moe/v4/anime";
let currentPage = 1;
let totalPages = 1;

$(document).ready(function () {
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
});

// Función para mostrar el skeleton antes de cargar los animes
function showSkeletons() {
    $(".animes-dashboard").empty(); // Limpia antes de agregar nuevos
    for (let i = 0; i < 25; i++) {
        $(".animes-dashboard").append(`
            <div class="skeleton-card">
                <div class="skeleton skeleton-img"></div>
                <div class="skeleton skeleton-title"></div>
                <div class="skeleton skeleton-score"></div>
            </div>
        `);
    }
}

// Función para cargar animes de la API
function loadAnimes(page) {
    $(".animes-dashboard").empty(); // Limpia la lista actual
    showSkeletons(); // Muestra los skeletons

    axios.get(`${API_URL}?page=${page}&limit=25`)
        .then(response => {
            $(".animes-dashboard").empty(); // Elimina los skeletons
            const animes = response.data.data;
            totalPages = response.data.pagination.last_visible_page;

            // Guardar en sessionStorage para reutilizar después
            sessionStorage.setItem("animeData", JSON.stringify(animes));
            sessionStorage.setItem("animePage", page);
            sessionStorage.setItem("totalPages", totalPages); // 🔹 Guardar total de páginas

            renderAnimes(animes);
            renderPagination(page, totalPages);
        })
        .catch(error => {
            console.error("Error al cargar los animes:", error);
        });
}

// Función para renderizar los animes
function renderAnimes(animes) {
    $(".animes-dashboard").empty(); // Limpiar antes de agregar nuevos

    animes.forEach(anime => {
        $(".animes-dashboard").append(`
            <div class="anime-card">
                <img src="${anime.images.jpg.image_url}" alt="${anime.title}">
                <h3>${anime.title}</h3>
                <p>⭐ ${anime.score || "N/A"}</p>
            </div>
        `);
    });
}

// Función para renderizar la paginación
function renderPagination(current, total) {
    let paginationHtml = "";

    // Botón "Anterior"
    if (current > 1) {
        paginationHtml += `<button onclick="changePage(${current - 1})">«</button>`;
    }

    // Números de página (máximo 5 visibles)
    let startPage = Math.max(1, current - 2);
    let endPage = Math.min(total, current + 2);

    for (let i = startPage; i <= endPage; i++) {
        paginationHtml += `<button onclick="changePage(${i})" class="${i === current ? "active" : ""}">${i}</button>`;
    }

    // Botón "Siguiente"
    if (current < total) {
        paginationHtml += `<button onclick="changePage(${current + 1})">»</button>`;
    }

    $(".pagination").html(paginationHtml);
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
