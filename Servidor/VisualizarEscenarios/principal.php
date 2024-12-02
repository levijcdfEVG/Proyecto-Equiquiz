<?php
    require_once("config_db.php");
    require_once("buscarImg.php");

    $mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    $objBuscarImg = new BuscarImg($mysqli);
    // $rutaImagen = $objBuscarImg->eleccionEscenario(); // Línea eliminada

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Estilos locales -->
        <link href="../../src/css/reset.css" rel="stylesheet" />
        <link href="../../src/css/mainMenu.css" rel="stylesheet" />
        <link rel="icon" href="../../src/img/icon.png" />
        <title>EquiQuiz</title>
    </head>
    <body>
        <header>
            <h1 class="irish-grover-regular">EquiQuiz</h1>
        </header>
        <!-- Seccion Principal del menu -->
        <main id="contenedorBotones">
            <!-- Primera fila: Historia y Jugar -->
            <div class="fila-arriba">
                <button class="irish-grover-regular" id="botonHistoria">Historia</button>
                <button class="irish-grover-regular" id="botonJugar" disabled>Jugar</button>
            </div>
            <!-- Segunda fila: Ranking -->
            <div class="fila-abajo">
                <button class="irish-grover-regular" id="botonRanking">Ranking</button>
            </div>
        </main>

        <!-- Sección Historia -->
        <section class="irish-grover-regular" id="historiaCard">
            <h2 >Historia</h2>
            <div class="personajes">
                <div class="personaje">
                    <img src="assets/img/luis.png" alt="Luis">
                    <br><button class="personaje-btn irish-grover-regular" data-personaje="luis">Luis</button>
                </div>
                <div class="personaje">
                    <img src="assets/img/ana.png" alt="Ana">
                    <br><button class="personaje-btn irish-grover-regular" data-personaje="ana">Ana</button>
                </div>
                <div class="personaje">
                    <img src="assets/img/martina.png" alt="Martina">
                    <br><button class="personaje-btn irish-grover-regular" data-personaje="martina">Martina</button>
                </div>
            </div>
            <button class="volverBtnRanking irish-grover-regular">Volver</button>
        </section>
        
        <!-- Subseccion de cada personaje -->
        <section class="irish-grover-regular" id="descripcionPersonaje">
            <h2>Descripción</h2>
            <div class="contenedor-descripcion">
                <div class="personaje-descripcion">
                    <img src="assets/img/luis.png" id="imagenPersonaje" />
                    <p id="nombrePersonaje"></p>
                </div>
                <div class="descripcion-texto">
                    <p id="textoDescripcion"></p>
                    <div class="audio-descripcion">
                        <button id="botonAudio">
                            <img src="assets/img/icono-audio.png" alt="Audio" />
                        </button>
                    </div>
                </div>
            </div>
            <button id="volverBtnDescripcion" class="irish-grover-regular">Volver</button>
        </section>
        
        <!-- Sección Ranking -->
        <section  class="irish-grover-regular" id="rankingCard">
            <h2>Ranking</h2>
            <table class="tabla-ranking">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Nombre</th>
                        <th>Puntuación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Zeus</td>
                        <td>3800</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Maria</td>
                        <td>3700</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Levi</td>
                        <td>3600</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Botello</td>
                        <td>3500</td>
                    </tr>
                </tbody>
            </table>
            <button class="volverBtnRanking">Volver</button>
        </section>

        <!-- Seleccion de Escenario -->
        <section id="seleccionEscenarios">
            <h2 class="irish-grover-regular">Selecciona tu Escenario</h2>
            <div class="escenarios">
                <div class="escenario">
                    <?php
                        //Enlace a obtenerRuta.php con el parámetro 'ambito' en cada caso igualado al que corresponde
                        echo '<a href="obtenerRuta.php?ambito=educacion"><img src="assets/img/EscenarioEducacion.png" alt="Escenario 1"></a>'
                    ?>
                    <p>Escenario Educacion</p>
                </div>
                <div class="escenario">
                    <?php
                        echo '<a href="obtenerRuta.php?ambito=laboral"><img src="assets/img/EscenarioLaboral.png" alt="Escenario 2"></a>'
                    ?>
                    <p>Escenario Laboral</p>
                </div>
                <div class="escenario">
                    <?php
                        echo '<a href="obtenerRuta.php?ambito=salud"><img src="assets/img/EscenarioSalud.jpeg" alt="Escenario 3"></a>'
                    ?>
                    <p>Escenario Salud</p>
                </div>
            </div>
            <button class="volverBtnRanking irish-grover-regular">Volver</button>
        </section>
        
        <!-- Scripts para manejar el menu -->
        <script src="assets/js/activarJugar.js" type="text/javascript"></script>
        <script src="assets/js/gestionarMenus.js" type="text/javascript"></script>
    </body>
</html>
