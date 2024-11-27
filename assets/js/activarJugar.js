'use strict'

let historia = document.getElementById('botonHistoria');
historia.addEventListener('click', activarBoton);


function activarBoton() {
    let botonJugar = document.getElementById('botonJugar');
    if(botonJugar.disabled)
        botonJugar.disabled = false;
}

