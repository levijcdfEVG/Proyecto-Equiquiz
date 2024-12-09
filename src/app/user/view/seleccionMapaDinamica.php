<!-- Levi Josué Candeias de Figueiredo -->
<?php
    require_once("../controller/cObtenerRuta.php");
    $obtenerRuta = new CObtenerRuta();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="../assets/css/mainMenu.css" rel="stylesheet" />
        <link href="../assets/css/reset.css" rel="stylesheet" />
        <link rel="icon" href="../assets/img/icon.png" />
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
                        echo '<a href="cObtenerRuta.php?ambito=educacion"><img src="../assets/img/EscenarioEducacion.png" alt="Escenario 1"></a>'
                    ?>
                    <p>Escenario Educacion</p>
                </div>
                <div class="escenario">
                    <?php
                        echo '<a href="cObtenerRuta.php?ambito=empleo"><img src="../assets/img/EscenarioLaboral.png" alt="Escenario 2"></a>'
                    ?>
                    <p>Escenario Laboral</p>
                </div>
                <div class="escenario">
                    <?php
                        echo '<a href="cObtenerRuta.php?ambito=salud"><img src="../assets/img/EscenarioSalud.jpeg" alt="Escenario 3"></a>'
                    ?>
                    <p>Escenario Salud</p>
                </div>
            </div>
            <button class="volverBtnRanking irish-grover-regular">Volver</button>
        </section>
    </body>
</html>

