'use strict';

// Variables de secciones
const mainMenu = document.getElementById('contenedorBotones');
const historiaCard = document.getElementById('historiaCard');
const rankingCard = document.getElementById('rankingCard');
const descripcionCard = document.getElementById('descripcionPersonaje');

// Botones principales
document.getElementById('botonHistoria').addEventListener('click', () => gestionarSecciones('historia'));
document.getElementById('botonRanking').addEventListener('click', () => gestionarSecciones('ranking'));

// Botones de personajes
document.querySelectorAll('.personaje-btn').forEach((btn) => {
    btn.addEventListener('click', () => mostrarDescripcion(btn.dataset.personaje));
});

// Botones para volver
//document.getElementById('volverBtnHistoria').addEventListener('click', volverAlMenu);
document.getElementById('volverBtnDescripcion').addEventListener('click', volverAHistoria);
document.querySelectorAll('.volverBtnRanking').forEach(boton => {
    boton.addEventListener('click', volverAlMenu);
});

// Función para gestionar las secciones
function gestionarSecciones(menuPart) {
    mainMenu.style.display = 'none';

    switch (menuPart) {
        case 'historia':
            historiaCard.style.display = 'block';
            rankingCard.style.display = 'none';
            break;
        case 'ranking':
            rankingCard.style.display = 'block';
            historiaCard.style.display = 'none';
            break;
        default:
            console.error("Opción no válida: " + menuPart);
    }
}

// Función para mostrar la descripción de un personaje
function mostrarDescripcion(personaje) {
    historiaCard.style.display = 'none';
    descripcionCard.style.display = 'block';

    const imagenPersonaje = document.getElementById('imagenPersonaje');
    const nombrePersonaje = document.getElementById('nombrePersonaje');
    const textoDescripcion = document.getElementById('textoDescripcion');

    switch (personaje) {
        case 'luis':
            imagenPersonaje.src = 'assets/img/luis.png';
            nombrePersonaje.textContent = 'Luis';
            textoDescripcion.textContent = 'Luis es un joven aventurero, lleno de energía y curiosidad.';
            break;
        case 'ana':
            imagenPersonaje.src = 'assets/img/ana.png';
            nombrePersonaje.textContent = 'Ana';
            textoDescripcion.textContent = 'Ana es una investigadora apasionada por la ciencia.';
            break;
        case 'martina':
            imagenPersonaje.src = 'assets/img/martina.png';
            nombrePersonaje.textContent = 'Martina';
            textoDescripcion.textContent = 'Martina es una estratega brillante.';
            break;
        default:
            console.error('Personaje desconocido');
    }
}

// Función para volver a la historia
function volverAHistoria() {
    descripcionCard.style.display = 'none';
    historiaCard.style.display = 'block';
}

// Función para volver al menú principal
function volverAlMenu() {
    mainMenu.style.display = 'flex';
    historiaCard.style.display = 'none';
    rankingCard.style.display = 'none';
    descripcionCard.style.display = 'none';
}
