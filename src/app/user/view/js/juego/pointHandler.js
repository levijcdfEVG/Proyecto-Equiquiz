'use strict';

const juego = document.getElementById('div-juego');
const mapa = document.getElementById('mapa');

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
 * Convierte la respuesta del servidor en un formato de objeto organizado.
 * @param {Array} data - Los datos de preguntas y opciones.
 * @returns {Object} - Un objeto organizado por pregunta y sus opciones.
 */
function procesarPreguntas(data) {
    const preguntasFormateadas = {};

    data.forEach(item => {
        // Si la pregunta no está en el objeto, agrégala
        if (!preguntasFormateadas[item.idPregunta]) {
            preguntasFormateadas[item.idPregunta] = {
                pregunta: item.Pregunta,
                opciones: [] // Inicializa un arreglo vacío para las opciones
            };
        }

        // Agrega la opción a la pregunta correspondiente
        preguntasFormateadas[item.idPregunta].opciones.push({
            idOpcion: item.idOpcion,
            contenido: item.Opcion,
            correcto: item.Correcto
        });
    });

    return preguntasFormateadas;
}

async function fetchPregunta(idEscenario) {
    try {
        console.log('Entra');

        const formData = new FormData();
        formData.append('action', 'getQuestion');
        formData.append('idEscenario', idEscenario);

        const respuesta = await fetch('../../../controller/fetchPreguntas.php', {
            method: 'POST',
            body: formData,
        });

        if (!respuesta.ok) {
            throw new Error(`Error HTTP! Código de estado: ${respuesta.status}`);
        }

        const preguntas = await respuesta.json();

        if (preguntas.status === 'success' && preguntas.data.length > 0) {
            const pregunta = {
                idPregunta: preguntas.data[0].idPregunta,
                contenido: preguntas.data[0].Pregunta,
                opciones: preguntas.data.map(opcion => ({
                    idOpcion: opcion.idOpcion,
                    contenido: opcion.Opcion,
                    correcto: opcion.Correcto === 1
                }))
            };

            console.log('Pregunta procesada:', pregunta);

            // Llamada a mostrarPopup con el objeto completo de la pregunta
            mostrarPopup(pregunta);
        } else {
            console.error('Error del servidor o datos vacíos:', preguntas.message || 'Sin preguntas disponibles.');
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}


function mostrarPopup(pregunta) {
    const popup = document.getElementById('popup'); // El contenedor del popup
    popup.innerHTML = ''; // Limpiar el contenido del popup

    // Crear un título con la pregunta
    const titulo = document.createElement('h3');
    titulo.textContent = pregunta.contenido;
    popup.appendChild(titulo);

    // Crear un contenedor para las opciones
    const opcionesContenedor = document.createElement('div');
    opcionesContenedor.classList.add('opciones');

    // Recorrer todas las opciones y añadirlas al contenedor
    pregunta.opciones.forEach(opcion => {
        const botonOpcion = document.createElement('button');
        botonOpcion.textContent = opcion.contenido;
        botonOpcion.classList.add('opcion-boton');

        // Evento al hacer clic en el botón
        botonOpcion.addEventListener('click', () => {
            if (opcion.correcto) {
                incrementarProgreso(25);
                alert('¡Respuesta correcta!');
            } else {
                decrementarProgreso(15);
                alert('Respuesta incorrecta');
            }

            // Actualiza la barra de progreso
            actualizarBarra();

            // Oculta el popup y vuelve al juego
            popup.style.display = 'none';
            juego.style.display = 'flex';
        });

        opcionesContenedor.appendChild(botonOpcion);
    });

    // Añadir las opciones al popup
    popup.appendChild(opcionesContenedor);

    // Mostrar el popup
    juego.style.display = 'none';
    popup.style.display = 'block';
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
        if (distancia < 30) {
            const escenario = punto.dataset.escenario;

            // Si ya se interactuó con este punto, incrementar el contador
            if (!interaccionesPuntos[escenario]) {
                interaccionesPuntos[escenario] = 0;
            }
            interaccionesPuntos[escenario]++;

            // Actualizar el contador en el DOM
            contadorPI.textContent = `P.I ${interaccionesPuntos[escenario]}/5`;

            // Si el punto se ha interactuado 5 veces, termina el juego
            if (interaccionesPuntos[escenario] >= 5) {
                botonTerminar.disabled = false; // Desactiva el botón de "Terminar"
            }

            // Muestra el popup para interactuar
            fetchPregunta(escenario);
            punto.style.display = 'none'; // Oculta el punto en el mapa una vez interactuado.
        }
    });
}

/**
 * Actualiza el ancho de la barra de progreso según el valor de 'progreso'.
 */
function actualizarBarra() {
    barraProgreso.style.width = `${progreso}%`;

    // Opcional: Cambiar el color de la barra según el progreso
    if (progreso >= 80) {
        barraProgreso.style.backgroundColor = 'green';
    } else if (progreso >= 50) {
        barraProgreso.style.backgroundColor = 'yellow';
    } else {
        barraProgreso.style.backgroundColor = 'red';
    }
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
