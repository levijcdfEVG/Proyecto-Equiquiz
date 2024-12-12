<?php
    class MAdministrador {
        private $conexion;

        public function __construct() {
            require_once '../src/app/config/configdDb.php';
            try{
                //Conexion por PDO.
                $this->conexion = new PDO(DSN,USUARIO,PASSWORD);

                // Configuración de PDO.
                // Para que pueda lanzar excepciones.
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                die;
            }
        }
    }
?>