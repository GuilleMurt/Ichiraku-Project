document.addEventListener("DOMContentLoaded", async function () {
  const profileSkeleton = document.querySelector(".profile-skeleton");
  const profilePage = document.querySelector(".profile-page");

  // Mostrar el skeleton al cargar la página
  profileSkeleton.style.display = "block";
  profilePage.style.display = "none";

  // Obtener el email del usuario desde la sesión
  let session_data = await get_session_email();
  if (session_data.user_email) {
    let user_data = await get_user_name(session_data.user_email);

    // Actualizar los datos del perfil
    document.querySelector(".user-name").innerHTML = user_data.user_name;
    document.querySelector(".user-email").innerHTML = user_data.user_email;
    document.querySelector(".user-img").src = user_data.user_img;

    // Ocultar el skeleton y mostrar el perfil
    profileSkeleton.style.display = "none";
    profilePage.style.display = "block";
  } else {
    console.error("Error:", session_data.error);
  }

  async function get_session_email() {
    let formData = new FormData();
    formData.append("accion", "get_session_email");

    const url = `${ichirakuUrl}?controller=ApiUser&action=api`;

    try {
      const response = await axios.post(url, formData);
      return response.data;
    } catch (error) {
      console.error("Error:", error.message);
    }
  }

  async function get_user_name(user_email) {
    let formData = new FormData();
    formData.append("accion", "get_user_name");
    formData.append("user_email", user_email);

    const url = `${ichirakuUrl}?controller=ApiUser&action=api`;

    try {
      const response = await axios.post(url, formData);
      return response.data;
    } catch (error) {
      console.error("Error:", error.message);
    }
  }
});