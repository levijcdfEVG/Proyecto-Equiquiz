<?php
    class MPInteres {

        private $conexion;

        public function __construct() {
            require_once '../config/config.php';

            try {
                require_once '../config/configDb.php';
                $this->conexion = new PDO(DSN, USUARIO, PASSWORD);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Crear la tabla temporal al iniciar la conexión
                $this->crearTablaTemporal();
            } catch (PDOException $e) {
                die;
            }
        }

        /**
         * Crea una tabla temporal para registrar las preguntas mostradas.
         */
        private function crearTablaTemporal() {
            $sql = '
                CREATE TEMPORARY TABLE IF NOT EXISTS PreguntasPartida (
                    idPregunta SMALLINT UNSIGNED NOT NULL,
                    idEscenario TINYINT UNSIGNED NOT NULL,
                    PRIMARY KEY (idPregunta, idEscenario)
                )
            ';
            $this->conexion->exec($sql);
        }

        /**
         * Obtiene una pregunta aleatoria que no haya sido mostrada previamente.
         */
        public function getQuestion($idEscenario) {
            $sql = '
                SELECT
                    Pregunta.idPregunta AS idPregunta,
                    contenido_P AS Pregunta,
                    idOpcion AS idOpcion,
                    contenidos AS Opcion,
                    esCorrecto AS Correcto
                FROM Pregunta
                JOIN Opciones ON Pregunta.idPregunta = Opciones.idPregunta
                WHERE idEscenario = :idEscenario
                AND Pregunta.idPregunta NOT IN (
                    SELECT idPregunta FROM PreguntasPartida
                )
                ORDER BY RAND()
            ';
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario);
            $resultado->execute();
            return $resultado;
        }

        /**
         * Registra una pregunta como mostrada en la tabla temporal.
         */
        public function registrarPreguntaTemporal($idPregunta, $idEscenario) {
            $sql = '
                INSERT INTO PreguntasPartida (idPregunta, idEscenario)
                VALUES (:idPregunta, :idEscenario)
            ';
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idPregunta', $idPregunta);
            $resultado->bindParam(':idEscenario', $idEscenario);
            $resultado->execute();
        }
    }
?>
