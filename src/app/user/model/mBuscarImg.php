<?php

    class MBuscarImg {
        private $mysqli;

        public function __construct( ) {
            require_once("../../admin/config/config_db.php");
            $this->mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
        }

        public function eleccionEscenario($ambito) { 
            //Consulta para obtener la ruta de la imagen según el ambito que recibimos por parámetro   
            $consulta = "SELECT rutaImagen FROM Escenario WHERE ambito='$ambito';";
            $resultado = $this->mysqli->query($consulta);

             //Obtiene la fila del resultado
            $fila = $resultado->fetch_assoc();

            //Retorna la ruta de la imagen
            return $fila["rutaImagen"];

        }
    }

?>