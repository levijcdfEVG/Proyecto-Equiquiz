/**
 * Activa el modo estricto de JavaScript.
 */
'use strict';

/**
 * Elemento del DOM que representa la barra de progreso.
 * @type {HTMLElement}
 */
const barraProgreso = document.getElementById("rellenar-progreso");

/**
 * Lista de todos los puntos (elementos con clase 'punto') en el juego.
 * @type {NodeListOf<HTMLElement>}
 */
const puntos = document.querySelectorAll('.punto');

/**
 * Nivel de progreso inicial del jugador.
 * @type {number}
 */
let progreso = 50; // Progreso inicial

// Establece el ancho de la barra de progreso según el valor de 'progreso'
barraProgreso.style.width = `${progreso}%`;

/**
 * Muestra un cuadro de diálogo de confirmación para una pregunta específica.
 * Si el jugador responde afirmativamente, incrementa el progreso, de lo contrario lo decrementa.
 * @param {string} preguntaId - El identificador de la pregunta.
 */
function mostrarPopup(preguntaId) {
    const respuesta = confirm(`¿Quieres responder la pregunta ${preguntaId}?`);
    if (respuesta) {
        incrementarProgreso(10); // Incrementa si responde "Sí"
    } else {
        decrementarProgreso(10); // Decrementa si responde "No"
    }
    actualizarBarra(); // Actualiza la barra de progreso
}

/**
 * Incrementa el progreso en una cantidad específica, limitando el valor a 100%.
 * @param {number} cantidad - La cantidad a incrementar en el progreso.
 */
function incrementarProgreso(cantidad) {
    progreso = Math.min(progreso + cantidad, 100); // Limita a 100%
}

/**
 * Decrementa el progreso en una cantidad específica, evitando valores menores a 0%.
 * @param {number} cantidad - La cantidad a decrementar en el progreso.
 */
function decrementarProgreso(cantidad) {
    progreso = Math.max(progreso - cantidad, 0); // No permite valores menores a 0%
}

/**
 * Verifica la cercanía entre el jugador y los puntos en el juego.
 * Si la distancia entre el jugador y un punto es menor a 50px, muestra un popup con la pregunta relacionada.
 * @param {Object} jugador - El objeto que representa al jugador.
 * @param {HTMLElement} jugador.image - El elemento de imagen del jugador.
 */
function verificarCercania(jugador) {
    puntos.forEach(punto => {
        const rectPunto = punto.getBoundingClientRect();
        const rectJugador = jugador.image.getBoundingClientRect();

        // Calcular la distancia entre el jugador y el punto
        const distancia = Math.sqrt(
            Math.pow(rectJugador.left - rectPunto.left, 2) +
            Math.pow(rectJugador.top - rectPunto.top, 2)
        );

        // Muestra el popup si la distancia es menor a 50px
        if (distancia < 50) {
            mostrarPopup(punto.dataset.preguntaId);
        }
    });
}

/**
 * Actualiza el ancho de la barra de progreso según el valor de 'progreso'.
 */
function actualizarBarra() {
    barraProgreso.style.width = `${progreso}%`;
}

// Exporta la función para verificar la cercanía
export { verificarCercania };
