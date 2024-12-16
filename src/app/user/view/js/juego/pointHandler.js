'use strict';

import { setPuedeMover } from './mainJuego.js';

const juego = document.getElementById('div-juego');
const botones = document.getElementById('barraBotones');
const drch = document.getElementById('botones-dcha');
const izqrd  = document.getElementById('controles');
let puntuacion = 500;

// Elemento del DOM que representa la barra de progreso.
const barraProgreso = document.getElementById("rellenar-progreso");

// Lista de todos los puntos (elementos con clase 'punto') en el juego.
const puntos = document.querySelectorAll('.punto');

// Elemento del DOM que representa el contador de puntos de interés interactuados.
const contadorPI = document.querySelector('.botones.progreso');

// Elemento del DOM que representa el botón de "Terminar" en la interfaz.
const botonTerminar = document.querySelector('.botones.terminar');

// Nivel de progreso inicial del jugador.
let progreso = 50; // Progreso inicial

// Establece el ancho de la barra de progreso según el valor de 'progreso'
barraProgreso.style.width = `${progreso}%`;

// Objeto que guarda el número de interacciones con los puntos de interés.
const interaccionesPuntos = {};

// Convierte la respuesta del servidor en un formato de objeto organizado.
function procesarPreguntas(data) {
    const preguntasFormateadas = {};

    data.forEach(item => {
        if (!preguntasFormateadas[item.idPregunta]) {
            preguntasFormateadas[item.idPregunta] = {
                pregunta: item.Pregunta,
                opciones: [] // Inicializa un arreglo vacío para las opciones
            };
        }

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
            const numPregunta = preguntas.data[0].idPregunta;

            const pregunta = {
                idPregunta: preguntas.data[0].idPregunta,
                contenido: preguntas.data[0].Pregunta,
                opciones: preguntas.data
                    .filter(opcion => opcion.idPregunta === numPregunta)
                    .map(opcion => ({
                        idOpcion: opcion.idOpcion,
                        contenido: opcion.Opcion,
                        correcto: opcion.Correcto === 1
                    }))
            };

            mostrarPopup(pregunta);
        } else {
            console.error('Error del servidor o datos vacíos:', preguntas.message || 'Sin preguntas disponibles.');
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

function mostrarPopup(pregunta) {
    const popup = document.getElementById('popup');
    popup.innerHTML = ''; // Limpiar el contenido del popup

    // Desactiva el movimiento del jugador
    setPuedeMover(false);

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
            botones.style.display = 'flex';
            drch.style.display = 'flex';
            izqrd.style.display = 'flex';

            // Activa el movimiento del jugador
            setPuedeMover(true);
        });

        opcionesContenedor.appendChild(botonOpcion);
    });

    // Añadir las opciones al popup
    popup.appendChild(opcionesContenedor);

    // Mostrar el popup
    juego.style.display = 'none';
    botones.style.display = 'none';
    drch.style.display = 'none';
    izqrd.style.display = 'none';
    popup.style.display = 'block';
}


function incrementarProgreso(cantidad) {
    progreso = Math.min(progreso + cantidad, 100);
    puntuacion += 200;
}

function decrementarProgreso(cantidad) {
    progreso = Math.max(progreso - cantidad, 0);
    puntuacion -= 100;
}

function verificarCercania(jugador) {
    puntos.forEach(punto => {
        const rectPunto = punto.getBoundingClientRect();
        const rectJugador = jugador.image.getBoundingClientRect();

        const distancia = Math.sqrt(
            Math.pow(rectJugador.left - rectPunto.left, 2) +
            Math.pow(rectJugador.top - rectPunto.top, 2)
        );

        if (distancia < 30) {
            const escenario = punto.dataset.escenario;

            if (!interaccionesPuntos[escenario]) {
                interaccionesPuntos[escenario] = 0;
            }
            interaccionesPuntos[escenario]++;

            contadorPI.textContent = `P.I ${interaccionesPuntos[escenario]}/5`;

            if (interaccionesPuntos[escenario] >= 5) {
                botonTerminar.disabled = false;
            }

            fetchPregunta(escenario);
            punto.style.display = 'none';
        }
    });
}

function actualizarBarra() {
    barraProgreso.style.width = `${progreso}%`;

    if (progreso >= 80) {
        barraProgreso.style.backgroundColor = 'green';
    } else if (progreso >= 50) {
        barraProgreso.style.backgroundColor = 'yellow';
    } else {
        barraProgreso.style.backgroundColor = 'red';
    }
}

function terminarJuego() {
    window.location.href = `formularioRanking.php?puntuacion=${puntuacion}`;
}

botonTerminar.addEventListener('click', terminarJuego);

export { verificarCercania };
