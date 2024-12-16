<?php
    require_once '../../../controller/CRanking.php';

    $objCRanking = new CRanking();
    $stmt = $objCRanking->getRanking();
    $ranking = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Estilos locales -->
        <link href="../../../assets/css/mainMenu.css" rel="stylesheet" />
        <link href="../../../assets/css/reset.css" rel="stylesheet" />
        <link rel="icon" href="../../../assets/img/icon.png" />
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
                    <img src="../../../assets/img/luis.png" alt="Luis">
                    <br><button class="personaje-btn irish-grover-regular" data-personaje="luis">Luis</button>
                </div>
                <div class="personaje">
                    <img src="../../../assets/img/ana.png" alt="Ana">
                    <br><button class="personaje-btn irish-grover-regular" data-personaje="ana">Ana</button>
                </div>
                <div class="personaje">
                    <img src="../../../assets/img/martina.png" alt="Martina">
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
                    <img src="../../../assets/img/luis.png" id="imagenPersonaje" />
                    <p id="nombrePersonaje"></p>
                </div>
                <div class="descripcion-texto">
                    <p id="textoDescripcion"></p>
                    <div class="audio-descripcion">
                        <button id="botonAudio">
                            <img src="../../../assets/img/icono-audio.png" alt="Audio" />
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
                    <?php
                        $posicion = 1;
                        foreach ($ranking as $jugador) {
                            echo "<tr>";
                            echo "<td>$posicion</td>";
                            echo "<td>{$jugador['nombre']}</td>";
                            echo "<td>{$jugador['puntuacion']}</td>";
                            echo "</tr>";
                            $posicion++;
                        }
                    ?>
                </tbody>
            </table>
            <button class="volverBtnRanking">Volver</button>
        </section>

        <!-- Seleccion de Escenario -->
        <section id="seleccionEscenarios">
            <h2 class="irish-grover-regular">Selecciona tu Escenario</h2>
            <div class="escenarios">
                <div class="escenario">
                    <img src="../../../assets/img/Educacion.png" alt="Escenario 1" id="educacion">
                    <p>Escenario Educacion</p>
                </div>
                <div class="escenario laboral">
                    <img src="../../../assets/img/laboral.png" alt="Escenario 2" id="laboral">
                    <p>Escenario Laboral</p>
                </div>
                <div class="escenario salud">
                    <img src="../../../assets/img/salud.png" alt="Escenario 3" id="salud">
                    <p>Escenario Salud</p>
                </div>
            </div>
            <button class="volverBtnRanking irish-grover-regular">Volver</button>
        </section>
        
        <!-- Scripts para manejar el menu -->
        <script src="activarJugar.js" type="text/javascript"></script>
        <script src="gestionarMenus.js" type="text/javascript"></script>
    </body>
</html>
