// Levi Josué Candeias de Figueiredo
'use strict';

document.addEventListener('DOMContentLoaded', () => {
    // Referencias a los elementos del DOM
    const botonSubir = document.getElementById('submitButton');
    const aniadirRespuestas = document.getElementById('aniadirRespuestas');
    const contenedorDeRespuestas = document.getElementById('contenedorDeRespuestas');
    const removeRespuesta = document.getElementById('quitarRespuestas');
    const pregunta = document.getElementById('pregunta');

    let counter = 1; // Contador de respuestas agregadas

    /**
     * Añade un nuevo campo de respuesta al formulario.
     * Limita la cantidad máxima de respuestas a 4.
     * @param {Event} event El evento de clic en el botón de añadir respuesta.
     */
    const handleAddRespuesta = (event) => {
        event.preventDefault(); // Previene el envío del formulario

        // Limita el número de respuestas a 4
        if (counter >= 4) {
            alert("No se pueden añadir más preguntas");
        } else {
            counter++;

            // Crear y añadir un nuevo campo de entrada de texto para respuesta
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'respuestas';
            newInput.id = `respuestas${counter}`;
            newInput.required = true;

            contenedorDeRespuestas.appendChild(newInput); // Añade el nuevo input al contenedor
        }
    };

    /**
     * Elimina el último campo de respuesta del formulario.
     * No permite eliminar todas las respuestas (al menos una debe quedar).
     * @param {Event} event El evento de clic en el botón de quitar respuesta.
     */
    const handleRemoveRespuesta = (event) => {
        event.preventDefault(); // Previene el envío del formulario

        // Evita eliminar todas las respuestas (al menos una debe quedar)
        if (counter <= 1) {
            alert("No se pueden quitar más preguntas");
        } else {
            const ultimaRespuesta = document.getElementById(`respuestas${counter}`);
            ultimaRespuesta.remove(); // Elimina el último input de respuesta
            counter--; // Decrementa el contador
        }
    };

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

    // Evento para validar la longitud de la pregunta cuando se pierde el foco
    pregunta.addEventListener('focusout', validarPregunta);

    // Evento para validar la longitud de las respuestas cuando se pierde el foco
    document.addEventListener('focusout', (event) => {
        // Solo valida la respuesta actual
        if (event.target && event.target.matches(`#respuestas${counter}`)) {
            validarRespuesta();
        }
    });
});
