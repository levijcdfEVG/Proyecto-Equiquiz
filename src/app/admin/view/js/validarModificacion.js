// Levi Josué Candeias de Figueiredo
'use strict';

document.addEventListener('DOMContentLoaded', () => {
    // Referencias a elementos del DOM
    const botonModificar = document.querySelector('.btn.modificar');
    const pregunta = document.getElementById('pregunta');
    const respuestas = Array.from(document.querySelectorAll('[id^="respuesta"]')); // Captura dinámicamente las respuestas

    /**
     * Validar longitud de la pregunta.
     */
    const validarPregunta = () => {
        const longitud = pregunta.value.length;

        if (longitud === 0) {
            alert("La pregunta no puede estar vacía");
            botonModificar.setAttribute('disabled', 'true');
            return false;
        } else if (longitud > 350) {
            alert("La longitud de la pregunta supera el límite establecido (350 caracteres)");
            botonModificar.setAttribute('disabled', 'true');
            return false;
        } else {
            console.log("Pregunta válida");
            return true;
        }
    };

    /**
     * Validar longitud de una respuesta.
     * @param {HTMLElement} respuesta - Campo de texto de la respuesta a validar.
     * @returns {boolean} - Indica si la respuesta es válida.
     */
    const validarRespuesta = (respuesta) => {
        const longitud = respuesta.value.length;

        if (longitud > 300) {
            alert(`La longitud de la respuesta "${respuesta.id}" supera el límite establecido (300 caracteres)`);
            botonModificar.setAttribute('disabled', 'true');
            return false;
        } else {
            console.log(`Respuesta "${respuesta.id}" válida`);
            return true;
        }
    };

    /**
     * Validar todas las respuestas.
     * @returns {boolean} - Indica si todas las respuestas son válidas.
     */
    const validarRespuestas = () => {
        let validas = true;

        respuestas.forEach((respuesta) => {
            if (!validarRespuesta(respuesta)) {
                validas = false;
            }
        });

        return validas;
    };

    /**
     * Validar formulario completo al presionar "Modificar".
     */
    const validarFormulario = (event) => {
        event.preventDefault(); // Evita el envío si hay errores

        const preguntaValida = validarPregunta();
        const respuestasValidas = validarRespuestas();

        if (preguntaValida && respuestasValidas) {
            console.log("Formulario válido. Procesando modificación...");
            // Aquí puedes realizar el envío o procesamiento del formulario.
        } else {
            alert("Por favor, corrige los errores antes de continuar.");
        }
    };

    // Eventos para validar la pregunta
    pregunta.addEventListener('focusout', validarPregunta);

    // Eventos para validar cada respuesta
    respuestas.forEach((respuesta) => {
        respuesta.addEventListener('focusout', () => validarRespuesta(respuesta));
    });

    // Evento para manejar la validación completa al hacer clic en "Modificar"
    botonModificar.addEventListener('click', validarFormulario);
});
