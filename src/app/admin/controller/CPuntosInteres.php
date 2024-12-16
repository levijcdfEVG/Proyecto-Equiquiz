<?php
class CPuntosInteres {
    private $MPuntosInteres;
    public $view;
    public $title;

    /**
     * Constructor: inicializa el modelo de Puntos de Interés.
     */
    public function __construct() {
        require_once '../config/config.php';
        require_once 'model/MPuntosInteres.php';
        $this->MPuntosInteres = new MPuntosInteres();
    }

    /**
     * Vista para añadir un nuevo punto de interés.
     */
    public function viewAddPoint() {
        $this->title = 'Añadir Punto de Interés';
        $this->view = 'añadirPuntoInteres.php';
    }

    /**
     * Vista para listar todos los puntos de interés.
     */
    public function viewListPoints() {
        $this->title = 'Listado de Puntos de Interés';
        $this->view = 'listarPuntoInteres.php';

        $points = $this->MPuntosInteres->getAllPoints();
        require_once VIEWPATHADMIN.$this->view;
    }

    /**
     * Vista para modificar un punto de interés.
     */
    public function viewModifyPoint() {
        $this->title = 'Modificar Punto de Interés';
        $this->view = 'modificarPuntoInteres.php';

        if (isset($_GET['id'])) {
            $pointData = $this->MPuntosInteres->getPointById($_GET['id']);
            if (!$pointData) {
                $this->view = 'error.php?e="Error: No se encontró el punto de interés"';
            }
        } else {
            $this->view = 'error.php?e="Error: No se proporcionó el ID"';
        }

        require_once VIEWPATH . $this->view;
    }

    /**
     * Vista para eliminar un punto de interés.
     */
    public function viewDeletePoint() {
        $this->title = 'Eliminar Punto de Interés';
        $this->view = 'eliminarPuntoInteres.php';

        if (isset($_GET['id'])) {
            $pointData = $this->MPuntosInteres->getPointById($_GET['id']);
            if (!$pointData) {
                $this->view = 'error.php?e="Error: No se encontró el punto de interés"';
            }
        } else {
            $this->view = 'error.php?e="Error: No se proporcionó el ID"';
        }

        require_once VIEWPATH . $this->view;
    }

    /**
     * Añade un nuevo punto de interés.
     */
    public function addPoint() {
        if (!empty($_POST)) {
            $data = $this->getPointDataFromPost();
            if ($this->MPuntosInteres->addPoint($data['id'], $data['ptX'], $data['ptY'])) {
                header('Location: index.php?c=CPuntosInteres&a=viewListPoints');
                exit;
            } else {
                $this->view = 'error.php?e="Error al añadir el punto de interés"';
            }
        }
    }

    /**
     * Modifica un punto de interés.
     */
    public function modifyPoint() {
        if (!empty($_POST) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = $this->getPointDataFromPost();

            if ($this->MPuntosInteres->modifyPoint($id, $data)) {
                header('Location: index.php?c=CPuntosInteres&a=viewListPoints');
                exit;
            } else {
                $this->view = 'error.php?e="Error al modificar el punto de interés"';
            }
        }
    }

    /**
     * Elimina un punto de interés.
     */
    public function deletePoint() {
        if (isset($_GET['id'])) {
            if ($this->MPuntosInteres->deletePoint($_GET['id'])) {
                header('Location: index.php?c=CPuntosInteres&a=viewListPoints');
                exit;
            } else {
                $this->view = 'error.php?e="Error al eliminar el punto de interés"';
            }
        }
    }

    /**
     * Recupera los datos de un punto de interés desde $_POST.
     * @return array Datos del punto de interés.
     */
    private function getPointDataFromPost() {
        $data = [];
            $data['id'] = isset($_POST['idEscenario']) ? $_POST['idEscenario'] : 'NULL';
            $data['ptX'] = (float)isset($_POST['ptX']) ? (float)$_POST['ptX'] : 0;
            $data['ptY'] = (float)isset($_POST['ptY']) ? (float)$_POST['ptY'] : 0;

            return $data;
    }
}
?>
