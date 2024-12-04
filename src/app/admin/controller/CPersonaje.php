<?php
    class CPersonaje {
        private $MPersonaje;
        public $view;
        public $title;

        public function __construct() {
            require_once '../config/config.php';
            // Requerimos de la clase del modelo.
            require_once 'model/MPersonaje.php';
            $this->MPersonaje = new MPersonaje();
        }

        public function viewAddCharacter() {
            $this->title = 'Añadir Personaje';
            $this->view = 'añadirPersonaje.php';
        }

        public function addCharacter() {
            $permitidos = ['image/jpeg','image/jpg', 'image/png'];

            if(!empty($_POST)){
                var_dump($_POST);
                $name = isset($_POST['nombre']) ? $_POST['nombre'] : 'NULL';
                $age = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
                $gender = isset($_POST['genero']) ? $_POST['genero'] : 'No indicado';
                $description = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

                $img = null; //Por si no añade imagen.
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    if (in_array($_FILES['imagen']['type'], $permitidos)) {

                        $fileExtension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                        $nameImg = time() . '-' . $name . '.' . $fileExtension;
        
                        $dirDestination = PATHIMGADMIN . $nameImg;
        
                        // Mover el archivo subido a la carpeta de imágenes
                        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $dirDestination)) {
                            $img = $dirDestination;
                        }
                    }
                        

                    if($this->MPersonaje->addCharacter($name,$age,$gender,$description,$img))
                        header('location: index.php');
                    //Añadir redireccion a una página de error en el else.
                }
            }
        }
    }
?>