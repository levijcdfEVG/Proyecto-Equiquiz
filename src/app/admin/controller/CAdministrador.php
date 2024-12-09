<?php
    class CAdministrador {
        private $MAdministrador;
        public $view;
        public $title;

        public function __construct() {
            require_once '../config/config.php';
            // Requerimos de la clase del modelo.
            require_once RUTA.'admin/model/MAdministrador.php';
            $this->MAdministrador = new MAdministrador();
        }
        public function view() {
            $this->view = 'panelAdmin.php';
            $this->title = 'Panel de Administrador';
        }
    }
?>