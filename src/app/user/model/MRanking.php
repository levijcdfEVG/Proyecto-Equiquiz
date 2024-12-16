<?php
    class MRanking {

        private $conexion;

        public function __construct() {
            require_once '../config/config.php';

            try {
                require_once '../config/configDb.php';
                $this->conexion = new PDO(DSN, USUARIO, PASSWORD);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die;
            }
        }

        public function addPuntuacion($nombreJugador, $puntuacion) {
            $sql = 'INSERT INTO Registro (nombreRegistro, barraPuntuacion, fecha) VALUES (:nombreJugador, :puntuacion, NOW())';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombreJugador', $nombreJugador, PDO::PARAM_STR);
            $stmt->bindParam(':puntuacion', $puntuacion, PDO::PARAM_INT);
            $stmt->execute();
        }

        public function getRanking() {
            $sql = 'SELECT nombreRegistro, barraPuntuacion FROM Registro ORDER BY barraPuntuacion DESC LIMIT 10';
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt;
        }
    }
?>
