<?php
/**
 * Clase MPersonaje
 * 
 * Esta clase gestiona los puntos de interés asociados a un escenario en la base de datos. 
 * Incluye operaciones para añadir, obtener, modificar y eliminar puntos de interés.
 */
class MPersonaje {

    /**
     * @var PDO Objeto de conexión a la base de datos.
     */
    private $conexion;

    /**
     * Constructor de la clase.
     * 
     * Carga las configuraciones necesarias y establece la conexión a la base de datos.
     * 
     * @throws PDOException Si ocurre un error durante la conexión a la base de datos.
     */
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

    /**
     * Añadir punto de interés.
     * 
     * @param int $idEscenario ID del escenario.
     * @param array $puntosInteres Coordenadas de los puntos de interés.
     * @throws Exception Si el número de puntos de interés no está entre 5 y 9.
     * @return bool Indica si la consulta se ejecutó correctamente.
     */
    public function addPtoInteres($idEscenario, $puntosInteres) {
        try {
            // Validar el número de opciones.
            if (!is_array($puntosInteres) || count($puntosInteres) < 5 || count($puntosInteres) > 9) {
                throw new Exception("El número de puntos de interés debe estar entre 5 y 9.");
            }
            $puntosInteresSerializados = serialize($puntosInteres);
            $sql = "INSERT INTO PuntosInteres_Escenario (idEscenario, puntosInteres) 
                    VALUES (:idEscenario, :puntosInteres)";
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario);
            $resultado->bindParam(':puntosInteres', $puntosInteresSerializados);
            return $resultado->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Recoger todos los puntos de interés.
     * 
     * @return bool|PDOStatement Devuelve un objeto PDOStatement con todos los puntos de interés de la base de datos.
     */
    public function getAllPtoInteres() {
        $sql = "SELECT * FROM PuntosInteres_Escenario";
        $resultado = $this->conexion->prepare($sql);
        $resultado->execute();

        return $resultado;
    }

    /**
     * Obtener los datos de un punto de interés para modificar.
     * 
     * @param int $idEscenario ID del escenario.
     * @return mixed Retorna un array asociativo con los datos del punto de interés.
     */
    public function getInfoPtoInteres($idEscenario) {
        $sql = 'SELECT * FROM PuntosInteres_Escenario WHERE idEscenario = :idEscenario';
        $resultado = $this->conexion->prepare($sql);
        $resultado->bindParam(':idEscenario', $idEscenario, PDO::PARAM_INT);
        $resultado->execute();

        $data = $resultado->fetch(PDO::FETCH_ASSOC);
        if ($data && isset($data['puntosInteres'])) {
            $data['puntosInteres'] = unserialize($data['puntosInteres']);
        }
        return $data;
    }

    /**
     * Modificar los puntos de interés.
     * 
     * @param int $idEscenario ID del escenario.
     * @param array $puntosInteres Coordenadas de los puntos de interés.
     * @throws Exception Si el número de puntos de interés no está entre 5 y 9.
     * @return bool Indica si la consulta fue correcta o no.
     */
    public function modifyPtoInteres($idEscenario, $puntosInteres) {
        try {
            // Validar el número de opciones.
            if (!is_array($puntosInteres) || count($puntosInteres) < 5 || count($puntosInteres) > 9) {
                throw new Exception("El número de puntos de interés debe estar entre 5 y 9.");
            }
            $puntosInteresSerializados = serialize($puntosInteres);
            $sql = "UPDATE PuntosInteres_Escenario SET 
                        puntosInteres = :puntosInteres 
                    WHERE idEscenario = :idEscenario";

            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario, PDO::PARAM_INT);
            $resultado->bindParam(':puntosInteres', $puntosInteresSerializados);

            return $resultado->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Eliminar un punto de interés.
     * 
     * @param int $idEscenario ID del escenario.
     * @return bool Indica si la consulta fue correcta o no.
     */
    public function deletePtoInteres($idEscenario) {
        $data = $this->getInfoPtoInteres($idEscenario);

        if ($data) {
            $sql = 'DELETE FROM PuntosInteres_Escenario WHERE idEscenario = :idEscenario';
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario, PDO::PARAM_INT);

            return $resultado->execute();
        }
        return false;
    }
}
?>
