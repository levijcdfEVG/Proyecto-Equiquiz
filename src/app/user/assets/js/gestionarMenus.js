'use strict';

// Variables de secciones
const mainMenu = document.getElementById('contenedorBotones');
const historiaCard = document.getElementById('historiaCard');
const rankingCard = document.getElementById('rankingCard');
const descripcionCard = document.getElementById('descripcionPersonaje');
const seleccionEscenarios = document.getElementById('seleccionEscenarios'); 

// Botones principales
document.getElementById('botonHistoria').addEventListener('click', () => gestionarSecciones('historia'));
document.getElementById('botonRanking').addEventListener('click', () => gestionarSecciones('ranking'));
document.getElementById('botonJugar').addEventListener('click', () => gestionarSecciones('escenarios'));

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
        case 'escenarios':
            seleccionEscenarios.style.display = 'block';
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
            imagenPersonaje.src = '/src/app/user/assets/img/luis.png';
            nombrePersonaje.textContent = 'Luis';
            textoDescripcion.textContent = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lacus metus, dignissim sit amet congue in, maximus quis nibh. In convallis hendrerit neque, eget pretium mi faucibus eu.';
            break;
        case 'ana':
            imagenPersonaje.src = '/src/app/user/assets/img/ana.png';
            nombrePersonaje.textContent = 'Ana';
            textoDescripcion.textContent = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lacus metus, dignissim sit amet congue in, maximus quis nibh. In convallis hendrerit neque, eget pretium mi faucibus eu.';
            break;
        case 'martina':
            imagenPersonaje.src = '/src/app/user/assets/img/martina.png';
            nombrePersonaje.textContent = 'Martina';
            textoDescripcion.textContent = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lacus metus, dignissim sit amet congue in, maximus quis nibh. In convallis hendrerit neque, eget pretium mi faucibus eu.';
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
    seleccionEscenarios.style.display = 'none';
}
