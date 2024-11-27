'use strict';

// Función para gestionar las secciones
function gestionarSecciones(menuPart) {
    // Elementos del DOM
    const mainMenu = document.getElementById('contenedorBotones');
    const historiaCard = document.getElementById('historiaCard');
    const rankingCard = document.getElementById('rankingCard');

    // Ocultar menú principal
    mainMenu.style.display = 'none';

    // Mostrar la sección correspondiente
    switch (menuPart) {
        case 'historia':
            historiaCard.style.display = 'block';
            rankingCard.style.display = 'none';
            break;

        case 'ranking':
            rankingCard.style.display = 'block';
            historiaCard.style.display = 'none';
            break;

        case 'jugar':
            alert("El modo 'Jugar' no está implementado todavía.");
            // En caso de que luego haya una sección para 'jugar', puedes añadirla.
            mainMenu.style.display = 'flex';
            break;

        default:
            console.error("Opción no válida: " + menuPart);
    }
}

// Función para volver al menú principal
function volverAlMenu() {
    // Elementos del DOM
    const mainMenu = document.getElementById('contenedorBotones');
    const historiaCard = document.getElementById('historiaCard');
    const rankingCard = document.getElementById('rankingCard');

    // Mostrar el menú principal y ocultar las secciones
    mainMenu.style.display = 'flex';
    historiaCard.style.display = 'none';
    rankingCard.style.display = 'none';
}
