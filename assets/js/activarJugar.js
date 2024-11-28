'use strict'

//Boton de historia
let historia = document.getElementById('botonHistoria');
historia.addEventListener('click', activarBoton);

//Activar el boton jugar solo si se ha entrado en el apartado historia
function activarBoton() {
    let botonJugar = document.getElementById('botonJugar');
    if(botonJugar.disabled)
        botonJugar.disabled = false;
}

