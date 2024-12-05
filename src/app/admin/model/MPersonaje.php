<?php
    class MPersonaje {

        private $conexion;

        /**
         * Summary of __construct
         * El constructor inicializa la conexion para poder ser usada y activa los errores.
         * La conexion se hace mediante PDO.
         */
        public function __construct() {
            require_once '../config/config.php';

            try{
                require_once '../config/configDb.php';
                $this->conexion = new PDO(DSN,USUARIO,PASSWORD);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                die;
            }
        }

        /**
         * Summary of addCharacter
         * 
         * Metodo para insertar un personaje en la base de datos.
         * @param mixed $name Nombre del Personaje a añadir.
         * @param mixed $age Edad del Personaje a añadir.
         * @param mixed $gender Genero del Personaje a añadir.
         * @param mixed $description Descripcion del Personaje a añadir.
         * @param mixed $img Imagen del Personaja a añadir -> Es la ruta realmente.
         * @return bool Devuelve si la consulta a sido correcta.
         */
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

        /**
         * Summary of getAllCharacters
         * 
         * Metodo que hace una consulta para obtener todo los personajes de la base de datos
         * @return bool|PDOStatement Devuelve un objeto con todos los personajes de la base de datos.
         */
        public function getAllCharacters() {
            $sql = "SELECT idPersonaje, nombre, urlImagen FROM Personaje";
            $resultado = $this->conexion->prepare($sql);
            $resultado->execute();
        
            return $resultado;
        }

        public function getAllOldCharacters() {
            $sql = "SELECT idPersonaje, nombre, urlImagen FROM Old_Personaje";
            $resultado = $this->conexion->prepare($sql);
            $resultado->execute();
        
            return $resultado;
        }
        
        /**
         * Summary of getInfoviewModify
         * 
         * Metodo para obtener datos de un personaje que quiere ser modificado.
         * @param mixed $id Recibe el id del personaje que se quiere modificar.
         * @return mixed Retorna un array asociativo con los datos de dicho personaje.
         */
        public function getInfoviewModify($id) {
            $sql = 'SELECT * FROM Personaje WHERE idPersonaje = :id';
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado->execute();
        
            return $resultado->fetch(PDO::FETCH_ASSOC); // Devuelve un array asociativo.
        }

        /**
         * Summary of modifyCharacter
         * 
         * Metodo para modificar a un personaje.
         * @param mixed $id Recibe el id del personaje a modificar.
         * @param mixed $name Recibe el nombre del personaje a modificar.
         * @param mixed $age Recibe la edad del personaje a modificar. Puede ser null al no ser rellenado. Se guardara un O.
         * @param mixed $gender Recibe el genero del personaje a modificar.
         * @param mixed $description Recibe la descripcion del personaje a modificar.
         * @param mixed $img Recibe la url mas el nombre unico que se le da a la imagen del personaje a modificar.
         * @return bool Retorna si la consulta fue correcta o no.
         */
        public function modifyCharacter($id, $name, $age, $gender, $description, $img) {
            $sql = "UPDATE Personaje SET 
                        nombre = :name, 
                        edad = :age, 
                        genero = :gender, 
                        descripcion = :description, 
                        urlImagen = :img WHERE idPersonaje = :id";
        
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT); //Parsea el parametro a numero entero.
            $resultado->bindParam(':name', $name);
            $resultado->bindParam(':age', $age);
            $resultado->bindParam(':gender', $gender);
            $resultado->bindParam(':description', $description);
            $resultado->bindParam(':img', $img);
        
            return $resultado->execute();
        }

        public function deleteCharacter($id) {

            $data = $this->getInfoviewModify($id);
        
            if ($data) {
                $this->moveCharacter($data['nombre'], $data['edad'], $data['genero'], $data['descripcion'], $data['urlImagen']);
        
                $sql = 'DELETE FROM Personaje WHERE idPersonaje = :id';
                $resultado = $this->conexion->prepare($sql);
                $resultado->bindParam(':id', $id, PDO::PARAM_INT);
        
                return $resultado->execute();
            }
        }
        
        /**
         * Summary of moveCharacter
         * 
         * Método para mover el personaje eliminado a la tabla de personajes antiguos.
         * @param mixed $name Nombre del personaje.
         * @param mixed $age Edad del personaje.
         * @param mixed $gender Genero del personaje.
         * @param mixed $description Descripcion del personaje.
         * @param mixed $img Ruta + nombre de la imagen.
         * @return bool Devuelve si la consulta ha sido correcta.
         */
        public function moveCharacter($name, $age, $gender, $description, $img) {
            $sql = "INSERT INTO Old_Personaje (nombre, edad, genero, descripcion, urlImagen) 
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