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
        require_once 'config/config.php';

        try {
            require_once 'config/configDb.php';
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
     * @param string $pregunta El contenido de la pregunta.
     * @param array $respuestas Un array de respuestas.
     * @param int $correcta El índice de la respuesta correcta.
     * @param int $escenario El ID del escenario al que pertenece la pregunta.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function addQuestion($pregunta, $respuestas, $correcta, $escenario) {
        try {
            $sql = "INSERT INTO Pregunta (contenido_P, idEscenario) VALUES (:pregunta, :escenario)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':pregunta', $pregunta);
            $stmt->bindParam(':escenario', $escenario);
            $stmt->execute();
    
            $idPregunta = $this->conexion->lastInsertId();
    
            foreach ($respuestas as $index => $respuesta) {
                $esCorrecta = ($index + 1 == $correcta) ? 1 : 0;
                $sql = "INSERT INTO Opciones (idPregunta, contenidos, esCorrecto) VALUES (:idPregunta, :contenidos, :esCorrecta)";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':idPregunta', $idPregunta);
                $stmt->bindParam(':contenidos', $respuesta);
                $stmt->bindParam(':esCorrecta', $esCorrecta);
                $stmt->execute();
            }
            return true; // Operación exitosa
        } catch (Exception $e) {
            echo $e->getMessage();
            return false; // Ocurrió un error
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
            echo $e->getMessage();
            return [];
        }
    }

    /**
     * Modifica una pregunta existente junto con sus opciones.
     *
     * @param int $idPregunta El ID de la pregunta a modificar.
     * @param string $pregunta El nuevo contenido de la pregunta.
     * @param array $respuestas Un array de nuevas respuestas.
     * @param int $correcta El índice de la respuesta correcta.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function modifyQuestion($idPregunta, $pregunta, $respuestas, $correcta) {
        try {
            // Actualizar la pregunta
            $sql = "UPDATE Pregunta SET contenido_P = :pregunta WHERE idPregunta = :idPregunta";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':pregunta', $pregunta);
            $stmt->bindParam(':idPregunta', $idPregunta);
            $stmt->execute();
        
            // Eliminar las opciones existentes
            $sql = "DELETE FROM Opciones WHERE idPregunta = :idPregunta";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':idPregunta', $idPregunta);
            $stmt->execute();
        
            // Insertar las nuevas opciones
            foreach ($respuestas as $index => $respuesta) {
                $esCorrecta = ($index + 1 == $correcta) ? 1 : 0;
                $sql = "INSERT INTO Opciones (idPregunta, contenidos, esCorrecto) VALUES (:idPregunta, :contenidos, :esCorrecta)";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(':idPregunta', $idPregunta);
                $stmt->bindParam(':contenidos', $respuesta);
                $stmt->bindParam(':esCorrecta', $esCorrecta);
                $stmt->execute();
            }
            return true; // Operación exitosa
        } catch (Exception $e) {
            return false; // Ocurrió un error
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
            $sql = "DELETE FROM Opciones WHERE idPregunta = :idPregunta";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':idPregunta', $idPregunta);
            $stmt->execute();
    
            $sql = "DELETE FROM Pregunta WHERE idPregunta = :idPregunta";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':idPregunta', $idPregunta);
            $stmt->execute();
            return true; // Operación exitosa
        } catch (Exception $e) {
            return false; // Ocurrió un error
        }
    }

    /**
     * Retorna los datos de una pregunta específica junto con sus opciones.
     *
     * @param int $idPregunta El ID de la pregunta.
     * @return array Un array asociativo con los datos de la pregunta y sus opciones.
     */
    public function getQuestion($idPregunta) {
        $sql = "SELECT * FROM Pregunta WHERE idPregunta = :idPregunta";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idPregunta', $idPregunta);
        $stmt->execute();
        $pregunta = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM Opciones WHERE idPregunta = :idPregunta";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idPregunta', $idPregunta);
        $stmt->execute();
        $respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return ['pregunta' => $pregunta, 'respuestas' => $respuestas];
    }

    /**
     * Obtiene las opciones de respuesta para una pregunta específica.
     *
     * @param int $idPregunta El ID de la pregunta.
     * @return array Un array de opciones de respuesta.
     */
    public function getAnswer($idPregunta) {
        try {
            $query = "SELECT contenidos, esCorrecto FROM Opciones WHERE idPregunta = :idPregunta";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([':idPregunta' => $idPregunta]);
            $opciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $opciones;
        } catch (Exception $e) {
            return [];
        }
    }
}
?>
