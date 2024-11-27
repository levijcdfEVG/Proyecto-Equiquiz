'use strict';

// Función para gestionar las secciones
function gestionarSecciones(menuPart) {
    const mainMenu = document.getElementById('contenedorBotones');
    const historiaCard = document.getElementById('historiaCard');
    const rankingCard = document.getElementById('rankingCard');

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
        case 'jugar':
            alert("El modo 'Jugar' no está implementado todavía.");
            mainMenu.style.display = 'flex';
            break;
        default:
            console.error("Opción no válida: " + menuPart);
    }
}

// Función para mostrar la descripción de un personaje
function mostrarDescripcion(personaje) {
    // Ocultar la sección de historia
    document.getElementById('historiaCard').style.display = 'none';
    // Mostrar la sección de descripción
    document.getElementById('descripcionPersonaje').style.display = 'block';

    // Seleccionar los elementos de imagen, nombre y descripción
    const imagenPersonaje = document.getElementById('imagenPersonaje');
    const nombrePersonaje = document.getElementById('nombrePersonaje');
    const textoDescripcion = document.getElementById('textoDescripcion');

    // Cambiar la imagen y la descripción según el personaje
    switch (personaje) {
        case 'luis':
            imagenPersonaje.src = 'assets/img/luis.png';
            nombrePersonaje.textContent = 'Luis';
            textoDescripcion.textContent = 'Descripción de Luis: Luis es un joven aventurero, lleno de energía y curiosidad, siempre dispuesto a enfrentar nuevos desafíos.';
            break;
        case 'ana':
            imagenPersonaje.src = 'assets/img/ana.png';
            nombrePersonaje.textContent = 'Ana';
            textoDescripcion.textContent = 'Descripción de Ana: Ana es una investigadora apasionada por la ciencia, conocida por su inteligencia y perseverancia.';
            break;
        case 'martina':
            imagenPersonaje.src = 'assets/img/martina.png';
            nombrePersonaje.textContent = 'Martina';
            textoDescripcion.textContent = 'Descripción de Martina: Martina es una estratega brillante, capaz de analizar cualquier situación con calma y tomar decisiones sabias.';
            break;
        default:
            console.error('Personaje desconocido');
            break;
    }
}

// Función para volver a la historia
function volverAHistoria() {
    document.getElementById('descripcionPersonaje').style.display = 'none';
    document.getElementById('historiaCard').style.display = 'block';
}

// Función para volver al menú principal
function volverAlMenu() {
    const mainMenu = document.getElementById('contenedorBotones');
    const historiaCard = document.getElementById('historiaCard');
    const rankingCard = document.getElementById('rankingCard');
    mainMenu.style.display = 'flex';
    historiaCard.style.display = 'none';
    rankingCard.style.display = 'none';
}
