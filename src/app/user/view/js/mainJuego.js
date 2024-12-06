//import { verificarCercania, actualizarProgreso } from './file.js';
'use strict';

// Configuración inicial
const movimiento = 10;
const jugador = {
    x: 370,
    y: 680,
    image: document.getElementById("player")
};
const divJuego = document.getElementById("div-juego");
const barraProgreso = document.getElementById("rellenar-progreso");
let progreso = 0;

// Mapeo de teclas para movimiento
const keyHandlers = {
    w: () => { if (jugador.y > 0) jugador.y -= movimiento; },
    a: () => { if (jugador.x > 0) jugador.x -= movimiento; },
    s: () => {
        if (jugador.y + jugador.image.offsetHeight < divJuego.offsetHeight) 
            jugador.y += movimiento;
    },
    d: () => {
        if (jugador.x + jugador.image.offsetWidth < divJuego.offsetWidth) 
            jugador.x += movimiento;
    }
};

// Actualizar posición del jugador en la pantalla
function actualizarPosicionJugador() {
    jugador.image.style.left = `${jugador.x}px`;
    jugador.image.style.top = `${jugador.y}px`;
}

// Controlar progreso de la barra de equidad
function actualizarBarra() {
    if (progreso > 100) progreso = 100;
    if (progreso < 0) progreso = 0;
    barraProgreso.style.width = `${progreso}%`;
}

// Incrementar progreso de equidad
function incrementarProgreso(cantidad) {
    progreso += cantidad;
    actualizarBarra();
}

// Decrementar progreso de equidad
function decrementarProgreso(cantidad) {
    progreso -= cantidad;
    actualizarBarra();
}

// Manejo de eventos de teclado
window.addEventListener("keydown", (event) => {
    // Evitar que elementos interactivos capturen el evento
    if (["input", "textarea", "button"].includes(document.activeElement.tagName.toLowerCase())) {
        return; // Evita interferencia de elementos interactivos
    }

    const keyPressed = event.key.toLowerCase();
    console.log(`Tecla presionada: ${keyPressed}`); // Verifica que el evento sea capturado

    if (keyPressed in keyHandlers) {
        keyHandlers[keyPressed]();
        actualizarPosicionJugador();
        verificarCercania(jugador); // Lógica de los puntos
    }
});

// Configurar botones para interacción adicional
const buttonHandlers = {
    "arriba": () => { keyHandlers.w(); },
    "izq": () => { keyHandlers.a(); },
    "abajo": () => { keyHandlers.s(); },
    "dcha": () => { keyHandlers.d(); }
};

// Agregar eventos de clic a los botones de dirección
Object.keys(buttonHandlers).forEach(buttonId => {
    const button = document.getElementById(buttonId);
    if (button) {
        button.addEventListener("click", () => {
            buttonHandlers[buttonId]();
            actualizarPosicionJugador();
            //verificarCercania(jugador);
        });
    }
});

// Asignación de eventos para progresión y decrecimiento de equidad
document.getElementById("boton-correcto").addEventListener("click", () => incrementarProgreso(10));
document.getElementById("boton-incorrecto").addEventListener("click", () => decrementarProgreso(5));

// Inicializar posición y progreso
actualizarPosicionJugador();
actualizarBarra();
