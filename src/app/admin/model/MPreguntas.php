<?php

    class MPreguntas {

        private $conexion; //Objeto de la clase PDO para poder interactuar con la base de datos


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



        //AddQuestions
        public function addQuestion($contenido, $idEscenario, $opciones) {
            try {
                if (count($opciones) < 2 || count($opciones) > 4) {
                    throw new Exception("El número de opciones debe estar entre 2 y 4.");
                }
        
                $this->conexion->beginTransaction();
        
                // Insertar la pregunta
                $query = "INSERT INTO Pregunta (contenido_P, idEscenario) VALUES (:contenido, :idEscenario)";
                $stmt = $this->conexion->prepare($query);
                $stmt->execute([
                    ':contenido' => $contenido,
                    ':idEscenario' => $idEscenario
                ]);
        
                $idPregunta = $this->conexion->lastInsertId();
        
                // Insertar las opciones
                $queryOpciones = "INSERT INTO Opciones (contenidos, esCorrecto, idPregunta) VALUES (:contenidos, :esCorrecto, :idPregunta)";
                $stmtOpciones = $this->conexion->prepare($queryOpciones);
                
                //Se utiliza un foreach para poder recorrer todas las opciones creadas desde el front para poder insertarlas todas
                foreach ($opciones as $opcion) {
                    $stmtOpciones->execute([
                        ':contenidos' => $opcion['contenido'],
                        ':esCorrecto' => $opcion['esCorrecto'],
                        ':idPregunta' => $idPregunta
                    ]);
                }
        
                $this->conexion->commit();
                return true;
            } catch (Exception $e) {
                $this->conexion->rollBack();
                return false;
            }
        }
        
        //ListQuestions

        //ModifyQuestions

        //DeleteQuestions

    }