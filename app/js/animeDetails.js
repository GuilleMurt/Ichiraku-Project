document.addEventListener("DOMContentLoaded", async function () {
    const params = new URLSearchParams(window.location.search);
    const animeId = params.get("id");

    if (!animeId) {
        alert("No se encontró el ID del anime.");
        return;
    }

    const API_URL = `https://api.jikan.moe/v4/anime/${animeId}`;

    try {
        const response = await axios.get(API_URL);
        const anime = response.data.data;

        // Actualizar la cabecera
        document.querySelector(".banner-img").src = anime.images.jpg.large_image_url;
        document.querySelector(".poster-img").src = anime.images.jpg.image_url;
        document.querySelector(".anime-title").textContent = anime.title;
        document.querySelector(".anime-score span").textContent = anime.score || "N/A";
        document.querySelector(".anime-episodes span").textContent = anime.episodes || "Desconocido";
        document.querySelector(".anime-status span").textContent = anime.status || "Desconocido";
        document.querySelector(".anime-year span").textContent = anime.aired?.prop?.from?.year || "Desconocido";

        // Actualizar la descripción
        document.querySelector(".description-text").textContent = anime.synopsis || "No hay descripción disponible.";

        // Actualizar los detalles adicionales
        document.querySelector(".anime-genres").textContent = anime.genres.map(genre => genre.name).join(", ") || "Desconocido";
        document.querySelector(".anime-studio").textContent = anime.studios.map(studio => studio.name).join(", ") || "Desconocido";
        document.querySelector(".anime-duration").textContent = anime.duration || "Desconocido";

        // Manejar el botón de guardar progreso
        const saveButton = document.getElementById("saveProgressButton");
        saveButton.addEventListener("click", async function () {
            const status = document.getElementById("animeStatus").value;
            const currentEpisode = document.getElementById("currentEpisode").value;
            const rating = document.getElementById("animeRating").value;

            console.log("Progreso guardado:");
            console.log("Estado:", status);
            console.log("Episodio actual:", currentEpisode);
            console.log("Valoración:", rating);

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

            // Obtener el email del usuario desde la sesión
            let session_data = await get_session_email();
            let user_data;
            if (session_data.user_email) {
                user_data = await get_user_name(session_data.user_email);
            } else {
                console.error('Error:', session_data.error);
            }

            // Guardar el progreso del anime del usuario
            await insert_user_anime(animeId, user_data.user_id, status, currentEpisode, rating);
        });
    } catch (error) {
        console.error("Error al cargar los detalles del anime:", error);
        alert("Ocurrió un error al cargar los detalles del anime.");
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
                alert(data.error);
            } else {
                console.log("Anime registrado correctamente:", data.message);
            }
        } catch (error) {
            console.error("Error al enviar la solicitud:", error.message);
            alert("Ocurrió un error al registrar el anime.");
        }
    }

    async function insert_user_anime(anime_id, user_id, status, current_chapter, rating) {
        let formData = new FormData();
        formData.append("accion", "insert_user_anime");
        formData.append("user_id", user_id);
        formData.append("anime_id", anime_id);
        formData.append("status", status);
        formData.append("current_chapter", current_chapter);
        formData.append("rating", rating);

        const url = `${ichirakuUrl}?controller=ApiUserAnimes&action=api`;

        try {
            const response = await axios.post(url, formData);
            const data = response.data;

            if (data.error) {
                console.error("Error al registrar el progreso del anime:", data.error);
                alert(data.error);
            } else {
                console.log("Progreso del anime registrado correctamente:", data.message);
            }
        } catch (error) {
            console.error("Error al enviar la solicitud:", error.message);
            alert("Ocurrió un error al registrar el progreso del anime.");
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