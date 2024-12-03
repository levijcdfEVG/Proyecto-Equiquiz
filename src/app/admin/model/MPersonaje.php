<?php
    class MPersonaje {
        private $conexion;
        private $nombrePersonaje;
        private $edad;
        private $genero;
        private $descripcion;
        private $urlImagen;

        public function __construct() {
            require_once 'src/app/config/config.php';

            $this->urlImagen = RUTAIMAGENESADMIN;
            
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

        public function añadirPersonaje() {
            
        }
    }
?>