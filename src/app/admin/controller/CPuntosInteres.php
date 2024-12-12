<?php


class CPuntosInteres {

    /**
     * @var MPuntosInteres $MPreguntas Instancia del modelo MPreguntas.
     */
    private $MPuntosInteres;

    /**
     * @var string $view La vista que se va a renderizar.
     */
    public $view;

    /**
     * @var string $title El título de la vista actual.
     */
    public $title;

    public function __construct() {
        require_once '../config/config.php';
        // Requiriendo la clase del modelo.
        require_once 'model/MPuntosInteres.php';
        $this->MPuntosInteres = new MPuntosInteres();
    }

    /**
     * Muestra la vista para modificar los puntos de interes.
     * @return void
     */
    public function showModify() {
        $this->title = 'Modificacion de Puntos de Interes';
        $this->view = 'modificarPuntosInteres.php';
    }

    /**
     * Muestra la vista para listar los puntos de interes.
     * @return void
     */
    public function showList() {
        $this->title = 'Listado de Puntos de Interes';
        $this->view = 'listarPuntoInteres.php';
    }

    /**
     * Muestra la vista para eliminar los puntos de interes.
     * @return void
     */
    public function showDelete() {
        $this->title = 'Borrado de Puntos de Interes';
        $this->view = 'borrarPuntoInteres.php';
    }

    /**
     * Muestra la vista para añadir los puntos de interes.
     * @return void
     */
    public function showAdd() {
        $this->title = 'Añadir Puntos de Interes';
        $this->view = 'crearPuntoInteres.php';
    }

    /**
     * Obtiene los datos de los puntos de interes.
     * @return array Un array asociativo de los puntos de interes.
     */
    public function getQuestionData() {
        return $this->MPuntosInteres->listQuestions();
    }

    /**
     * Muestra todos los puntos de interes.
     * @return void
     */
    public function showQuestions() {
        $this->showList(); //Se llama el metodo de asignacion de titulo y de pagina
        
        $puntosInteres = $this->getQuestionData();
        return $puntosInteres;
    }

    /**
     * Añade un nuevo punto de interes.
     *
     * @param int $idEscenario El ID del escenario al que pertenece el punto de interes.
     * @param string $puntosInteres Las coordenadas del punto de interes.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function addQuestion($idEscenario, $puntosInteres) {
        // Validar parámetros
        if (empty($idEscenario) || empty($puntosInteres)) {
            return false;
        }
        return $this->MPuntosInteres->addQuestion($idEscenario, $puntosInteres);
    }

    /**
     * Modifica un punto de interes.
     *
     * @param int $idEscenario El ID del escenario al que pertenece el punto de interes.
     * @param string $puntosInteres Las coordenadas del punto de interes.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function modifyQuestion($idEscenario, $puntosInteres) {
        // Validar parámetros
        if (empty($idEscenario) || empty($puntosInteres)) {
            return false;
        }
        return $this->MPuntosInteres->modifyQuestion($idEscenario, $puntosInteres);
    }

    /**
     * Elimina un punto de interes de la base de datos.
     *
     * @param int $idEscenario El ID de la pregunta a eliminar.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function deleteQuestion($idEscenario) {
        // Validar parámetros
        if (empty($idEscenario)) {
            return false;
        }
        return $this->MPuntosInteres->deleteQuestion($idEscenario);
    }

    /**
     * Muestra un punto de interes.
     * @return string Un array asociativo del escenario con su punto de interes.
     */
    public function showQuestionAndAnswers(){
        $this->showModify(); //Se llama el metodo de asignacion de titulo y de pagina

        //Se obtiene el id de la pregunta
        $idEscenario = $_GET['id'] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $pregunta = $this->MPreguntas->getQuestion($idPregunta);
        $respuestas = $this->MPreguntas->getAnswer($idPregunta);

        //Se devuelve un array con la pregunta y las respuestas
        return [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas
        ];
    }
}