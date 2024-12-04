<?php
    class MPersonaje {
        private $conexion;

        public function __construct() {
            require_once '../config/config.php';

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

        public function getAllCharacters() {
            $sql = "SELECT idPersonaje, nombre, urlImagen FROM Personaje";
            $resultado = $this->conexion->prepare($sql);
            $resultado->execute();
        
            return $resultado;
        }
        
        public function getInfoviewModify($id) {
            $sql = 'SELECT * FROM Personaje WHERE idPersonaje = :id';
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
        
            return $resultado->fetch(PDO::FETCH_ASSOC); // Devuelve un array asociativo.
        }

        public function modifyCharacter($id, $name, $age, $gender, $description, $img) {
            $sql = "UPDATE Personaje SET 
                        nombre = :name, 
                        edad = :age, 
                        genero = :gender, 
                        descripcion = :description, 
                        urlImagen = :img WHERE idPersonaje = :id";
        
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->bindParam(':name', $name);
            $resultado->bindParam(':age', $age);
            $resultado->bindParam(':gender', $gender);
            $resultado->bindParam(':description', $description);
            $resultado->bindParam(':img', $img);
        
            return $resultado->execute();
        }
    }
?>