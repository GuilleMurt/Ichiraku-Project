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
        saveButton.addEventListener("click", function () {
            const status = document.getElementById("animeStatus").value;
            const currentEpisode = document.getElementById("currentEpisode").value;
            const rating = document.getElementById("animeRating").value;

            console.log("Progreso guardado:");
            console.log("Estado:", status);
            console.log("Episodio actual:", currentEpisode);
            console.log("Valoración:", rating);

            // Aquí puedes enviar los datos al servidor o guardarlos localmente
            alert("Progreso guardado correctamente.");
        });
    } catch (error) {
        console.error("Error al cargar los detalles del anime:", error);
        alert("Ocurrió un error al cargar los detalles del anime.");
    }
});