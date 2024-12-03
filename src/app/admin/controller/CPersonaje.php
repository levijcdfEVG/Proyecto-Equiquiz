<?php
    class CPersonaje {
        private $MPersonaje;

        public function __construct() {
            require_once 'src/app/config/config.php';
            // Requerimos de la clase del modelo.
            require_once RUTA.'admin/model/MPersonaje.php';
            $this->MPersonaje = new MPersonaje();
        }
        public function añadirPersonaje() {
            return $this->MPersonaje->añadirPersonaje();
        }
    }
?>