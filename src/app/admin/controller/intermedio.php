<?php
    require_once("../controller/cAñadirMapa.php");
    $objcAñadirMapa = new CAñadirMapa();
    $resultado = $objcAñadirMapa->cSubirImagen($_FILES["img"], $_POST["ambito"]);
    require_once("../view/formResultado.php");
?>