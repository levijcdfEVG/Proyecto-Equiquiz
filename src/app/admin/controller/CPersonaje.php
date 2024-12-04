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

            //Obtengo todos los personajes
            $characters = $this->MPersonaje->getAllCharacters();

            require_once VIEWPATHADMIN.$this->view;
        }

        public function gatewayAdd() {
            $this->title = 'Panel Aministrador';
            $this->view = 'unionAñadir.php';
        }

        public function gatewayList() {
            $this->title = 'Panel Aministrador';
            $this->view = 'unionListar.php';
        }

        public function viewModifyCharacter() {
            $this->title = 'Modificar Personaje';
            $this->view = 'modificarPersonaje.php';
        
            if (isset($_GET['id'])) {
                $data = $this->MPersonaje->getInfoviewModify($_GET['id']);
                
                if ($data) {
                    $parseData = $this->getInfoData($data);
                } else {
                    $this->view = 'error.php?e="Error: No se encontró el personaje seleccionado"';
                }
            } else {
                $this->view = 'error.php?e="Error: Al modificar no se pudo obtener su ID"';
            }
        
            require_once VIEWPATHADMIN . $this->view;
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

        public function getInfoData($data) {
            $returndata = [];
            $returndata['id'] = $data['idPersonaje'];
            $returndata['name'] = $data['nombre'];
            $returndata['age'] = $data['edad'];
            $returndata['gender'] = $data['genero'];
            $returndata['description'] = $data['descripcion'];
            $returndata['imageUrl'] = $data['urlImagen'];

            return $returndata;
        }

        public function modifyCharacter() {
            if (!empty($_POST)) {
                //var_dump($_POST);
                //var_dump($_GET);
                $id = $_GET['id'];
        
                if (!$id) {
                    $this->view = 'error.php?e="No existe el ID"';
                    return;
                }
        
                $data = $this->getInfoCharacter();
        
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $data['image'] = $this->validateImage($_FILES['imagen'], $data);
                } else {
                    $data['image'] = null; // Si no se sube imagen nueva
                }
        
                // Llamar al modelo para actualizar
                if ($this->MPersonaje->modifyCharacter($id, $data['name'], $data['age'], $data['gender'], $data['description'], $data['image'])) {
                    header('Location: index.php?c=CPersonaje&a=viewListCharacter');
                    exit;
                } else {
                    $this->view = 'error.php?e="No se pudo modificar el personaje"';
                }
            }
        }
        
        
    }
?>