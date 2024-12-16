<?php
/**
 * Clase MPuntosInteres
 * 
 * Esta clase gestiona los puntos de interés asociados a un escenario en la base de datos. 
 * Incluye operaciones para añadir, obtener, modificar y eliminar puntos de interés.
 */
class MPuntosInteres {

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
        require_once 'config/config.php';

        try {
            require_once 'config/configDb.php';
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
     * @param float $ptX Coordenada X del punto de interés.
     * @param float $ptY Coordenada Y del punto de interés.
     * @return bool Indica si la consulta se ejecutó correctamente.
     */
    public function addPoint($idEscenario, $ptX, $ptY) {
        try {
            $sql = "INSERT INTO Escenario_PtsInteres (idEscenario, ptX, ptY) 
                    VALUES (:idEscenario, :ptX, :ptY)";
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario);
            $resultado->bindParam(':ptX', $ptX);
            $resultado->bindParam(':ptY', $ptY);
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
    public function getAllPoints() {
        $sql = 'SELECT * FROM Escenario_PtsInteres';
        $resultado = $this->conexion->query($sql);
        // $resultado->execute();
        // var_dump($sql);
        // var_dump($resultado);

        return $resultado;
    }

    /**
     * Obtener los datos de un punto de interés para modificar.
     * 
     * @param int $idEscenario ID del escenario.
     * @return mixed Retorna un array asociativo con los datos del punto de interés.
     */
    public function getPointById($idEscenario) {
        $sql = 'SELECT * FROM Escenario_PtsInteres WHERE idEscenario = :idEscenario';
        $resultado = $this->conexion->prepare($sql);
        $resultado->bindParam(':idEscenario', $idEscenario, PDO::PARAM_INT);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Modificar los puntos de interés.
     * 
     * @param int $idEscenario ID del escenario.
     * @param float $ptX Coordenada X nueva del punto de interés.
     * @param float $ptY Coordenada Y nueva del punto de interés.
     * @param float $ptXAntiguo Coordenada X actual del punto de interés.
     * @param float $ptYAntiguo Coordenada Y actual del punto de interés.
     * @return bool Indica si la consulta fue correcta o no.
     */
    public function modifyPoint($idEscenario, $ptX, $ptY, $ptXAntiguo, $ptYAntiguo) {
        try {
            $sql = "UPDATE Escenario_PtsInteres 
                    SET ptX = :ptX, ptY = :ptY
                    WHERE idEscenario = :idEscenario 
                    AND ptX = :ptXAntiguo 
                    AND ptY = :ptYAntiguo";

            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario, PDO::PARAM_INT);
            $resultado->bindParam(':ptX', $ptX);
            $resultado->bindParam(':ptY', $ptY);
            $resultado->bindParam(':ptXAntiguo', $ptXAntiguo);
            $resultado->bindParam(':ptYAntiguo', $ptYAntiguo);

            return $resultado->execute();
        } catch (Exception $e) {
            return false; 
        }
    }

    /**
     * Eliminar un punto de interés.
     * 
     * @param int $idEscenario ID del escenario.
     * @param float $ptX Coordenada X del punto de interés.
     * @param float $ptY Coordenada Y del punto de interés.
     * @return bool Indica si la consulta fue correcta o no.
     */
    public function deletePoint($idEscenario, $ptX, $ptY) {
        try {
            $sql = 'DELETE FROM Escenario_PtsInteres 
                    WHERE idEscenario = :idEscenario 
                    AND ptX = :ptX 
                    AND ptY = :ptY';

            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario, PDO::PARAM_INT);
            $resultado->bindParam(':ptX', $ptX);
            $resultado->bindParam(':ptY', $ptY);

            return $resultado->execute();
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
