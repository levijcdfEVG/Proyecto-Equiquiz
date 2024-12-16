'use strict';

// Variables de secciones
const mainMenu = document.getElementById('contenedorBotones');
const historiaCard = document.getElementById('historiaCard');
const rankingCard = document.getElementById('rankingCard');
const descripcionCard = document.getElementById('descripcionPersonaje');
const seleccionEscenarios = document.getElementById('seleccionEscenarios'); 
const mapaEducacion = document.getElementById('laboral');

//Reforzar que los elementos esten ocultos
historiaCard.style.display = 'none';
rankingCard.style.display = 'none';
descripcionCard.style.display = 'none';
seleccionEscenarios.style.display = 'none';
mainMenu.style.display = 'flex';

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


btnSalir.addEventListener('click', () => {
    window.location.href = '/src/app/user/view/js/menu/mainMenu.html';
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
            imagenPersonaje.src = '../../../assets/img/luis.png';
            imagenPersonaje.style.width = '8%';
            nombrePersonaje.textContent = 'Luis';
            textoDescripcion.textContent = 'Luis ha trabajado toda su vida en entornos exigentes física y emocionalmente. A pesar de que enfrenta altos niveles de estrés y desgaste mental, nunca ha buscado ayuda porque siente la presión social que dicta que "los hombres no deben mostrar vulnerabilidad". Ahora quiere mejorar su bienestar emocional y desafiar esos estereotipos.';
            break;
        case 'ana':
            imagenPersonaje.src = '../../../assets/img/ana.png';
            imagenPersonaje.style.width = '8%';
            nombrePersonaje.textContent = 'Ana';
            textoDescripcion.textContent = 'Ana está en un entorno profesional donde predominan los hombres. A menudo enfrenta prejuicios sobre su capacidad y ve cómo sus ideas o habilidades se ponen en duda simplemente por su género. Busca oportunidades para ser reconocida como una profesional competente en ingeniería y romper estereotipos sobre "carreras masculinas';
            break;
        case 'martina':
            imagenPersonaje.src = '../../../assets/img/martina.png';
            imagenPersonaje.style.width = '8%';
            nombrePersonaje.textContent = 'Martina';
            textoDescripcion.textContent = 'Martina está terminando su formación y lucha por acceder a becas y programas educativos que históricamente han favorecido a los hombres. Quiere oportunidades para desarrollarse académicamente en igualdad de condiciones y demostrar su potencial, especialmente en áreas STEM (Ciencia, Tecnología, Ingeniería y Matemáticas).';
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
