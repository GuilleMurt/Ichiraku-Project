window.onload = () => {
    const defaultImage = "./imatges/senseImatge.webp";
    const imatge = document.getElementById("imatgeVP");
    const inputimatge = document.getElementById("imatge");
    inputimatge.addEventListener("input", () => {
        if (inputimatge.value.trim() === "") {
            imatge.src = defaultImage;
        } else {
            imatge.src = inputimatge.value;

            imatge.onerror = () => {
                imatge.src = defaultImage;
            };
        }
    })
}