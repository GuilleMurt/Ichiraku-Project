document.addEventListener("DOMContentLoaded", async function () {
  const editProfileForm = document.querySelector("form");
  const editProfileSkeleton = document.querySelector(".edit-profile-skeleton");
  const editProfilePage = document.querySelector(".edit-profile-page");

  // Mostrar el skeleton al cargar la página
  editProfileSkeleton.style.display = "block";
  editProfilePage.style.display = "none";

  // Obtener el email del usuario desde la sesión
  let session_data = await get_session_email();
  if (session_data.user_email) {
    let user_data = await get_user_name(session_data.user_email);

    // Rellenar los campos del formulario de edición con los datos del usuario
    document.querySelector("#name").value = user_data.user_name;
    document.querySelector("#email").value = user_data.user_email;
    document.querySelector("#bio").value = user_data.user_bio;
    document.querySelector(".user-img").src = user_data.user_img;

    // Mostrar el perfil
    editProfileSkeleton.style.display = "none";
    editProfilePage.style.display = "block";
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
  // TODO: Separar las llamadas a la API del código de la página para que esté mejor estructurado, y llamarlas cuando sea necesario
  // Agregar un listener para el envío del formulario de edición
  editProfileForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    let userName = document.querySelector("#name").value;
    let userEmail = document.querySelector("#email").value;
    let userBio = document.querySelector("#bio").value;
    let userImg = document.querySelector(".user-img").src;

    // Si el usuario sube una nueva foto
    let profileImgFile = document.querySelector("#profile-img").files[0];
    if (profileImgFile) {
      const formData = new FormData();
      formData.append("accion", "update_user");
      formData.append("user_email", userEmail);
      formData.append("user_name", userName);
      formData.append("user_bio", userBio);

      const url = `${ichirakuUrl}?controller=ApiUser&action=api`;

      try {
        const response = await axios.post(url, formData);
        if (response.data.success) {
          alert("Perfil actualizado correctamente");
        } else {
          alert("Hubo un error al actualizar el perfil");
        }
      } catch (error) {
        console.error("Error:", error.message);
      }
    } else {
      // Si no hay imagen nueva, se envían los datos sin cambiar la imagen
      let formData = new FormData();
      formData.append("accion", "update_user");
      formData.append("user_email", userEmail);
      formData.append("user_name", userName);
      formData.append("user_bio", userBio);

      const url = `${ichirakuUrl}?controller=ApiUser&action=api`;

      try {
        const response = await axios.post(url, formData);
        if (response.data.success) {
          alert("Perfil actualizado correctamente");
        } else {
          alert("Hubo un error al actualizar el perfil");
        }
      } catch (error) {
        console.error("Error:", error.message);
      }
    }
  });
});
