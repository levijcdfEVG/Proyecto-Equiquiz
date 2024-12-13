<?php
    require_once("../controller/cAñadirMapa.php");
    $objcAñadirMapa = new CAñadirMapa();

    $resultado = $objcAñadirMapa->cSubirImagen();
    require_once("../view/formResultado.php");
?>