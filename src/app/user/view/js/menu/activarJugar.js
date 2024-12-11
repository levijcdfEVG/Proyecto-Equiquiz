'use strict'

const btnSalud = document.getElementById('salud');
const btnLaboral = document.getElementById('laboral');
const btnEducacion = document.getElementById('educacion');

//Boton de historia
let historia = document.getElementById('botonHistoria');
historia.addEventListener('click', activarBoton);

//Activar el boton jugar solo si se ha entrado en el apartado historia
function activarBoton() {
    let botonJugar = document.getElementById('botonJugar');
    if(botonJugar.disabled)
        botonJugar.disabled = false;
}

//Enlace a juego.
btnLaboral.addEventListener('click', function() {
    window.location.href = '../juego/laboral.html';
});

btnSalud.addEventListener('click', function() {
    window.location.href = '../juego/salud.html';
});

btnEducacion.addEventListener('click', function() {
    window.location.href = '../juego/educacion.html';
});

