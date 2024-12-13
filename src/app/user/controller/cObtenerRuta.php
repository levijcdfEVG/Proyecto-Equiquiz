<?php

    class CObtenerRuta{
        private $objBuscarFondo;

        public function __construct() {
            require_once("../model/mBuscarImg.php");
            $this->objBuscarFondo = new MBuscarImg();
        }

        public function cRuta($ambito) {
            // Llamar al método eleccionEscenario para obtener la ruta de la imagen según el ámbito  
            $rutaImg = $this->objBuscarFondo->eleccionEscenario($ambito);
    
            // Verificar si se obtuvo una ruta válida
            if ($rutaImg) {
                // Redirige a la página visualizarFondo pasando la ruta de la imagen como parámetro
                header('Location: ../view/visualizarFondo.php?rutaImg=' . $rutaImg);
                exit();
            } else {
                // Manejar el caso en que no se encontró una imagen
                return "No se encontró una imagen para el ámbito especificado.";
            } 
        }
        
    }
    
?>

