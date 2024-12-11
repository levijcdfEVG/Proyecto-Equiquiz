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
        public function listQuestions() {
            try {
                $query = "SELECT 
                            p.idPregunta, 
                            p.contenido_P, 
                            e.ambito, 
                            o.idOpcion, 
                            o.contenidos, 
                            o.esCorrecto 
                          FROM Pregunta p
                          JOIN Escenario e ON p.idEscenario = e.idEscenario
                          LEFT JOIN Opciones o ON p.idPregunta = o.idPregunta
                          ORDER BY p.idPregunta, o.idOpcion";
        
                $stmt = $this->conexion->query($query);
                $preguntas = [];
        
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $preguntas[$row['idPregunta']]['pregunta'] = $row['contenido_P'];
                    $preguntas[$row['idPregunta']]['ambito'] = $row['ambito'];
                    $preguntas[$row['idPregunta']]['opciones'][] = [
                        'idOpcion' => $row['idOpcion'],
                        'contenido' => $row['contenidos'],
                        'esCorrecto' => $row['esCorrecto']
                    ];
                }
        
                return $preguntas;
            } catch (Exception $e) {
                return [];
            }
        }
        
        //ModifyQuestions
        public function modifyQuestion($idPregunta, $contenido, $opciones) {
            try {
                if (count($opciones) < 2 || count($opciones) > 4) {
                    throw new Exception("El número de opciones debe estar entre 2 y 4.");
                }
        
                // Validar que hay exactamente una respuesta correcta
                $numCorrectas = array_sum(array_column($opciones, 'esCorrecto'));
                if ($numCorrectas !== 1) {
                    throw new Exception("Debe haber exactamente una opción correcta.");
                }
        
                $this->conexion->beginTransaction();
        
                // Actualizar la pregunta
                $queryPregunta = "UPDATE Pregunta SET contenido_P = :contenido WHERE idPregunta = :idPregunta";
                $stmtPregunta = $this->conexion->prepare($queryPregunta);
                $stmtPregunta->execute([
                    ':contenido' => $contenido,
                    ':idPregunta' => $idPregunta
                ]);
        
                // Eliminar opciones antiguas
                $queryDeleteOpciones = "DELETE FROM Opciones WHERE idPregunta = :idPregunta";
                $stmtDeleteOpciones = $this->conexion->prepare($queryDeleteOpciones);
                $stmtDeleteOpciones->execute([':idPregunta' => $idPregunta]);
        
                // Insertar opciones nuevas
                $queryOpciones = "INSERT INTO Opciones (contenidos, esCorrecto, idPregunta) VALUES (:contenidos, :esCorrecto, :idPregunta)";
                $stmtOpciones = $this->conexion->prepare($queryOpciones);
        
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
        
        //DeleteQuestions
        public function deleteQuestion($idPregunta) {
            try {
                $query = "DELETE FROM Pregunta WHERE idPregunta = :idPregunta";
                $stmt = $this->conexion->prepare($query);
                $stmt->execute([':idPregunta' => $idPregunta]);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        

    }