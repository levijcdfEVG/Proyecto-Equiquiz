<?php
    class MPersonaje {
        private $conexion;
        private $nombrePersonaje;
        private $edad;
        private $genero;
        private $descripcion;
        private $urlImagen;

        public function __construct() {
            require_once '../config/config.php';

            $this->urlImagen = PATHIMGADMIN;
            
            try{
                require_once '../config/configDb.php';
                //Conexion por PDO.
                $this->conexion = new PDO(DSN,USUARIO,PASSWORD);

                // Configuración de PDO.
                // Para que pueda lanzar excepciones.
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                die;
            }
        }

        public function addCharacter($name, $age, $gender, $description, $img) {
            $sql = "INSERT INTO Personaje (nombre, edad, genero, descripcion, urlImagen) 
                VALUES (:name, :age, :gender, :description, :img)";
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':name', $name);
            $resultado->bindParam(':age', $age);
            $resultado->bindParam(':gender', $gender);
            $resultado->bindParam(':description', $description);
            $resultado->bindParam(':img', $img);
            return $resultado->execute();
        }
    }
?>