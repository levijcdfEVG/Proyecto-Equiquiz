// Levi Josué Candeias de Figueiredo
'use strict';

document.addEventListener('DOMContentLoaded', () => {
    // Referencias a los elementos del DOM
    const botonSubir = document.getElementById('submitButton');
    const respuestas = document.querySelectorAll('input[name="respuestas[]"]');
    const pregunta = document.getElementById('pregunta');
    const botonVolver = document.getElementById('volver');

    /**
     * Valida la longitud de la pregunta.
     * Deshabilita el botón de envío si la pregunta es vacía o excede los 350 caracteres.
     */
    const validarPregunta = () => {
        const longitud = pregunta.value.length;

        if (longitud === 0) {
            alert("La pregunta no puede estar vacía");
            botonSubir.setAttribute('disabled', 'true');
        } else if (longitud > 350) {
            alert("La longitud de la pregunta supera el límite establecido (350 caracteres)");
            botonSubir.setAttribute('disabled', 'true');
        } else {
            console.log("Longitud OK");
            botonSubir.removeAttribute('disabled'); // Habilita el botón de enviar
        }
    };

    /**
     * Valida la longitud de la respuesta actual.
     * Deshabilita los botones si la respuesta es vacía o excede los 300 caracteres.
     */
    const validarRespuesta = (respuesta) => {
        const longitud = respuesta.value.length;

        if (longitud === 0) {
            alert("La respuesta no puede estar vacía");
            botonSubir.setAttribute('disabled', 'true');
        } else if (longitud > 300) {
            alert("La longitud de la respuesta supera el límite establecido (300 caracteres)");
            botonSubir.setAttribute('disabled', 'true');
        } else {
            console.log("Longitud OK");
            botonSubir.removeAttribute('disabled');
        }
    };

    /**
     * Valida que al menos dos respuestas estén rellenadas.
     * Deshabilita el botón de envío si no se cumplen las condiciones.
     */
    const validarRespuestas = () => {
        let filledCount = 0;
        respuestas.forEach((respuesta) => {
            if (respuesta.value.trim() !== '') {
                filledCount++;
            }
        });

        if (filledCount < 2) {
            alert('Debe rellenar al menos dos respuestas.');
            botonSubir.setAttribute('disabled', 'true');
        } else {
            botonSubir.removeAttribute('disabled');
        }
    };

    // Evento para validar la longitud de la pregunta cuando se pierde el foco
    pregunta.addEventListener('focusout', validarPregunta);

    // Evento para validar la longitud de las respuestas cuando se pierde el foco
    respuestas.forEach((respuesta) => {
        respuesta.addEventListener('focusout', () => validarRespuesta(respuesta));
    });

    // Evento para validar que al menos dos respuestas estén rellenadas antes de enviar el formulario
    botonSubir.addEventListener('click', (event) => {
        validarRespuestas();
    });

    // Evento para volver a la página anterior
    botonVolver.addEventListener('click', () => {
        window.location.href='index.php';
    });

});