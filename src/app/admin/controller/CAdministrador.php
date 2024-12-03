<?php
    class CAdministrador {
        private $MAdministrador;
        public $vista;

        public function __construct() {
            require_once 'src/app/config/config.php';
            // Requerimos de la clase del modelo.
            require_once RUTA.'admin/model/MAdministrador.php';
            $this->MAdministrador = new MAdministrador();
        }
        public function viewPanelAdmin() {
            $this->vista = RUTA.'admin/view/panelAdmin.html';
        }
    }
?>