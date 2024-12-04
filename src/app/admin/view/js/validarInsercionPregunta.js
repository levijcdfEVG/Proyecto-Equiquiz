'use strict'

document.addEventListener('DOMContentLoaded', () => {

    // Añadir respyestas
    let aniadirRespuestas = document.getElementById('aniadirRespuestas');
    let contenedorPreguntas = document.getElementById('contenedorDeRespuestas');

    let counter = 1;

    aniadirRespuestas.addEventListener('click', (event) => {
        event.preventDefault(); //Bloquea la subida del form cuando se clica en el boton

        if (counter >= 4) {
            alert("No se pueden añadir más preguntas");
        } else {
            counter++;
            
            // Se crea un nuevo imput tipo text
            let newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'respuestas';
            newInput.id = `respuestas-${counter}`;
            newInput.required = true;

            // Se añade el nuevo campo al contenedor
            contenedorPreguntas.appendChild(newInput);
        }
    });
});

