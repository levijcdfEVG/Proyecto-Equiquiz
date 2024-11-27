const barraProgreso = document.getElementById('barra-progreso');
const cantidadProgreso = document.getElementById('cantidad-progreso');
const mensajeGano = document.getElementById('mensaje-gano');
let progreso = 0; // Inicia en 0%

// Función para actualizar la barra de progreso
function actualizarBarra() {
  const porcentaje = `${progreso}%`;
  barraProgreso.style.width = porcentaje;
  cantidadProgreso.innerHTML = porcentaje;
}

// Función para manejar el clic en los botones correctos
function botonCorrecto() {
  progreso += 10;
  if (progreso >= 100) {
    progreso = 0; // Reinicia el progreso a 0%
    mensajeGano.style.display = 'block'; // Muestra el mensaje
  }
  actualizarBarra();
}

// Función para manejar el clic en los botones incorrectos
function botonIncorrecto() {
  progreso -= 5;
  if (progreso < 0) {
    progreso = 0; // Limitar el progreso a 0%
  }
  actualizarBarra();
}

// Asignación de eventos a los botones
document.getElementById('boton-correcto-1').addEventListener('click', botonCorrecto);
document.getElementById('boton-correcto-2').addEventListener('click', botonCorrecto);
document.getElementById('boton-incorrecto-1').addEventListener('click', botonIncorrecto);
document.getElementById('boton-incorrecto-2').addEventListener('click', botonIncorrecto);
document.getElementById('boton-incorrecto-3').addEventListener('click', botonIncorrecto);
