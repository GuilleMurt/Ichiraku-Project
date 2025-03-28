document.addEventListener("DOMContentLoaded", async function () {
    const userDropdown = document.getElementById("userDropdown");
    const dropdownMenu = document.getElementById("dropdownMenu");

    document.getElementById("home-link").addEventListener("click", function () {
        sessionStorage.removeItem("animeData");  // Elimina los datos guardados de animes
        sessionStorage.removeItem("animePage");  // Elimina la página actual
        sessionStorage.removeItem("totalPages"); // Elimina el total de páginas
    });  

    // Alternar la clase "show" al hacer clic en "Usuari"
    userDropdown.addEventListener("click", function (event) {
        event.preventDefault(); // Evita que el enlace recargue la página
        dropdownMenu.classList.toggle("show");
    });

    // Cerrar el menú si se hace clic fuera de él
    document.addEventListener("click", function (event) {
        if (!userDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });

    // Obtener el email del usuario desde la sesión
    let session_data = await get_session_email();
    if (session_data.user_email) {
        let user_data = await get_user_name(session_data.user_email);
        userDropdown.innerHTML = user_data.user_name;
    } else {
        console.error('Error:', session_data.error);
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