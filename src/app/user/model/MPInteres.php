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

        public function getQuestion() {
            $sql = "SELECT * FROM pregunta";
            $query = $this->conexion->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>