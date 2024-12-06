'use strict';

// Seleccionar todos los puntitos
const puntos = document.querySelectorAll('.punto');

// Mostrar el popup y manejar la respuesta
function mostrarPopup(preguntaId) {
    const respuesta = confirm(`¿Quieres responder la pregunta ${preguntaId}?`);
    if (respuesta) {
        // Simular validación de respuesta (puedes implementar lógica real aquí)
        const esCorrecta = Math.random() > 0.5; // 50% de probabilidad de acierto
        actualizarProgreso(esCorrecta ? 10 : -10);
        alert(esCorrecta ? '¡Correcto!' : 'Respuesta incorrecta');
    }
}

// Verificar cercanía entre el jugador y los puntitos
function verificarCercania(jugador) {
    puntos.forEach(punto => {
        const rectPunto = punto.getBoundingClientRect();
        const rectJugador = jugador.image.getBoundingClientRect();

        // Calcular distancia entre jugador y punto
        const distancia = Math.sqrt(
            Math.pow(rectJugador.left - rectPunto.left, 2) +
            Math.pow(rectJugador.top - rectPunto.top, 2)
        );

        // Mostrar popup si la distancia es menor a 50px
        if (distancia < 50) {
            mostrarPopup(punto.dataset.preguntaId);
        }
    });
}

// Actualizar progreso en la barra
function actualizarProgreso(cantidad) {
    progreso += cantidad;
    if (progreso > 100) progreso = 100;
    if (progreso < 0) progreso = 0;
    barraProgreso.style.width = `${progreso}%`;
}

// Exportar funciones
export { verificarCercania, actualizarProgreso };