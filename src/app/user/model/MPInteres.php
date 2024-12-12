<?php
    class MPInteres {

        private $conexion;

        /**
         * Summary of __construct
         * El constructor inicializa la conexion para poder ser usada y activa los errores.
         * La conexion se hace mediante PDO.
         */
        public function __construct() {
            require_once 'config/config.php';

            try{
                require_once 'config/configDb.php';
                $this->conexion = new PDO(DSN,USUARIO,PASSWORD);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch (PDOException $e){
                die;
            }
        }

        public function getQuestion($idEscenario) {
            $sql = 'SELECT
                        Pregunta.idPregunta AS idPregunta,
                        contenido_P AS Pregunta,
                        idOpcion AS idOpcion,
                        contenidos AS Opcion,
                        esCorrecto AS Correcto
                        FROM Pregunta JOIN Opciones ON Pregunta.idPregunta = Opciones.idPregunta
                        WHERE idEscenario = :idEscenario';
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario);
            $resultado->execute();
            return $resultado;
        }
    }
?>