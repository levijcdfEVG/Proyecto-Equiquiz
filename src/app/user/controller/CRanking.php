<?php
    class CRanking {
        private $MRanking;

        public function __construct() {
            require_once __DIR__ . '/../model/MRanking.php';
            
            $this->MRanking = new MRanking();
        }

        public function addPuntuacion($nombre, $puntuacion) {
            $this->MRanking->addPuntuacion($nombre, $puntuacion);
        }

        public function getRanking() {
            return $this->MRanking->getRanking();
        }
    }
?>
