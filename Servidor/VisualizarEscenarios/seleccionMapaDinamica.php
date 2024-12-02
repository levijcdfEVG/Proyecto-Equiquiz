<!-- Levi Josué Candeias de Figueiredo -->
<?php
    require_once("../Config/config_db.php");
    require_once("buscarImg.php");

    $mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    $objBuscarImg = new BuscarImg($mysqli);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="../../src/css/mainMenu.css" rel="stylesheet" />
        <link href="../../src/css/reset.css" rel="stylesheet" />
        <link rel="icon" href="../../src/img/icon.png" />
        <title>EquiQuiz - Selección de Escenarios</title>
    </head>
    <body>
        <header>
            <h1 class="irish-grover-regular">EquiQuiz</h1>
        </header>
        <section id="seleccionEscenarios">
            <h2 class="irish-grover-regular">Selecciona tu Escenario</h2>
            <div class="escenarios">
                <div class="escenario">
                    <?php
                        //Enlace a obtenerRuta.php con el parámetro 'ambito' en cada caso igualado al que corresponde
                        echo '<a href="obtenerRuta.php?ambito=educacion"><img src="../../src/img/EscenarioEducacion.png" alt="Escenario 1"></a>'
                    ?>
                    <p>Escenario Educacion</p>
                </div>
                <div class="escenario">
                    <?php
                        echo '<a href="obtenerRuta.php?ambito=empleo"><img src="../../src/img/EscenarioLaboral.png" alt="Escenario 2"></a>'
                    ?>
                    <p>Escenario Laboral</p>
                </div>
                <div class="escenario">
                    <?php
                        echo '<a href="obtenerRuta.php?ambito=salud"><img src="../../src/img/EscenarioSalud.jpeg" alt="Escenario 3"></a>'
                    ?>
                    <p>Escenario Salud</p>
                </div>
            </div>
            <button class="volverBtnRanking irish-grover-regular">Volver</button>
        </section>
    </body>
</html>
