<?php

    class CObtenerRuta{
        private $objBuscarFondo;

        public function __construct() {
            require_once("../model/mBuscarImg.php");
            require_once("../../admin/config/config_db.php");
            $mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
            $this->objBuscarFondo = new MBuscarImg($mysqli);
        }

        public function cRuta() {
            // Llamar al método eleccionEscenario para obtener la ruta de la imagen según el ámbito  
            $rutaImg = $this->objBuscarFondo->eleccionEscenario($_GET['ambito']);
    
            // Verificar si se obtuvo una ruta válida
            if ($rutaImg) {
                // Redirige a la página visualizarFondo pasando la ruta de la imagen como parámetro
                header('Location: ./visualizarFondo.php?rutaImg=' . $rutaImg);
                exit();
            } else {
                // Manejar el caso en que no se encontró una imagen
                return "No se encontró una imagen para el ámbito especificado.";
            }
        }
    }
    
?>