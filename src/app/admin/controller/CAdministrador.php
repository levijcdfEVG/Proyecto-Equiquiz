<?php
    class CAdministrador {
        private $MAdministrador;
        public $vista;
        public $title;

        public function __construct() {
            require_once '../config/config.php';
            // Requerimos de la clase del modelo.
            require_once RUTA.'admin/model/MAdministrador.php';
            $this->MAdministrador = new MAdministrador();
        }
        public function view() {
            $this->vista = 'panelAdmin.php';
            $this->title = 'Panel de Administrador';
        }
    }
?>