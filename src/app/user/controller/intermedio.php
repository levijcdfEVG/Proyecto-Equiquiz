<?php
    require_once("../controller/cObtenerRuta.php");

    $objCObtenerRuta = new CObtenerRuta();
    $objCObtenerRuta -> cRuta($_GET["ambito"]);
    require_once("../view/visualizarFondo.php");

?>