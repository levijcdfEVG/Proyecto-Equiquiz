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


        //Viewmodify
        public function viewModify() {
            $this->title = 'Añadir Personaje';
            $this->view = 'añadirPersonaje.php';
        }
        //ViewList

        //ViewDelete

        //ViewAdd

        //GetQuestionData

        //GetAnswerData

    }