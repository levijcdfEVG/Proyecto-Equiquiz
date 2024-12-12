<?php


class MPuntosInteres {

    /**
     * @var PDO $conexion La instancia de PDO para la interacción con la base de datos.
     */
    private $conexion;

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
     * Añade un nuevo punto de ineteres
     *
     * @param int $idEscenario ID del escenario al que pertenece el punto de interes.
     * @param string $puntosInteres Las coordenadas del punto de interes.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     * @throws Exception Si la cantidad de puntos de interes es menor a 5 y mayor a 9.
     */
    public function addQuestion($idEscenario, $puntosInteres) {
        try {
            // Validar el número de opciones
            if (count($puntosInteres) < 5 || count($puntosInteres) > 9) {
                throw new Exception("Debe haber minimo 5 puntos de interes (maximo 9).");
            }

            // Iniciar una transacción
            $this->conexion->beginTransaction();

            // Insertar la pregunta en la base de datos
            $query = "INSERT INTO PuntosInteres_Escenario (idEscenario, puntosInteres) VALUES (:idEscenario, :puntosInteres)";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([
                ':idEscenario' => $idEscenario,
                ':puntosInteres' => $puntosInteres
            ]);
            return true;
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->conexion->rollBack();
            return false;
        }
    }

    /**
     * Lista todos los puntos de interes.
     *
     * @return array Un array asociativo de los puntos de interes.
     */
    public function listQuestions() {
        try {
            $query = "SELECT * 
                      FROM PuntosInteres_Escenario
                      ORDER BY idEscenario";

            $stmt = $this->conexion->query($query);
            $puntos = [];

            // Recorrer los resultados y organizar las preguntas y opciones
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $puntos[$row['idEscenario']] = $row['puntosInteres'];
            }

            return $puntos;
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Modifica un punto de interes junto al escenario asignado.
     *
     * @param int $idEscenario ID del escenario al que pertenece el punto de interes.
     * @param string $puntosInteres Las coordenadas del punto de interes.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     * @throws Exception Si la cantidad de puntos de interes es menor a 5 y mayor a 9.
     */
    public function modifyQuestion($idEscenario, $puntosInteres) {
        try {
            // Validar el número de opciones
            if (count($puntosInteres) < 2 || count($puntosInteres) > 4) {
                throw new Exception("Debe haber minimo 5 puntos de interes (maximo 9).");
            }

            // Iniciar una transacción
            $this->conexion->beginTransaction();

            // Actualizar el contenido del punto de interes
            $queryPtoInteres = "UPDATE PuntosInteres_Escenario SET puntosInteres = :puntosInteres WHERE idEscenario = :idEscenario";
            $stmtPtoInteres = $this->conexion->prepare($queryPtoInteres);
            $stmtPtoInteres->execute([
                ':puntosInteres' => $puntosInteres,
                ':idEscenario' => $idEscenario
            ]);

            // Eliminar los puntos de interes antiguos
            $queryBorrarPtoInteres = "DELETE FROM PuntosInteres_Escenario WHERE idEscenario = :idEscenario";
            $stmtBorrarPtoInteres = $this->conexion->prepare($queryBorrarPtoInteres);
            $stmtBorrarPtoInteres->execute([':idEscenario' => $idEscenario]);

            // Insertar los nuevos puntos de interes
            $queryPtoInteres = "INSERT INTO PuntosInteres_Escenario (idEscenario, puntosInteres) VALUES (:idEscenario, :puntosInteres)";
            $stmtPtoInteres = $this->conexion->prepare($queryOpciones);

            // Recorrer todos los puntos de interes y ejecutarlos
            foreach ($puntosInteres as $PtoInteres) {
                $stmtPtoInteres->execute([
                    ':idEscenario' => $idEscenario,
                    ':puntosInteres' => $PtoInteres['puntosInteres']
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
     * Elimina un punto de interes de la base de datos.
     *
     * @param int $idEscenario El ID de la pregunta a eliminar.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function deleteQuestion($idEscenario) {
        try {
            // Eliminar la pregunta de la base de datos
            $query = "DELETE FROM Pregunta WHERE idEscenario = :idEscenario";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute([':idEscenario' => $idEscenario]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}