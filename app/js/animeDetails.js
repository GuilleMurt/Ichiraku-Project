document.addEventListener("DOMContentLoaded", async function () {
    const successMessage = localStorage.getItem("animeSuccessMessage");
    if (successMessage) {
        showNotification(successMessage, "success");
        localStorage.removeItem("animeSuccessMessage");
    }

    const params = new URLSearchParams(window.location.search);
    const animeId = params.get("id");

    if (!animeId) {
        showNotification("No se encontró el ID del anime.", "warning");
        return;
    }

    const API_URL = `https://api.jikan.moe/v4/anime/${animeId}`;
    const saveButton = document.getElementById("saveProgressButton");
    const skeletonLoader = document.getElementById("skeleton-loader");
    const animeDetailsContainer = document.querySelector(".anime-details");

    // Mostrar el skeleton loader y ocultar el contenido real
    skeletonLoader.style.display = "block";
    animeDetailsContainer.style.display = "none";

    try {
        const response = await axios.get(API_URL);
        const anime = response.data.data;

        // Actualizar la cabecera
        document.querySelector(".banner-img").src = anime.images.jpg.large_image_url;
        document.querySelector(".poster-img").src = anime.images.jpg.image_url;
        document.querySelector(".anime-title").textContent = anime.title;
        document.querySelector(".anime-score span").textContent = anime.score || "N/A";
        document.querySelector(".anime-episodes span").textContent = anime.episodes || "Desconegut";
        document.querySelector(".anime-status span").textContent = anime.status || "Desconegut";
        document.querySelector(".anime-year span").textContent = anime.aired?.prop?.from?.year || "Desconegut";

        // Actualizar la descripción
        document.querySelector(".description-text").textContent = anime.synopsis || "No hay descripción disponible.";

        // Actualizar los detalles adicionales
        document.querySelector(".anime-genres").textContent = anime.genres.map(genre => genre.name).join(", ") || "Desconegut";
        document.querySelector(".anime-studio").textContent = anime.studios.map(studio => studio.name).join(", ") || "Desconegut";
        document.querySelector(".anime-duration").textContent = anime.duration || "Desconegut";

        // Obtener el email del usuario desde la sesión
        let session_data = await get_session_email();
        let user_data;
        if (session_data.user_email) {
            user_data = await get_user_name(session_data.user_email);
        } else {
            console.error('Error:', session_data.error);
        }

        // Verificar si el anime ya está en la lista del usuario
        const userAnimes = await get_user_animes_by_user_id(user_data.user_id);
        const isAnimeInList = userAnimes.some(userAnime => userAnime.anime_id == animeId);
        let progressBtn = document.getElementById("progressBtn");

        // Cambiar el texto del botón según el estado
        if (isAnimeInList) {
            progressBtn.textContent = "Editar Progreso";
            progressBtn.classList.remove("btn-success");
            progressBtn.classList.add("btn-primary");
            document.getElementById("animeStatus").value = userAnimes.find(userAnime => userAnime.anime_id == animeId).stat_id;
            document.getElementById("currentEpisode").value = userAnimes.find(userAnime => userAnime.anime_id == animeId).chapter;
            document.getElementById("animeRating").value = userAnimes.find(userAnime => userAnime.anime_id == animeId).rating;
        } else {
            progressBtn.textContent = "Añadir a Mi Lista";
            progressBtn.classList.remove("btn-primary");
            progressBtn.classList.add("btn-success");
        }

        // Ocultar el skeleton loader y mostrar el contenido real
        skeletonLoader.style.display = "none";
        animeDetailsContainer.style.display = "block";

        // Manejar el botón de guardar progreso
        saveButton.addEventListener("click", async function () {
            const status = document.getElementById("animeStatus").value;
            const currentEpisode = document.getElementById("currentEpisode").value;
            const rating = document.getElementById("animeRating").value;

            // Validar que el rating esté entre 0 y 10
            if (rating < 0 || rating > 10) {
                showNotification("El rating debe estar entre 0 y 10.", "danger");
                return;
            }

            const animeId = anime.mal_id;
            const animeTitle = anime.title;
            const animeImage = anime.images.jpg.image_url;
            const animeTotalChapters = anime.episodes;
            const animeStatus = anime.status;

            // Aquí puedes enviar los datos al servidor o guardarlos localmente
            await insert_anime(animeId, animeTitle, animeImage, animeTotalChapters, animeStatus);

            // Cerrar el modal
            const modal = bootstrap.Modal.getInstance(document.getElementById("animeModal"));
            modal.hide();

            // Guardar el progreso del anime del usuario
            await insert_user_anime(animeId, user_data.user_id, status, currentEpisode, rating);
        });
    } catch (error) {
        console.error("Error al cargar los detalles del anime:", error);
        showNotification("Ocurrió un error al cargar los detalles del anime.", "danger");

        // Ocultar el skeleton si ocurre un error
        skeletonLoader.style.display = "none";
    }

    function showNotification(message, type = "success") {
        const notificationContainer = document.getElementById("notification-container");

        // Crear el elemento de la notificación
        const notification = document.createElement("div");
        notification.className = `alert alert-${type} alert-dismissible fade show`;
        notification.role = "alert";
        notification.innerHTML = `
          ${message}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        // Agregar la notificación al contenedor
        notificationContainer.appendChild(notification);

        // Eliminar la notificación automáticamente después de 5 segundos
        setTimeout(() => {
            notification.classList.remove("show");
            notification.classList.add("hide");
            setTimeout(() => notification.remove(), 500); // Esperar a que termine la animación
        }, 5000);
    }

    async function get_user_animes_by_user_id(user_id) {
        let formData = new FormData();
        formData.append("accion", "get_user_animes_by_user_id");
        formData.append("user_id", user_id);

        const url = `${ichirakuUrl}?controller=ApiUserAnimes&action=api`;

        try {
            const response = await axios.post(url, formData);
            return response.data;
        } catch (error) {
            console.error("Error al obtener los animes del usuario:", error.message);
            return [];
        }
    }

    async function insert_anime(anime_id, title, image, total_chapters, status) {
        let formData = new FormData();
        formData.append("accion", "insert_anime");
        formData.append("anime_id", anime_id);
        formData.append("title", title);
        formData.append("image", image);
        formData.append("total_chapters", total_chapters);
        formData.append("status", status);

        const url = `${ichirakuUrl}?controller=ApiAnime&action=api`;

        try {
            const response = await axios.post(url, formData);
            const data = response.data;

            if (data.error) {
                console.error("Error al registrar el anime:", data.error);
                showNotification(data.error, "danger");
            } else {
                console.log("Anime registrado correctamente:", data.message);
            }
        } catch (error) {
            console.error("Error al enviar la solicitud:", error.message);
            showNotification("Ocurrió un error al registrar el anime.", "danger");
        }
    }

    async function insert_user_anime(anime_id, user_id, status, current_chapter, rating) {
        let formData = new FormData();
        formData.append("accion", "insert_user_anime");
        formData.append("anime_id", anime_id);
        formData.append("user_id", user_id);
        formData.append("status", status);
        formData.append("current_chapter", current_chapter);
        formData.append("rating", rating);

        if (current_chapter < 0) {
            showNotification("El capítulo no puede ser menor a 0.", "warning");
            return;
        }

        const url = `${ichirakuUrl}?controller=ApiUserAnimes&action=api`;

        try {
            const response = await axios.post(url, formData);
            const data = response.data;

            if (data.error) {
                console.error("Error al registrar el progreso del anime:", data.error);
                showNotification(data.error, "danger");
            } else {
                console.log("Progreso del anime registrado correctamente:", data.message);
                localStorage.setItem("animeSuccessMessage", data.message); // guardar mensaje
                window.location.reload();
            }
        } catch (error) {
            console.error("Error al enviar la solicitud:", error.message);
            showNotification("Ocurrió un error al registrar el progreso del anime.", "danger");
        }
    }

    async function get_session_email() {
        let formData = new FormData();
        formData.append('accion', 'get_session_email');

        const url = `${ichirakuUrl}?controller=ApiUser&action=api`;

        try {
            const response = await axios.post(url, formData);
            return response.data;
        } catch (error) {
            console.error('Error:', error.message);
        }
    }

    async function get_user_name(user_email) {
        let formData = new FormData();
        formData.append('accion', 'get_user_name');
        formData.append('user_email', user_email);

        const url = `${ichirakuUrl}?controller=ApiUser&action=api`;

        try {
            const response = await axios.post(url, formData);

            return response.data;
        } catch (error) {
            console.error('Error:', error.message);
        }
    }
});