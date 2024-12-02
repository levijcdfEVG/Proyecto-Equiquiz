<?php
    require_once("./buscarImg.php");
    require_once("../Config/config_db.php");

    $mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    $objEleccionImg = new BuscarImg($mysqli);

    //Llamar al método eleccionEscenario para obtener la ruta de la imagen según el ámbito  
    $rutaImg = $objEleccionImg->eleccionEscenario($_GET['ambito']);

    //Redirige a la página visualizarFondo pasando la ruta de la imagen como parámetro
    header('Location:./visualizarFondo.php?rutaImg='.$rutaImg);
?>