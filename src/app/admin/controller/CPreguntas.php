<?php

    class CPreguntas {

        private $MPreguntas;
        public $view;
        public $title;

        /**
         * Summary of __construct
         * 
         * En el constructor se inicializa el modelo Personaje.
         */
        public function __construct() {
            require_once '../config/config.php';
            // Requerimos de la clase del modelo.
            require_once 'model/MPersonaje.php';
            $this->MPersonaje = new MPersonaje();
        }


        //Visualizar 
        public function showModify() {
            $this->title = 'Modificacion de Preguntas';
            $this->view = 'modificarPreguntas.php';
        }
        //ViewList
        public function showList() {
            $this->title = 'Listado de Preguntas';
            $this->view = 'listarPreguntas.php';
        }
        //ViewDelete
        public function showDelete() {
            $this->title = 'Borrado de Preguntas';
            $this->view = 'borrarPreguntas.php';
        }
        //ViewAdd
        public function showAdd() {
            $this->title = 'Añadir Preguntas';
            $this->view = 'aniadirPreguntas.php';
        }
        //GetQuestionData

        //GetAnswerData

    }