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
     * @param string $puntosInteres Coordenadas de los puntos de interés en formato "(num,num)".
     * @throws Exception Si el formato de $puntosInteres no es válido.
     * @throws Exception Si el número de puntos de interés no está entre 5 y 9.
     * @return bool Indica si la consulta se ejecutó correctamente.
     */
    public function addPtoInteres($idEscenario, $puntosInteres) {
        try {
            // Validar el formato del string puntosInteres (e.g., "(33,33)").
            if (!preg_match('/^\(\d+,\d+\)$/', $puntosInteres)) {
                throw new Exception("El formato de puntos de interés es inválido. Debe ser '(X,Y)'.");
            }
            if (!is_array($puntosInteres) || count($puntosInteres) < 5 || count($puntosInteres) > 9) {
                throw new Exception("El número de puntos de interés debe estar entre 5 y 9.");
            }
            $sql = "INSERT INTO PuntosInteres_Escenario (idEscenario, puntosInteres) 
                    VALUES (:idEscenario, :puntosInteres)";
            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario);
            $resultado->bindParam(':puntosInteres', $puntosInteres);
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

        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Modificar los puntos de interés.
     * 
     * @param int $idEscenario ID del escenario.
     * @param string $puntosInteres Coordenadas de los puntos de interés en formato "(num,num)".
     * @param string $puntosInteresAntiguo Valor actual de puntos de interés que se desea actualizar.
     * @throws Exception Si el formato de $puntosInteres no es válido.
     * @throws Exception Si el número de puntos de interés no está entre 5 y 9.
     * @return bool Indica si la consulta fue correcta o no.
     */
    public function modifyPtoInteres($idEscenario, $puntosInteres, $puntosInteresAntiguo) {
        try {
            // Validar el formato del string puntosInteres (e.g., "(33,33)").
            if (!preg_match('/^\(\d+,\d+\)$/', $puntosInteres)) {
                throw new Exception("El formato de puntos de interés es inválido. Debe ser '(X,Y)'.");
            }
            if (!is_array($puntosInteres) || count($puntosInteres) < 5 || count($puntosInteres) > 9) {
                throw new Exception("El número de puntos de interés debe estar entre 5 y 9.");
            }
            $sql = "UPDATE PuntosInteres_Escenario 
                    SET puntosInteres = :puntosInteres 
                    WHERE idEscenario = :idEscenario 
                    AND puntosInteres = :puntosInteresAntiguo";

            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario, PDO::PARAM_INT);
            $resultado->bindParam(':puntosInteres', $puntosInteres);
            $resultado->bindParam(':puntosInteresAntiguo', $puntosInteresAntiguo);

            return $resultado->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Eliminar un punto de interés.
     * 
     * @param int $idEscenario ID del escenario.
     * @param string $puntosInteres Coordenadas del punto de interés en formato "(num,num)".
     * @return bool Indica si la consulta fue correcta o no.
     */
    public function deletePtoInteres($idEscenario, $puntosInteres) {
        try {
            // Validar el formato del string puntosInteres (e.g., "(33,33)").
            if (!preg_match('/^\(\d+,\d+\)$/', $puntosInteres)) {
                throw new Exception("El formato de puntos de interés es inválido. Debe ser '(num,num)'.");
            }

            $sql = 'DELETE FROM PuntosInteres_Escenario 
                    WHERE idEscenario = :idEscenario 
                    AND puntosInteres = :puntosInteres';

            $resultado = $this->conexion->prepare($sql);
            $resultado->bindParam(':idEscenario', $idEscenario, PDO::PARAM_INT);
            $resultado->bindParam(':puntosInteres', $puntosInteres);

            return $resultado->execute();
        } catch (Exception $e) {
            return false;
        }
    }

}
?>
