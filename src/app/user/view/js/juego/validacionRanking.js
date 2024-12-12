window.addEventListener('load', function() {
    const btnEnviar = document.getElementById("enviar");

    formularioValidado = () => {
        const nombre = document.getElementById("name").value;
        const puntuacion = document.getElementById("puntuacion").value;
        const nombreRegex = /^[a-zA-Z\s]+$/;
        if (nombre === "" || puntuacion === "" || puntuacion < 0 || !nombreRegex.test(nombre)) {
            alert("Debe rellenar el nombre o El nombre no debe contener números.");
        } else {
            const form = document.getElementById("formRanking");
            form.submit();
        }
    };

    btnEnviar.addEventListener('click', formularioValidado);
});