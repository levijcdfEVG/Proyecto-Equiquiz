window.addEventListener('load', function() {
    const añadirPersonaje = document.getElementById('añadirPersonajes');
    const eliminarPersonaje = document.getElementById('eliminarPersonajes');
    const modificarPersonaje = document.getElementById('modificarPersonajes');
    const listarPersonaje = document.getElementById('listarPersonajes');
    const recuperarPersonaje = document.getElementById('recuperarPersonajes');
    const luis = document.getElementById('luis');
    const martina = document.getElementById('martina');

    añadirPersonaje.addEventListener('click', function() {
        window.location.href = '../../diseño/GestionPersonajes/añadirPersonaje.html';
    });

    eliminarPersonaje.addEventListener('click', function() {
        window.location.href = '../../diseño/GestionPersonajes/eliminarPersonajes.html';
    });

    modificarPersonaje.addEventListener('click', function() {
        window.location.href = '../../diseño/GestionPersonajes/modificarPersonajes.html';
    });

    listarPersonaje.addEventListener('click', function() {
        window.location.href = '../../diseño/GestionPersonajes/listarPersonajes.html';
    });

    recuperarPersonaje.addEventListener('click', function() {
        window.location.href = '../../diseño/GestionPersonajes/recuperarPersonaje.html';
    });

    luis.addEventListener('click', function() {
        window.location.href = '../../diseño/GestionPersonajes/modificarParte2.html';
    });

    martina.addEventListener('click', function() {
        window.location.href = '../../diseño/GestionPersonajes/modificarParte2.html';
    });

});