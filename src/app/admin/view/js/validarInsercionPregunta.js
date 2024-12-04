// Levi Josué Candeias de Figueiredo
'use strict';

document.addEventListener('DOMContentLoaded', () => {
    // Referencias a elementos del DOM
    const botonSubir = document.getElementById('submitButton');
    const aniadirRespuestas = document.getElementById('aniadirRespuestas');
    const contenedorDeRespuestas = document.getElementById('contenedorDeRespuestas');
    const removeRespuesta = document.getElementById('quitarRespuestas');
    const pregunta = document.getElementById('pregunta');

    let counter = 1;

    /**
     * Añadir un nuevo campo de respuesta al formulario.
     */
    const handleAddRespuesta = (event) => {
        event.preventDefault(); // Bloquea la subida del form

        if (counter >= 4) {
            alert("No se pueden añadir más preguntas");
        } else {
            counter++;

            // Crear y añadir nuevo input de respuesta
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'respuestas';
            newInput.id = `respuestas${counter}`;
            newInput.required = true;

            contenedorDeRespuestas.appendChild(newInput);
        }
    };

    /**
     * Quitar el último campo de respuesta del formulario.
     */
    const handleRemoveRespuesta = (event) => {
        event.preventDefault(); // Bloquea la subida del form

        if (counter <= 1) {
            alert("No se pueden quitar más preguntas");
        } else {
            const ultimaRespuesta = document.getElementById(`respuestas${counter}`);
            ultimaRespuesta.remove();
            counter--;
        }
    };

    /**
     * Validar longitud de la pregunta.
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
            botonSubir.removeAttribute('disabled');
        }
    };

    /**
     * Validar longitud de una respuesta.
     */
    const validarRespuesta = () => {
        const respuestaActual = document.getElementById(`respuestas${counter}`);
        const longitud = respuestaActual.value.length;

        if (longitud === 0) {
            alert("La respuesta no puede estar vacía");
            botonSubir.setAttribute('disabled', 'true');
            aniadirRespuestas.setAttribute('disabled', 'true');
            removeRespuesta.setAttribute('disabled', 'true');
        } else if (longitud > 300) {
            alert("La longitud de la respuesta supera el límite establecido (300 caracteres)");
            botonSubir.setAttribute('disabled', 'true');
            aniadirRespuestas.setAttribute('disabled', 'true');
            removeRespuesta.setAttribute('disabled', 'true');
        } else {
            console.log("Longitud OK");
            botonSubir.removeAttribute('disabled');
            aniadirRespuestas.removeAttribute('disabled');
            removeRespuesta.removeAttribute('disabled');
        }
    };

    // Eventos para manejar añadir y quitar respuestas
    aniadirRespuestas.addEventListener('click', handleAddRespuesta);
    removeRespuesta.addEventListener('click', handleRemoveRespuesta);

    // Evento para validar la longitud de la pregunta
    pregunta.addEventListener('focusout', validarPregunta);

    // Evento para validar la longitud de las respuestas
    document.addEventListener('focusout', (event) => {
        if (event.target && event.target.matches(`#respuestas${counter}`)) {
            validarRespuesta();
        }
    });
});
