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
     * @return array Los datos de la pregunta y sus opciones.
     */
    public function showModify() {
        $idPregunta = $_GET['id'];
        $data = $this->MPreguntas->getQuestion($idPregunta);
        $this->view = 'modificarPreguntaRespuesta.php';
        $this->data = $data;
        return $data;
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
        $this->view = 'crearPreguntaRespuesta.php';
    }

    /**
     * Muestra todas las preguntas con sus opciones.
     * @return array Un array asociativo de preguntas con sus opciones.
     */
    public function showQuestions() {
        $this->showList(); //Se llama el metodo de asignacion de titulo y de pagina
        
        $preguntas = $this->MPreguntas->listQuestions();
        return $preguntas;
    }

    /**
     * Añade una nueva pregunta junto con sus opciones.
     *
     * @return void No devuelve nada.
     */
    public function addQuestion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pregunta']) && isset($_POST['escenario']) && isset($_POST['respuestas'])) {
            $pregunta = $_POST['pregunta'];
            $respuestas = $_POST['respuestas'];
            $correcta = $_POST['correcta'];
            $escenario = $_POST['escenario'];
    
            // Filtrar respuestas vacías
            $respuestas = array_filter($respuestas, function($respuesta) {
                return !empty(trim($respuesta));
            });
    
            if (count($respuestas) < 2) {
                echo "Debe proporcionar al menos dos respuestas.";
                return false;
            }
    
            $resultado = $this->MPreguntas->addQuestion($pregunta, $respuestas, $correcta, $escenario);
            $this->view = 'resultadoAniadido.php';
            $this->resultado = $resultado;
        } else {
            echo "No se ha recibido datos de un formulario POST.";
            return false;
        }
    }

    /**
     * Modifica una pregunta existente junto con sus opciones.
     *
     * @return void No devuelve nada.
     */
    public function modifyQuestion() {
        $idPregunta = $_POST['idPregunta'];
        $pregunta = $_POST['pregunta'];
        $respuestas = $_POST['respuestas'];
        $correcta = $_POST['correcta'];

        $this->MPreguntas->modifyQuestion($idPregunta, $pregunta, $respuestas, $correcta);
        header('Location: index.php?c=CPreguntas&a=showQuestions');
    }

    /**
     * Elimina una pregunta y sus opciones asociadas de la base de datos.
     *
     * @return void No devuelve nada.
     */
    public function deleteQuestion() {
        $idPregunta = $_GET['id'];
        $resultado = $this->MPreguntas->deleteQuestion($idPregunta);
        $this->view = 'resultadoBorrado.php'; // Nueva vista para mostrar el resultado
        $this->resultado = $resultado;
    }

    /**
     * Muestra una pregunta y sus opciones asociadas.
     * @param int $idPregunta El ID de la pregunta.
     * @return array Un array asociativo de la pregunta y sus opciones.
     */
    public function showQuestionAndAnswers($idPregunta){
        $this->showModify(); //Se llama el metodo de asignacion de titulo y de pagina
        $pregunta = $this->MPreguntas->getQuestion($idPregunta);
        $respuestas = $this->MPreguntas->getAnswer($idPregunta);
        
        //Se devuelve un array con la pregunta y las respuestas
        return [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas
        ];
    }
}
?>