<?php

/**
 * Class CPreguntas
 *
 * Esta clase maneja las operaciones relacionadas con "Preguntas", incluyendo mostrar diferentes vistas para modificar,
 * listar, eliminar y añadir preguntas. Utiliza el modelo MPreguntas para las operaciones de datos.
 */
class CPreguntas {

    /**
     * @var MPreguntas $MPreguntas Instancia del modelo MPreguntas.
     */
    private $MPreguntas;

    /**
     * @var string $view La vista que se va a renderizar.
     */
    public $view;

    /**
     * @var string $title El título de la vista actual.
     */
    public $title;

    /**
     * Constructor de CPreguntas.
     *
     * En el constructor, se inicializa el modelo MPreguntas.
     */
    public function __construct() {
        require_once '../config/config.php';
        // Requiriendo la clase del modelo.
        require_once 'model/MPreguntas.php';
        $this->MPreguntas = new MPreguntas();
    }

    /**
     * Muestra la vista para modificar preguntas.
     * @return void
     */
    public function showModify() {
        $this->title = 'Modificacion de Preguntas';
        $this->view = 'modificarPreguntaRespuesta.php';
    }

    /**
     * Muestra la vista para listar preguntas.
     * @return void
     */
    public function showList() {
        $this->title = 'Listado de Preguntas';
        $this->view = 'listarPreguntas.php';
    }

    /**
     * Muestra la vista para eliminar preguntas.
     * @return void
     */
    public function showDelete() {
        $this->title = 'Borrado de Preguntas';
        $this->view = 'borrarPreguntas.php';
    }

    /**
     * Muestra la vista para añadir preguntas.
     * @return void
     */
    public function showAdd() {
        $this->title = 'Añadir Preguntas';
        $this->view = 'aniadirPreguntas.php';
    }

    /**
     * Obtiene los datos de las preguntas.
     * @return array Un array asociativo de preguntas con sus opciones.
     */
    public function getQuestionData() {
        return $this->MPreguntas->listQuestions();
    }

    /**
     * Muestra todas las preguntas con sus opciones.
     * @return void
     */
    public function showQuestions() {
        $this->showList(); //Se llama el metodo de asignacion de titulo y de pagina
        
        $preguntas = $this->getQuestionData();
        return $preguntas;
    }

    /**
     * Añade una nueva pregunta junto con sus opciones.
     *
     * @param string $contenido El contenido de la pregunta.
     * @param int $idEscenario El ID del escenario al que pertenece la pregunta.
     * @param array $opciones Un array de opciones, cada una contiene 'contenido' y 'esCorrecto'.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function addQuestion($contenido, $idEscenario, $opciones) {
        // Validar parámetros
        if (empty($contenido) || empty($idEscenario) || !is_array($opciones)) {
            return false;
        }
        return $this->MPreguntas->addQuestion($contenido, $idEscenario, $opciones);
    }

    /**
     * Modifica una pregunta existente junto con sus opciones.
     *
     * @param int $idPregunta El ID de la pregunta a modificar.
     * @param string $contenido El nuevo contenido de la pregunta.
     * @param array $opciones Un array de nuevas opciones, cada una contiene 'contenido' y 'esCorrecto'.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function modifyQuestion($idPregunta, $contenido, $opciones) {
        // Validar parámetros
        if (empty($idPregunta) || empty($contenido) || !is_array($opciones)) {
            return false;
        }
        return $this->MPreguntas->modifyQuestion($idPregunta, $contenido, $opciones);
    }

    /**
     * Elimina una pregunta y sus opciones asociadas de la base de datos.
     *
     * @param int $idPregunta El ID de la pregunta a eliminar.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function deleteQuestion($idPregunta) {
        // Validar parámetros
        if (empty($idPregunta)) {
            return false;
        }
        return $this->MPreguntas->deleteQuestion($idPregunta);
    }

    /**
     * Muestra una pregunta y sus opciones asociadas.
     * @return array Un array asociativo de la pregunta y sus opciones.
     */
    public function showQuestionAndAnswers(){
        $this->showModify(); //Se llama el metodo de asignacion de titulo y de pagina

        //Se obtiene el id de la pregunta
        $idPregunta = $_GET['id'] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $pregunta = $this->MPreguntas->getQuestion($idPregunta);
        $respuestas = $this->MPreguntas->getAnswer($idPregunta);

        //Se devuelve un array con la pregunta y las respuestas
        return [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas
        ];
    }
}