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

        public function viewListCharacter() {
            $this->title = 'Listado de Personaje';
            $this->view = 'listarPersonajes.php';
        }

        public function addCharacter() {
            if (!empty($_POST)) {
                var_dump($_POST);
        
                $data = $this->getInfoCharacter();
        
                if (isset($_FILES['imagen'])) {
                    $data['image'] = $this->validateImage($_FILES['imagen'], $data);
                }
        
                if ($this->MPersonaje->addCharacter($data['name'], $data['age'], $data['gender'], $data['description'], $data['image'])) {
                    header('location: index.php');
                } else {
                    // Tengo que añadir a pagina de error.
                }
            }
        }

        private function getInfoCharacter() {
            $data = [];
            $data['name'] = isset($_POST['nombre']) ? $_POST['nombre'] : 'NULL';
            $data['age'] = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
            $data['gender'] = isset($_POST['genero']) ? $_POST['genero'] : 'No indicado';
            $data['description'] = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $data['image'] = null; // Por si no añade imagen.
            
            return $data;
        }

        private function validateImage($image, $data) {
            $permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
        
            if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
                if (in_array($image['type'], $permitidos)) {
                    $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);
                    $nameImg = time() . '-' . $data['name'] . '.' . $fileExtension;
                    $dirDestination = PATHIMGADMIN . $nameImg;
        
                    // Mover el archivo subido a la carpeta de imágenes
                    if (move_uploaded_file($image['tmp_name'], $dirDestination)) {
                        return $dirDestination;
                    }
                }
            }
        
            return null;
        }
    }
?>