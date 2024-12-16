<?php
    require_once '../config/config.php';
    require_once 'CRanking.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['nombreJugador']) && isset($_POST['puntuacion'])) {
            $nombre = $_POST['nombreJugador'];
            $puntuacion = $_POST['puntuacion'];

            $objCRanking = new CRanking();

            $objCRanking->addPuntuacion($nombre, $puntuacion);
            header('location: ../view/js/menu/mainMenu.php');
        }else{
        }
    }