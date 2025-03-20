document.addEventListener("DOMContentLoaded", function () {
    const userDropdown = document.getElementById("userDropdown");
    const dropdownMenu = document.getElementById("dropdownMenu");

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
});