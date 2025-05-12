document.addEventListener("DOMContentLoaded", async function () {
  const skeletonLoader = document.getElementById("skeleton-loader");
  const animeListContainer = document.getElementById("anime-list");
  let animes = [];
  let userAnimes = [];
  let session_data;
  let user_data;
  let currentAnimeData = null;

  // Mostrar el skeleton loader
  skeletonLoader.style.display = "block";
  animeListContainer.style.display = "none";
  try {
    // Obtener los datos
    session_data = await get_session_email();
    if (session_data.user_email) {
      user_data = await get_user_name(session_data.user_email);
    } else {
      console.error("Error:", session_data.error);
    }

    animes = await get_animes();
    userAnimes = await get_user_animes_by_user_id(user_data);

    // Ocultar el skeleton loader y mostrar los datos
    skeletonLoader.style.display = "none";
    animeListContainer.style.display = "block";

  } catch (error) {
    console.error("Error al cargar los datos:", error);
    skeletonLoader.style.display = "none";
    animeListContainer.style.display = "block";
  }
  // Agrupar animes por stat_id
  const groupedAnimes = {
    2: [], // Seguint
    3: [], // Pensant Veure
    4: [], // Deixat
    1: [], // Vist
  };

  userAnimes.forEach(anime => {
    if (groupedAnimes[anime.stat_id]) {
      groupedAnimes[anime.stat_id].push(anime);
    }
  });

  const statLabels = {
    2: "Seguint",
    3: "Pensant Veure",
    4: "Deixat",
    1: "Vist",
  };

  const statOrder = [2, 3, 4, 1]; // Orden deseado: Seguint, Pensant Veure, Deixat, Vist

  // Referencia al modal y sus elementos
  const editAnimeModal = new bootstrap.Modal(document.getElementById("editAnimeModal"));
  const animeTitleInput = document.getElementById("animeTitle");
  const animeStatusSelect = document.getElementById("animeStatus");
  const animeChapterInput = document.getElementById("animeChapter");
  const animeRatingInput = document.getElementById("animeRating");
  const saveAnimeChangesButton = document.getElementById("saveAnimeChanges");

  let currentAnime = null; // Variable para almacenar el anime seleccionado

  statOrder.forEach(stat_id => {
    if (groupedAnimes[stat_id].length > 0) {
      // Crear encabezado de la sección
      const sectionHeader = document.createElement("h2");
      sectionHeader.textContent = statLabels[stat_id];
      sectionHeader.classList.add("section-header");
      animeListContainer.appendChild(sectionHeader);

      // Crear contenedor para los animes de esta sección
      const sectionContainer = document.createElement("div");
      sectionContainer.classList.add("section-container");

      groupedAnimes[stat_id].forEach(anime => {
        const animeData = animes.find(a => a.anime_id == anime.anime_id);

        // Crear contenedor principal de la tarjeta
        const animeElement = document.createElement("div");
        animeElement.classList.add("anime");
        animeElement.addEventListener("click", () => {
          // Abrir el modal y cargar los datos del anime
          currentAnimeData = animeData;
          currentAnime = anime;
          animeTitleInput.value = animeData.title;
          animeStatusSelect.value = anime.stat_id;
          animeChapterInput.value = document.getElementById(`anime-${anime.anime_id}`).textContent.split(" / ")[0];
          animeRatingInput.value = anime.rating;
          editAnimeModal.show();
        });

        // Crear elemento de imagen
        const imageElement = document.createElement("img");
        imageElement.src = animeData.image;
        imageElement.alt = animeData.title;
        animeElement.appendChild(imageElement);

        // Crear contenedor de información del anime
        const infoElement = document.createElement("div");
        infoElement.classList.add("anime-info");

        const titleElement = document.createElement("h3");
        titleElement.textContent = animeData.title;
        infoElement.appendChild(titleElement);

        const statusElement = document.createElement("p");
        statusElement.textContent = `Estat: ${animeData.status}`;
        infoElement.appendChild(statusElement);

        animeElement.appendChild(infoElement);

        // Crear contenedor de acciones (capítulo y botones)
        const actionsElement = document.createElement("div");
        actionsElement.classList.add("anime-actions");

        const decrementButton = document.createElement("button");
        decrementButton.textContent = "-1";
        decrementButton.classList.add("btn", "btn-danger");

        if (anime.chapter === 0) {
          decrementButton.style.display = "none";
        } else {
          decrementButton.style.display = "block";
        }

        decrementButton.addEventListener("click", async (event) => {
          event.stopPropagation(); // Detener la propagación del evento para que no abra el modal
          const chapterElement = document.getElementById(`anime-${anime.anime_id}`);
          const currentChapter = parseInt(chapterElement.textContent.split(" / ")[0]);

          await updateChapter(anime.anime_id, user_data.user_id, currentChapter, -1, animeData, anime);
          if (currentChapter - 1 === 0) {
            decrementButton.style.display = "none";
          } else {
            decrementButton.style.display = "block";
          }
          if (currentChapter === animeData.total_chapters + 1) {
            incrementButton.style.display = "none";
          } else {
            incrementButton.style.display = "block";
          }
        });

        actionsElement.appendChild(decrementButton);

        const chapterElement = document.createElement("p");
        chapterElement.innerHTML = `<span id="anime-${anime.anime_id}">${anime.chapter} / ${animeData.total_chapters === 0 ? "?" : animeData.total_chapters}</span>`;
        actionsElement.appendChild(chapterElement);

        const incrementButton = document.createElement("button");
        incrementButton.textContent = "+1";
        incrementButton.classList.add("btn");

        if (anime.chapter === animeData.total_chapters) {
          incrementButton.style.display = "none";
        } else {
          incrementButton.style.display = "block";
        }

        incrementButton.addEventListener("click", async (event) => {
          event.stopPropagation(); // Detener la propagación del evento para que no abra el modal
          const chapterElement = document.getElementById(`anime-${anime.anime_id}`);
          const currentChapter = parseInt(chapterElement.textContent.split(" / ")[0]);

          await updateChapter(anime.anime_id, user_data.user_id, currentChapter, 1, animeData, anime);

          if (currentChapter === animeData.total_chapters - 1) {
            incrementButton.style.display = "none";
          } else {
            incrementButton.style.display = "block";
          }
          if (currentChapter + 1 === 0) {
            decrementButton.style.display = "none";
          } else {
            decrementButton.style.display = "block";
          }
        });
        actionsElement.appendChild(incrementButton);

        animeElement.appendChild(actionsElement);

        // Añadir la tarjeta al contenedor de la sección
        sectionContainer.appendChild(animeElement);
      });

      // Añadir la sección al contenedor principal
      animeListContainer.appendChild(sectionContainer);
    }
  });

  saveAnimeChangesButton.addEventListener("click", async () => {
    if (!currentAnime) return;

    let updatedStatus = animeStatusSelect.value;
    const updatedChapter = animeChapterInput.value;
    const updatedRating = animeRatingInput.value;

    if (Number(updatedChapter) === Number(currentAnimeData.total_chapters)) {
      updatedStatus = 1;
    }

    // Validar que el rating esté entre 0 y 10
    if (updatedRating < 0 || updatedRating > 10) {
      showNotification("El rating debe estar entre 0 y 10.", "danger");
      return;
    }

    try {
      const formData = new FormData();
      formData.append("accion", "update_user_anime");
      formData.append("anime_id", currentAnime.anime_id);
      formData.append("user_id", user_data.user_id);
      formData.append("stat_id", updatedStatus);
      formData.append("chapter", updatedChapter);
      formData.append("rating", updatedRating);

      if (updatedChapter < 0) {
        showNotification("El capítol no pot ser menor a 0.", "warning");
        return;
      }

      const url = `${ichirakuUrl}?controller=ApiUserAnimes&action=api`;

      const response = await axios.post(url, formData);
      const data = response.data;

      if (data.error) {
        alert(data.error);
      } else {
        console.log("Anime actualizado:", data.data);
        location.reload();
      }
    } catch (error) {
      console.error("Error al actualizar el anime:", error);
      showNotification("Ocurrió un error al actualizar el anime.", "danger");
    }
  });

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

  async function get_user_animes_by_user_id(user_data) {
    let formData = new FormData();
    formData.append('accion', 'get_user_animes_by_user_id');
    formData.append('user_id', user_data.user_id);

    const url = `${ichirakuUrl}?controller=ApiUserAnimes&action=api`;

    try {
      const response = await axios.post(url, formData);
      return response.data;
    } catch (error) {
      console.error('Error:', error.message);
    }
  }

  async function get_animes() {
    let formData = new FormData();
    formData.append('accion', 'get_animes');

    const url = `${ichirakuUrl}?controller=ApiAnime&action=api`;

    try {
      const response = await axios.post(url, formData);
      return response.data;
    } catch (error) {
      console.error('Error:', error.message);
    }
  }

  async function updateChapter(animeId, userId, currentChapter, increment, animeData, anime) {
    // Calcular el nuevo capítulo
    const newChapter = currentChapter + increment;

    if (newChapter === animeData.total_chapters) {
      anime.stat_id = 1;
      window.location.reload();
    }

    // Enviar actualización al servidor
    const formData = new FormData();
    formData.append("accion", "update_user_anime");
    formData.append("anime_id", animeId);
    formData.append("user_id", userId);
    formData.append("chapter", newChapter);
    formData.append("stat_id", anime.stat_id);
    formData.append("rating", anime.rating);

    const url = `${ichirakuUrl}?controller=ApiUserAnimes&action=api`;

    try {
      const response = await axios.post(url, formData);
      const data = response.data;

      console.log("Respuesta del servidor:", data);

      if (data.error) {
        alert(data.error);
      } else {
        console.log(data.message);
        console.log("Datos actualizados:", data.data);

        // Actualizar el capítulo en la interfaz con el valor devuelto por el servidor
        const chapterElement = document.getElementById(`anime-${animeId}`);
        chapterElement.textContent = `${data.data.chapter} / ${animeData.total_chapters === 0 ? "?" : animeData.total_chapters}`;
      }
    } catch (error) {
      console.error("Error al actualizar el capítulo:", error);
      showNotification("Ocurrió un error al actualizar el capítulo.", "danger");
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