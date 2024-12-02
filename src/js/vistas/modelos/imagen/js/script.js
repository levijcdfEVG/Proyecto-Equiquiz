document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("imageForm");
    const fileInput = document.getElementById("image");
    const errorElement = document.getElementById("error");

    const validExtensions = ["png", "jpg", "jpeg"];

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const file = fileInput.files[0];

        // Validación
        if (!file) {
            showError("Debes seleccionar un archivo.");
            return;
        }

        const extension = file.name.split(".").pop().toLowerCase();
        if (!validExtensions.includes(extension)) {
            showError("El archivo debe ser una imagen (.png, .jpg, .jpeg).");
            return;
        }

        // Si todo está bien
        hideError();
        alert("Imagen subida correctamente.");
    });

    function showError(message) {
        errorElement.textContent = message;
        errorElement.style.display = "block";
    }

    function hideError() {
        errorElement.style.display = "none";
    }
});
