const barraProgreso = document.getElementById('barra-progreso');
const cantidadProgreso = document.getElementById('cantidad-progreso');
const mensajeGano = document.getElementById('mensaje-gano');
let progreso = 0; // Progreso inicial

// Función para actualizar la barra de progreso
function actualizarBarra() {
     // Comprobar si el progreso alcanza el 100%
     if (progreso >= 100) {
        progreso = 0; // Reinicia la barra
        mensajeGano.style.display = 'block'; // Muestra el mensaje
        setTimeout(() => {
            mensajeGano.style.display = 'none'; // Oculta el mensaje después de 3 segundos
        }, 2000);
    }
  const porcentaje = `${progreso}%`;
  barraProgreso.style.width = porcentaje;
  cantidadProgreso.innerHTML = porcentaje;
}

// Función para incrementar el progreso gradualmente
function incrementarProgreso(cantidad) {
  const incremento = setInterval(() => {
    if (cantidad > 0) {
      progreso++;
      cantidad--;
      if (progreso > 100) progreso = 100; // Limita el progreso máximo a 100%
      actualizarBarra();
    } else {
      clearInterval(incremento); // Detiene el intervalo cuando se alcanza la cantidad
    }
  }, 100); // Aumenta 1% cada 50 ms
}

// Función para decrementar el progreso gradualmente
function decrementarProgreso(cantidad) {
  const decremento = setInterval(() => {
    if (cantidad > 0) {
      progreso--;
      cantidad--;
      if (progreso < 0) progreso = 0; // Evita que el progreso sea negativo
      actualizarBarra();
    } else {
      clearInterval(decremento); // Detiene el intervalo cuando se alcanza la cantidad
    }
  }, 100); // Disminuye 1% cada 50 ms
}

// Función para manejar el clic en los botones correctos
function botonCorrecto() {
  incrementarProgreso(10); // Incrementa el progreso en 10%
}

// Función para manejar el clic en los botones incorrectos
function botonIncorrecto() {
  decrementarProgreso(5); // Disminuye el progreso en 5%
}

// Asignación de eventos a los botones
document.getElementById('boton-correcto-1').addEventListener('click', botonCorrecto);
document.getElementById('boton-correcto-2').addEventListener('click', botonCorrecto);
document.getElementById('boton-incorrecto-1').addEventListener('click', botonIncorrecto);
document.getElementById('boton-incorrecto-2').addEventListener('click', botonIncorrecto);
document.getElementById('boton-incorrecto-3').addEventListener('click', botonIncorrecto);
