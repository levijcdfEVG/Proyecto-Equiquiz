// Configuración inicial
const movimiento = 10;
const jugador = {
  x: 0,
  y: 0,
  image: document.getElementById("player")
};

// Mapeo de teclas
const keyHandlers = {
  w: () => { jugador.y -= movimiento; },
  a: () => { jugador.x -= movimiento; },
  s: () => { jugador.y += movimiento; },
  d: () => { jugador.x += movimiento; }
};

// Función para actualizar la posición del jugador
function actualizarPosicionJugador() {
  jugador.image.style.left = `${jugador.x}px`;
  jugador.image.style.top = `${jugador.y}px`;
}

// Evento de teclado
window.addEventListener("keydown", (event) => {
  const keyPressed = event.key.toLowerCase(); // Convertimos la tecla a minúscula
  if (keyPressed in keyHandlers) {
    keyHandlers[keyPressed]();
    actualizarPosicionJugador();
  }
});

// Inicialización
actualizarPosicionJugador();
