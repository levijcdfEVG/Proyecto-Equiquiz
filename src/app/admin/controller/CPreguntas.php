<?php

/**
 * Class CPreguntas
 *
 * This class handles the operations related to "Preguntas" (questions), including showing different views for modifying,
 * listing, deleting, and adding questions. It utilizes the MPersonaje model for data operations.
 */
class CPreguntas {

    /**
     * @var MPersonaje $MPreguntas Instance of the MPersonaje model.
     */
    private $MPreguntas;

    /**
     * @var string $view The view to be rendered.
     */
    public $view;

    /**
     * @var string $title The title of the current view.
     */
    public $title;

    /**
     * CPreguntas constructor.
     *
     * In the constructor, the MPersonaje model is initialized.
     */
    public function __construct() {
        require_once '../config/config.php';
        // Requiring the model class.
        require_once 'model/MPersonaje.php';
        $this->MPersonaje = new MPersonaje();
    }

    /**
     * Show the view for modifying questions.
     */
    public function showModify() {
        $this->title = 'Modificacion de Preguntas';
        $this->view = 'modificarPreguntas.php';
    }

    /**
     * Show the view for listing questions.
     */
    public function showList() {
        $this->title = 'Listado de Preguntas';
        $this->view = 'listarPreguntas.php';
    }

    /**
     * Show the view for deleting questions.
     */
    public function showDelete() {
        $this->title = 'Borrado de Preguntas';
        $this->view = 'borrarPreguntas.php';
    }

    /**
     * Show the view for adding questions.
     */
    public function showAdd() {
        $this->title = 'Añadir Preguntas';
        $this->view = 'aniadirPreguntas.php';
    }

    // Future methods for handling question data operations.

    // GetQuestionData

    // GetAnswerData

    // ModifyQuestions

    // DeleteQuestions

    // ShowQuestions
}
?>