/**
 * Importa la función para verificar la cercanía desde el archivo 'pointHandler.js'.
 */
import { verificarCercania } from './pointHandler.js';

/**
 * Activa el modo estricto de JavaScript.
 */
'use strict';

/**
 * Elemento del DOM que representa la barra de progreso del juego.
 * @type {HTMLElement}
 */
const barraProgreso = document.getElementById("rellenar-progreso");

/**
 * Configuración inicial del juego.
 * @constant
 * @type {number}
 */
const movimiento = 10;

/**
 * Objeto que representa al jugador en el juego, incluyendo su posición (x, y) y la imagen asociada.
 * @typedef {Object} Jugador
 * @property {number} x - Coordenada X del jugador.
 * @property {number} y - Coordenada Y del jugador.
 * @property {HTMLElement} image - Elemento de imagen del jugador.
 */
const jugador = {
    x: 430,
    y: 680,
    image: document.getElementById("player")
};

/**
 * Elemento del DOM que representa el contenedor principal del juego.
 * @type {HTMLElement}
 */
const divJuego = document.getElementById("div-juego");

/**
 * Nivel de progreso inicial del jugador en el juego.
 * @type {number}
 */
let progreso = 50; // Nivel inicial de progreso

/**
 * Objeto que mapea las teclas a sus respectivas funciones de movimiento.
 * Cada propiedad corresponde a una tecla y su valor es una función que mueve al jugador.
 * @type {Object<string, Function>}
 */
const keyHandlers = {
    /**
     * Mueve al jugador hacia arriba.
     * @function
     */
    w: () => { if (jugador.y > 0) jugador.y -= movimiento; },
    
    /**
     * Mueve al jugador hacia la izquierda.
     * @function
     */
    a: () => { if (jugador.x > 0) jugador.x -= movimiento; },
    
    /**
     * Mueve al jugador hacia abajo.
     * @function
     */
    s: () => {
        if (jugador.y + jugador.image.offsetHeight < divJuego.offsetHeight) 
            jugador.y += movimiento;
    },
    
    /**
     * Mueve al jugador hacia la derecha.
     * @function
     */
    d: () => {
        if (jugador.x + jugador.image.offsetWidth < divJuego.offsetWidth) 
            jugador.x += movimiento;
    }
};

/**
 * Actualiza la posición del jugador en el DOM en función de sus coordenadas (x, y).
 */
function actualizarPosicionJugador() {
    jugador.image.style.left = `${jugador.x}px`;
    jugador.image.style.top = `${jugador.y}px`;
}

/**
 * Maneja los eventos de teclas presionadas, controlando el movimiento del jugador.
 * No permite la interacción con campos de texto, áreas de texto o botones.
 * @param {KeyboardEvent} event - El evento de teclado disparado.
 */
window.addEventListener("keydown", (event) => {
    // Si el foco está en un campo de entrada, textarea o botón, no se procesa el evento
    if (["input", "textarea", "button"].includes(document.activeElement.tagName.toLowerCase())) {
        return;
    }

    // Obtener la tecla presionada
    const keyPressed = event.key.toLowerCase();
    
    // Si la tecla está mapeada en 'keyHandlers', ejecutar la función asociada
    if (keyPressed in keyHandlers) {
        keyHandlers[keyPressed]();
        actualizarPosicionJugador(); // Actualizar la posición del jugador
        verificarCercania(jugador); // Verificar si el jugador está cerca de un punto
    }
});

/**
 * Inicializa la posición del jugador y el progreso del juego.
 */
actualizarPosicionJugador();
