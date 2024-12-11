<?php

/**
 * Clase MPreguntas
 * Esta clase maneja las operaciones relacionadas con preguntas y opciones en una aplicación de cuestionarios.
 */
class MPreguntas {

    /**
     * @var PDO $conexion La instancia de PDO para la interacción con la base de datos.
     */
    private $conexion;

    /**
     * Constructor de MPreguntas.
     * Inicializa la conexión a la base de datos usando PDO y establece el modo de error a excepción.
     */
    public function __construct() {
        require_once '../config/config.php';

        try {
            require_once '../config/configDb.php';
            // Crear una nueva instancia de PDO para la conexión a la base de datos
            $this->conexion = new PDO(DSN, USUARIO, PASSWORD);
            // Establecer el modo de error de PDO a excepción
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die;
        }
    }

    /**
     * Añade una nueva pregunta junto con sus opciones a la base de datos.
     *
     * @param string $contenido El contenido de la pregunta.
     * @param int $idEscenario El ID del escenario al que pertenece la pregunta.
     * @param array $opciones Un array de opciones, cada una contiene 'contenido' y 'esCorrecto'.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     * @throws Exception Si el número de opciones no está entre 2 y 4.
     */
    public function addQuestion($contenido, $idEscenario, $opciones) {
        try {
            // Validar el número de opciones
            if (count($opciones) < 2 || count($opciones) > 4) {
                throw new Exception("El número de opciones debe estar entre 2 y 4.");
            }

            // Iniciar una transacción
            $this->conexion->beginTransaction();

            // Insertar la pregunta en la base de datos
            $query = "INSERT INTO Pregunta (contenido_P, idEscenario) VALUES (:contenido, :idEscenario)";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([
                ':contenido' => $contenido,
                ':idEscenario' => $idEscenario
            ]);

            // Obtener el ID de la pregunta recién insertada
            $idPregunta = $this->conexion->lastInsertId();

            // Insertar las opciones en la base de datos
            $queryOpciones = "INSERT INTO Opciones (contenidos, esCorrecto, idPregunta) VALUES (:contenidos, :esCorrecto, :idPregunta)";
            $stmtOpciones = $this->conexion->prepare($queryOpciones);

            // Recorrer todas las opciones y ejecutarlas
            foreach ($opciones as $opcion) {
                $stmtOpciones->execute([
                    ':contenidos' => $opcion['contenido'],
                    ':esCorrecto' => $opcion['esCorrecto'],
                    ':idPregunta' => $idPregunta
                ]);
            }

            // Confirmar la transacción
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->conexion->rollBack();
            return false;
        }
    }

    /**
     * Lista todas las preguntas junto con sus opciones.
     *
     * @return array Un array asociativo de preguntas con sus opciones.
     */
    public function listQuestions() {
        try {
            $query = "SELECT 
                        p.idPregunta, 
                        p.contenido_P 
                      FROM Pregunta p
                      LEFT JOIN Opciones o ON p.idPregunta = o.idPregunta
                      ORDER BY p.idPregunta";

            $stmt = $this->conexion->query($query);
            $preguntas = [];

            // Recorrer los resultados y organizar las preguntas y opciones
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $preguntas[$row['idPregunta']]['pregunta'] = $row['contenido_P'];
            }

            return $preguntas;
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Modifica una pregunta existente junto con sus opciones.
     *
     * @param int $idPregunta El ID de la pregunta a modificar.
     * @param string $contenido El nuevo contenido de la pregunta.
     * @param array $opciones Un array de nuevas opciones, cada una contiene 'contenido' y 'esCorrecto'.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     * @throws Exception Si el número de opciones no está entre 2 y 4 o si no hay exactamente una opción correcta.
     */
    public function modifyQuestion($idPregunta, $contenido, $opciones) {
        try {
            // Validar el número de opciones
            if (count($opciones) < 2 || count($opciones) > 4) {
                throw new Exception("El número de opciones debe estar entre 2 y 4.");
            }

            // Validar que hay exactamente una respuesta correcta
            $numCorrectas = array_sum(array_column($opciones, 'esCorrecto'));
            if ($numCorrectas !== 1) {
                throw new Exception("Debe haber exactamente una opción correcta.");
            }

            // Iniciar una transacción
            $this->conexion->beginTransaction();

            // Actualizar el contenido de la pregunta
            $queryPregunta = "UPDATE Pregunta SET contenido_P = :contenido WHERE idPregunta = :idPregunta";
            $stmtPregunta = $this->conexion->prepare($queryPregunta);
            $stmtPregunta->execute([
                ':contenido' => $contenido,
                ':idPregunta' => $idPregunta
            ]);

            // Eliminar las opciones antiguas
            $queryDeleteOpciones = "DELETE FROM Opciones WHERE idPregunta = :idPregunta";
            $stmtDeleteOpciones = $this->conexion->prepare($queryDeleteOpciones);
            $stmtDeleteOpciones->execute([':idPregunta' => $idPregunta]);

            // Insertar las nuevas opciones
            $queryOpciones = "INSERT INTO Opciones (contenidos, esCorrecto, idPregunta) VALUES (:contenidos, :esCorrecto, :idPregunta)";
            $stmtOpciones = $this->conexion->prepare($queryOpciones);

            // Recorrer todas las opciones y ejecutarlas
            foreach ($opciones as $opcion) {
                $stmtOpciones->execute([
                    ':contenidos' => $opcion['contenido'],
                    ':esCorrecto' => $opcion['esCorrecto'],
                    ':idPregunta' => $idPregunta
                ]);
            }

            // Confirmar la transacción
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->conexion->rollBack();
            return false;
        }
    }

    /**
     * Elimina una pregunta y sus opciones asociadas de la base de datos.
     *
     * @param int $idPregunta El ID de la pregunta a eliminar.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function deleteQuestion($idPregunta) {
        try {
            // Eliminar la pregunta de la base de datos
            $query = "DELETE FROM Pregunta WHERE idPregunta = :idPregunta";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([':idPregunta' => $idPregunta]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}