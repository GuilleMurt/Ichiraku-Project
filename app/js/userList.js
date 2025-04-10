document.addEventListener("DOMContentLoaded", async function () {
  // Obtener el email del usuario desde la sesión
  let session_data = await get_session_email();
  let user_data;
  if (session_data.user_email) {
    user_data = await get_user_name(session_data.user_email);
  } else {
    console.error('Error:', session_data.error);
  }

  const animes = await get_animes();
  console.log(animes);
  const userAnimes = await get_user_animes_by_user_id(user_data);
  console.log(userAnimes);

  userAnimes.forEach(anime => {
    const animeData = animes.find(a => a.anime_id == anime.anime_id);

    // Crear contenedor principal de la tarjeta
    const animeElement = document.createElement("div");
    animeElement.classList.add("anime");

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
    statusElement.textContent = `Estado: ${anime.status}`;
    infoElement.appendChild(statusElement);

    animeElement.appendChild(infoElement);

    // Crear contenedor de acciones (capítulo y botones)
    const actionsElement = document.createElement("div");
    actionsElement.classList.add("anime-actions");

    const decrementButton = document.createElement("button");
    decrementButton.textContent = "-1";
    decrementButton.classList.add("btn", "btn-danger");

    if (anime.chapter <= 0) {
      decrementButton.style.display = "none";
    } else {
      decrementButton.style.display = "block";
    }

    decrementButton.addEventListener("click", async () => {
      const chapterElement = document.getElementById(`anime-${anime.anime_id}`);
      const currentChapter = parseInt(chapterElement.textContent.split(" / ")[0]);
  
      await updateChapter(anime.anime_id, user_data.user_id, currentChapter, -1, animeData);
  });
    actionsElement.appendChild(decrementButton);

    const chapterElement = document.createElement("p");
    chapterElement.innerHTML = `<span id="anime-${anime.anime_id}">${anime.chapter} / ${animeData.total_chapters === 0 ? "?" : animeData.total_chapters}</span>`;
    actionsElement.appendChild(chapterElement);

    const incrementButton = document.createElement("button");
    incrementButton.textContent = "+1";
    incrementButton.classList.add("btn");
    incrementButton.addEventListener("click", async () => {
      const chapterElement = document.getElementById(`anime-${anime.anime_id}`);
      const currentChapter = parseInt(chapterElement.textContent.split(" / ")[0]);
  
      await updateChapter(anime.anime_id, user_data.user_id, currentChapter, 1, animeData);
  });
    actionsElement.appendChild(incrementButton);

    animeElement.appendChild(actionsElement);

    // Añadir la tarjeta al contenedor principal
    document.getElementById("anime-list").appendChild(animeElement);
  });

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

  async function get_chapters(animeId, user_id) {
    let formData = new FormData();
    formData.append('accion', 'get_chapters');
    formData.append('anime_id', animeId);
    formData.append('user_id', user_id);

    const url = `${ichirakuUrl}?controller=ApiUserAnimes&action=api`;

    try {
      const response = await axios.post(url, formData);
      return response.data;
    } catch (error) {
      console.error('Error:', error.message);
    }
  }

  async function updateChapter(animeId, userId, currentChapter, increment, animeData) {
    // Calcular el nuevo capítulo
    const newChapter = currentChapter + increment;
    if (newChapter < 0) {
      alert("El capítulo no puede ser menor a 0.");
      return;
    }

    // Enviar actualización al servidor
    const formData = new FormData();
    formData.append("accion", "update_user_anime");
    formData.append("anime_id", animeId);
    formData.append("user_id", userId);
    formData.append("chapter", newChapter);

    const url = `${ichirakuUrl}?controller=ApiUserAnimes&action=api`;

    try {
      const response = await axios.post(url, formData);
      const data = response.data;

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
      alert("Ocurrió un error al actualizar el capítulo.");
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