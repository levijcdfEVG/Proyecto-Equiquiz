<?php
    class CPInteres {
        private $MPInteres;

        /**
         * Summary of __construct
         * 
         * En el constructor se inicializa el modelo de los puntos de interes.
         */
        public function __construct() {
            require_once 'config/config.php';
            // Requerimos de la clase del modelo.
            require_once 'model/MPersonaje.php';
            $this->MPInteres = new MPInteres();
        }

        public function getQuestion() {
            return $this->MPInteres->getQuestion();
        }
    }
?>