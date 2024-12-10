<?php
    require_once("../../admin/config/config_db.php");

    class MBuscarImg {
        private $mysqli;

        public function __construct($mysqli) {
            $this->mysqli = $mysqli;
        }

        public function eleccionEscenario($ambito) { 
            //Consulta para obtener la ruta de la imagen según el ambito que recibimos por parámetro   
            $consulta = "SELECT rutaImagen FROM Escenarios WHERE ambito='$ambito';";
            $resultado = $this->mysqli->query($consulta);

             //Obtiene la fila del resultado
            $fila = $resultado->fetch_assoc();

            //Retorna la ruta de la imagen
            return $fila["rutaImagen"];

        }
    }

?>