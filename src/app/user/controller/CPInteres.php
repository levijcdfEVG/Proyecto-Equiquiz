<?php
    class CPInteres {
        private $MPInteres;

        public function __construct() {
            require_once '../config/config.php';
            require_once '../model/MPInteres.php';
            $this->MPInteres = new MPInteres();
        }

        public function getQuestion($idEscenario) {
            return $this->MPInteres->getQuestion($idEscenario);
        }

        public function registrarPreguntaTemporal($idPregunta, $idEscenario) {
            $this->MPInteres->registrarPreguntaTemporal($idPregunta, $idEscenario);
        }
    }
?>
