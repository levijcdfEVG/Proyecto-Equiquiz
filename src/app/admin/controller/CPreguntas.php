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
     * @return void
     */
    public function showQuestions() {
        $this->showList(); //Se llama el metodo de asignacion de titulo y de pagina
        
        $preguntas = $this->MPreguntas->listQuestions();
//var_dump($preguntas);
        return $preguntas;
    }

    /**
     * Añade una nueva pregunta junto con sus opciones.
     *
     * @param string $contenido El contenido de la pregunta.
     * @param int $idEscenario El ID del escenario al que pertenece la pregunta.
     * @param array $opciones Un array de opciones, cada una contiene 'contenido' y 'esCorrecto'.
     * @return void No devuelve nada.
     */
    public function addQuestion() {
        // Validar parámetros
        if($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_POST['pregunta']) && !isset($_POST['escenario']) && !isset($_POST['respuestas'])) {
            echo "No se ha recibido datos de un formulario POST.";
            return false;
        }else{

            $pregunta = $_POST['pregunta'];
            $respuestas = $_POST['respuestas'];
            $correcta = $_POST['correcta'];
            $escenario = $_POST['escenario'];
    
            $this->MPreguntas->addQuestion($pregunta, $respuestas, $correcta, $escenario);
            header('Location: index.php?c=CPreguntas&a=showQuestions');
    
        }

        
    }

    /**
     * Modifica una pregunta existente junto con sus opciones.
     *
     * @param int $idPregunta El ID de la pregunta a modificar.
     * @param string $contenido El nuevo contenido de la pregunta.
     * @param array $opciones Un array de nuevas opciones, cada una contiene 'contenido' y 'esCorrecto'.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
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
     * @param int $idPregunta El ID de la pregunta a eliminar.
     * @return bool Devuelve true en caso de éxito, false en caso de fallo.
     */
    public function deleteQuestion() {
        $idPregunta = $_GET['id'];
        $resultado = $this->MPreguntas->deleteQuestion($idPregunta);
        if($resultado){
            header('Location: index.php?c=CPreguntas&a=showQuestions');
        }else{
            echo "No se ha podido eliminar la pregunta.";
        }    
    }

    /**
     * Muestra una pregunta y sus opciones asociadas.
     * @return array Un array asociativo de la pregunta y sus opciones.
     */
    public function showQuestionAndAnswers($idPregunta){
//echo "hola";
        $this->showModify(); //Se llama el metodo de asignacion de titulo y de pagina
        //var_dump($idPregunta);
        $pregunta = $this->MPreguntas->getQuestion($idPregunta);
        
        $respuestas = $this->MPreguntas->getAnswer($idPregunta);
        
        //Se devuelve un array con la pregunta y las respuestas
        return [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas
        ];
    }
}