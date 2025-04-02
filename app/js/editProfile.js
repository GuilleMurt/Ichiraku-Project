document.addEventListener("DOMContentLoaded", async function () {
  const editProfileForm = document.querySelector("form");
  const editProfileSkeleton = document.querySelector(".edit-profile-skeleton");
  const editProfilePage = document.querySelector(".edit-profile-page");

  // Mostrar el skeleton al cargar la página
  editProfileSkeleton.style.display = "block";
  editProfilePage.style.display = "none";

  // Obtener el email del usuario desde la sesión
  let session_data = await get_session_email();
  let user_data = await get_user_name(session_data.user_email);
  if (user_data) {
    // Rellenar los campos del formulario de edición con los datos del usuario
    document.querySelector("#name").value = user_data.user_name;
    document.querySelector("#email").value = user_data.user_email;
    document.querySelector(".user-img").src = user_data.user_img;

    // Mostrar el perfil
    editProfileSkeleton.style.display = "none";
    editProfilePage.style.display = "block";
  } else {
    console.error("Error:", session_data.error);
  }

  document.querySelector("#profile-img").addEventListener("change", function () {
    let file = document.querySelector("#profile-img").files[0];
    if (file) {
        // Validar tipo de archivo
        const allowedTypes = ["image/jpeg", "image/png", "image/gif"];
        if (!allowedTypes.includes(file.type)) {
            alert("Tipo de archivo no permitido. Solo se permiten imágenes JPEG, PNG y GIF.");
            return;
        }

        // Validar tamaño del archivo (máximo 2 MB)
        const maxSize = 2 * 1024 * 1024; // 2 MB
        if (file.size > maxSize) {
            alert("El archivo es demasiado grande. El tamaño máximo permitido es de 2 MB.");
            return;
        }

        // Mostrar vista previa de la imagen
        let reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector(".user-img").src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
  });

  editProfileForm.addEventListener("submit", async function (e) {
    e.preventDefault();
    let userId = user_data.user_id;
    let userName = document.querySelector("#name").value;
    let userEmail = document.querySelector("#email").value;
    let userImg = document.querySelector(".user-img").src;


    // Si el usuario sube una nueva foto
    let profileImgFile = document.querySelector("#profile-img").files[0];
    if (profileImgFile) {
      await update_user(userId, userName, userEmail, userImg, profileImgFile);
    } else {
      await update_user(userId, userName, userEmail, userImg, null);
    }
  });


  // -----------------------------------------------------------------------------
  // Lamadas a las funciones de la API
  // -----------------------------------------------------------------------------
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

  async function update_user(user_id, user_name, user_email, user_img, new_img) {
    let formData = new FormData();
    formData.append("accion", "update_user");
    formData.append("user_id", user_id);
    formData.append("user_name", user_name);
    formData.append("user_email", user_email);
    formData.append("user_img", user_img);
    formData.append("new_img", new_img);

    const url = `${ichirakuUrl}?controller=ApiUser&action=api`;

    try {
      const response = await axios.post(url, formData);
      const data = response.data;
      alert(response.data.message);

      if (data.redirect) {
        // Redirigir al usuario a la vista de perfil
        window.location.href = data.redirect;
      } else if (data.error) {
          alert(data.error); // Mostrar el error si ocurre
      } else {
          alert(data.message); // Mostrar mensaje de éxito
      }
      return data;

    } catch (error) {
      console.error("Error:", error.message);
    }
  }

});
