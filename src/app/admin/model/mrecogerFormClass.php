<?php
    class MRecogerFormClass {
        private $mysqli;

        public function __construct(){
            require_once("../config/config_db.php");
            $this->mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
        }

        public function subirImagen($ambito, $img){
            $directorio = "../assets/img/";
            $rutaImg = $directorio . basename($img); // Se utiliza para obtener solo el nombre del archivo sin la ruta completa

            // Mueve el archivo subido al directorio especificado
            if (move_uploaded_file($_FILES['img']['tmp_name'], $rutaImg)) { 
                $consulta = "INSERT INTO Escenario (ambito, rutaImagen) VALUES ('".$ambito."','".$rutaImg."');";
        
                $resultado = $this->mysqli->query($consulta);
                
                return $resultado;
    
            } else {
               return false;
            }
        }
    }
?>