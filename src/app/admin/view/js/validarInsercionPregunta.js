'use strict'

document.addEventListener('DOMContentLoaded', () => {
    //Se añade el boton de submit al DOM
    let botonSubir = document.getElementById('submitButton');


    // Añadir y quitar respuestas
    let aniadirRespuestas = document.getElementById('aniadirRespuestas');
    let contenedorDeRespuestas = document.getElementById('contenedorDeRespuestas');
    let removeRespuesta = document.getElementById('quitarRespuestas');

    let counter = 1;

    //Añadir respuestas
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
            newInput.id = 'respuestas'+counter;
            newInput.required = true;

            // Se añade el nuevo campo al contenedor
            contenedorDeRespuestas.appendChild(newInput);
        }
    });

    //Quitar respuestas
    removeRespuesta.addEventListener('click', (event) => {
        event.preventDefault(); //Bloquea la subida del form cuando se clica en el boton
        
        if (counter <= 1) {
            alert("No se pueden quitar más preguntas");
        } else {
            let ultimaRespuesta = document.getElementById('respuestas'+counter);
            ultimaRespuesta.remove();
            counter--;
        }
    });

    //Validacion de longitud de values de formulario
    //Pregunta
    let pregunta = document.getElementById('pregunta');
    pregunta.addEventListener('focusout', ()=>{
        let longitud = pregunta.value.length;

        if (longitud > 350) {
            alert("La longitud de la pregunta supera el límite establecido (350 caracteres)");
            botonSubir.setAttribute('disabled', 'true'); // Deshabilitar el botón
        } else {
            console.log("Longitud OK");
            botonSubir.removeAttribute('disabled'); // Habilitar el botón si la longitud es válida
        }
        
    });

    //Respuestas
    let respuestas = document.getElementById('respuestas'+counter);
    respuestas.addEventListener('focusout', ()=>{
        let longitud = respuestas.value.length;

        if (longitud > 300) {
            alert("La longitud de la respuesta supera el límite establecido (300 caracteres)");
            botonSubir.setAttribute('disabled', 'true'); // Deshabilitar el botón
            aniadirRespuestas.setAttribute('disabled', 'true'); //Deshabilitar la opcion de añadir una pregunta más
            removeRespuesta.setAttribute('disabled', 'true'); //Deshabilitar la opcion de añadir una pregunta más
        } else {
            console.log("Longitud OK");
            botonSubir.removeAttribute('disabled'); // Habilitar el botón si la longitud es válida
            aniadirRespuestas.removeAttribute('disabled');
            removeRespuesta.removeAttribute('disabled');
        }
        
    });

});

