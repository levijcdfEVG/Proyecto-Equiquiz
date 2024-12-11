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
 * Elemento del DOM que representa el contador de puntos de interés interactuados.
 * @type {HTMLElement}
 */
const contadorPI = document.querySelector('.botones.progreso');

/**
 * Elemento del DOM que representa el botón de "Terminar" en la interfaz.
 * @type {HTMLElement}
 */
const botonTerminar = document.querySelector('.botones.terminar');

/**
 * Nivel de progreso inicial del jugador.
 * @type {number}
 */
let progreso = 50; // Progreso inicial

// Establece el ancho de la barra de progreso según el valor de 'progreso'
barraProgreso.style.width = `${progreso}%`;

/**
 * Objeto que guarda el número de interacciones con los puntos de interés.
 * @type {Object<string, number>}
 */
const interaccionesPuntos = {};

/**
 * Muestra un cuadro de diálogo de confirmación para una pregunta específica.
 * Si el jugador responde afirmativamente, incrementa el progreso, de lo contrario lo decrementa.
 * @param {string} preguntaId - El identificador de la pregunta.
 */
// function mostrarPopup(preguntaId) {
//     const respuesta = confirm(`¿Quieres responder la pregunta ${preguntaId}?`);
//     if (respuesta) {
//         incrementarProgreso(10); // Incrementa si responde "Sí"
//     } else {
//         decrementarProgreso(10); // Decrementa si responde "No"
//     }
//     actualizarBarra(); // Actualiza la barra de progreso
// }

async function fetchPregunta(idEscenario) {
    try {
        const respuesta = await fetch('src/app/user/controller/CPInteres.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'getQuestion',
                idEscenario: idEscenario,
            }),
        });

        const preguntas = await respuesta.json();
        mostrarPopup(preguntas.data);
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

function mostrarPopup(preguntas) {
    // Seleccionar una pregunta aleatoria
    const pregunta = preguntas[Math.floor(Math.random() * preguntas.length)];

    const popup = document.createElement('div');
    popup.classList.add('popup');

    // Creamos la pregunta
    const preguntaDiv = document.createElement('div');
    preguntaDiv.classList.add('pregunta');
    preguntaDiv.textContent = pregunta.Pregunta;
    popup.appendChild(preguntaDiv);

    // Crear un contenedor para las opciones de respuesta
    const opcionesDiv = document.createElement('div');
    opcionesDiv.classList.add('opciones');

    // Crear los botones para las opciones
    pregunta.Opcion.forEach(opcion => {
        const botonOpcion = document.createElement('button');
        botonOpcion.textContent = opcion;
        botonOpcion.onclick = () => verificarRespuesta(opcion, pregunta);
        opcionesDiv.appendChild(botonOpcion);
    });

    popup.appendChild(opcionesDiv);

    // Añadir el popup al body
    document.body.appendChild(popup);
}


function verificarRespuesta(opcion, pregunta) {
    // Comprobar si la opción es correcta
    if (opcion === pregunta.Correcto) {
        alert("ok");
    } else {
        alert("nook");
    }
    document.body.removeChild(document.querySelector('.popup'));
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
 * Además, lleva un contador de interacciones por punto de interés y actualiza el DOM.
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

        // Si la distancia es menor a 50px
        if (distancia < 50) {
            const escenario = punto.dataset.escenario;

            // Si ya se interactuó con este punto, incrementar el contador
            if (!interaccionesPuntos[escenario]) {
                interaccionesPuntos[escenario] = 0;
            }
            interaccionesPuntos[escenario]++;

            // Actualizar el contador en el DOM
            contadorPI.textContent = `P.I ${Object.values(interaccionesPuntos).reduce((acc, val) => acc + val, 0)}/5`;

            // Si el punto se ha interactuado 5 veces, termina el juego
            if (interaccionesPuntos[preguntaId] >= 5) {
                botonTerminar.disabled = false; // Desactiva el botón de "Terminar"
            }

            // Muestra el popup para interactuar
            fetchPregunta(escenario);
        }
    });
}

/**
 * Actualiza el ancho de la barra de progreso según el valor de 'progreso'.
 */
function actualizarBarra() {
    barraProgreso.style.width = `${progreso}%`;
}

/**
 * Termina el juego y muestra un mensaje de finalización.
 */
function terminarJuego() {
    alert("¡Juego terminado! Has interactuado con todos los puntos de interés.");
}

/**
 * Evento que se dispara cuando el jugador hace clic en el botón "Terminar".
 * Este evento llama a la función `terminarJuego`, que finaliza el juego y muestra un mensaje de alerta.
 */
botonTerminar.addEventListener('click', terminarJuego);

// Exporta la función para verificar la cercanía
export { verificarCercania };
