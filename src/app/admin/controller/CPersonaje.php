<?php
    class CPersonaje {
        private $MPersonaje;
        public $view;
        public $title;

        /**
         * Summary of __construct
         * 
         * En el constructor se inicializa el modelo Personaje.
         */
        public function __construct() {
            require_once 'config/config.php';
            // Requerimos de la clase del modelo.
            require_once 'model/MPersonaje.php';
            $this->MPersonaje = new MPersonaje();
        }

        /**
         * Summary of viewAddCharacter
         * 
         * Se asigna al titulo de la pagina Añadir Personaje.
         * Se asigna a la vista la pagina Añadir Personajes.
         * @return void No devuelve nada.
         */
        public function viewAddCharacter() {
            $this->title = 'Añadir Personaje';
            $this->view = 'añadirPersonaje.php';
        }

        /**
         * Summary of viewListCharacter
         * 
         * Se asigna al titulo de la pagina Listar Personajes.
         * Se asigna a la vista la pagina a Listar Personajes.
         * 
         * Se obtienen todos los personajes y se almacenan en un variable $characters para poder ser usada en la vista.
         * @return void No devuelve nada.
         */
        public function viewListCharacter() {
            $this->title = 'Listado de Personaje';
            $this->view = 'listarPersonajes.php';

            //Obtengo todos los personajes
            $characters = $this->MPersonaje->getAllCharacters();

            require_once VIEWPATHADMIN.$this->view;
        }

        /**
         * Summary of gatewayAdd
         * 
         * Se asigna al titulo de la pagina Panel Admin.
         * Se asigna a la vista la pagina a Panel del admin con el aside de mas opciones de añadir.
         * @return void No devuelve nada.
         */
        public function gatewayAdd() {
            $this->title = 'Panel Aministrador';
            $this->view = 'unionAñadir.php';
        }

        /**
         * Summary of gatewayList
         * 
         * Se asigna al titulo de la pagina Panel Admin.
         * Se asigna a la vista la pagina a Panel del admin con el aside de mas opciones de listar.
         * @return void No devuelve nada.
         */
        public function gatewayList() {
            $this->title = 'Panel Aministrador';
            $this->view = 'unionListar.php';
        }

        public function viewRecovery() {
            $this->title = 'Recuperar Personaje';
            $this->view = 'recuperarPersonaje.php';

            $characters = $this->MPersonaje->getAllOldCharacters();

            require_once VIEWPATHADMIN . $this->view;
        }

        /**
         * Summary of viewModifyCharacter
         * 
         * Se asigna al titulo de la pagina Modificar Personaje.
         * Se asigna a la vista la pagina a modificarPersonaje.
         * 
         * Recoge por URL la id del personaje a modificar.
         * 
         * El metodo obtiene la informacion del personaje que pertenezca a ese id.
         * Puedes hacer uso de la variable $parseData que tiene la informacion de los campos del personaje.
         * @return void No devuelve nada
         */
        public function viewModifyCharacter() {
            $this->title = 'Modificar Personaje';
            $this->view = 'modificarPersonaje.php';
        
            if (isset($_GET['id'])) {
                $data = $this->MPersonaje->getInfoviewModify($_GET['id']);
                
                if ($data) {
                    $parseData = $this->getInfoData($data);
                } else {
                    $this->view = 'index.php?error=No se encontró el personaje seleccionado';
                }
            } else {
                $this->view = 'index.php?error=Al modificar no se pudo obtener su ID';
            }
        
            require_once VIEWPATHADMIN . $this->view;
        }
        
        /**
         * Summary of addCharacter
         * 
         * Método que añade un personaje a la Bd.
         * 
         * El método obtiene la info del personaje, valida la imagen que sean las extensiones validas.
         * @return void No devuelve nada.
         */
        public function addCharacter() {
            if (!empty($_POST)) {
                // var_dump($_POST);
        
                $data = $this->getInfoCharacter();
        
                if (isset($_FILES['imagen'])) {
                    $data['image'] = $this->validateImage($_FILES['imagen'], $data);
                }
        
                if ($this->MPersonaje->addCharacter($data['name'], $data['age'], $data['gender'], $data['description'], $data['image'])) {
                    header('location: index.php');
                } else {
                    header('location: index.php?error=Error al añadir personaje');
                }
            }
        }

        /**
         * Summary of getInfoCharacter
         * 
         * Obtiene la info del personaje por $_POST.
         * @return array Devuelve un array con los datos del personaje.
         */
        private function getInfoCharacter() {
            $data = [];
            $data['name'] = isset($_POST['nombre']) ? $_POST['nombre'] : 'NULL';
            $data['age'] = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
            $data['gender'] = isset($_POST['genero']) ? $_POST['genero'] : 'No indicado';
            $data['description'] = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $data['image'] = null; // Por si no añade imagen.
            
            return $data;
        }

        /**
         * Summary of getInfoCharacterModify
         * 
         * Obtiene la info del personaje a modificar para pasarlos a un array. Para validar que todos los campos vengan rellenos y si no rellenar por defecto con los que tenia antes.
         * @param mixed $info Se le pasa la informacion del personaje obtenida de la consulta.
         * @return array Devuelve el array del personaje para visualizarlo en el modificador de personaje.
         */
        private function getInfoCharacterModify($info) {
            $data = [];
            $data['name'] = !empty($_POST['nombre']) ? $_POST['nombre'] : $info['nombre'];
            $data['age'] = !empty($_POST['edad']) ? (int)$_POST['edad'] : $info['edad'];
            $data['gender'] = !empty($_POST['genero']) ? $_POST['genero'] : $info['genero'];
            $data['description'] = !empty($_POST['descripcion']) ? $_POST['descripcion'] : $info['descripcion'];
            $data['image'] = $info['urlImagen']; // Por si no añade imagen.
        
            return $data;
        }
        

        /**
         * Summary of validateImage
         * 
         * Método para validar imagenes y moverlas a la carpeta para guardarlas.
         * Los permitidos son jpeg, jpg, png.
         * 
         * @param mixed $image Imagen adjuntada en el formulario.
         * @param mixed $data Los datos del personaje para poder crear el nombre unico de la imagen con el nombre del personaje
         * @return string|null Puede devolver la ruta de la imagen donde ha sido guardada mas el nombre de ella o si da error devuelve null.
         */
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
                    } else {
                        header('location: index.php?error=No se pudo mover la imagen');
                        exit;
                    }
                } else {
                    header('location: index.php?error=La extensión de la imagen no es válido');
                    exit;
                }
            } else {
                header('location: index.php?error=No se selecciono ninguna imagen o hubo error en la subida');
                exit;
            }
        }
        

        /**
         * Summary of getInfoData
         * 
         * Método que crea un array para guardar los datos del personaje consultado a la base de datos.
         * @param mixed $data Recibe la fila de los datos del personaje.
         * @return array Devuelve el array con los datos.
         */
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

        /**
         * Summary of modifyCharacter
         * 
         * Motodo para modificar un personaje.
         * Valida que la imagen sea subida correctamente y hace la consulta.
         * @return void No devuelve nada.
         */
        public function modifyCharacter() {
            if (!empty($_POST)) {
                //var_dump($_POST);
                //var_dump($_GET);
                $id = $_GET['id'];
        
                if (!$id) {
                    $this->view = 'error.php?e="No existe el ID"';
                    return;
                }
                $data = $this->MPersonaje->getInfoviewModify($id);
                $data = $this->getInfoCharacterModify($data['edad']);
        
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $data['image'] = $this->validateImage($_FILES['imagen'], $data);
                } else {
                    $data['image'] = $data['urlImagen']; // Si no se sube imagen nueva se queda la anterior.
                }
        
                // Llamar al modelo para actualizar
                if ($this->MPersonaje->modifyCharacter($id, $data['name'], $data['age'], $data['gender'], $data['description'], $data['image'])) {
                    header('Location: index.php?c=CPersonaje&a=viewListCharacter');
                    exit;
                } else {
                    header('location: index.php?error=Error al modificar el personaje');
                }
            }
        }
        
        /**
         * /
         * Establece el titulo de la pagina y la vista que queremos visualizar comprueba si por URL le llega el ID del personaje a borrar.
         * Si tiene el ID borra el personaje con ese ID.
         * 
         * @return void No devuelve nada.
         */
        public function deleteCharacter() {
            $this->title = 'Listar Personaje';
            $this->view = 'listarPersonajes.php';
        
            if (isset($_GET['id'])) {
                $this->MPersonaje->deleteCharacter($_GET['id']);
                $this->viewListCharacter();
            }
        }

        /**
         * Summary of recoveryCharacter
         * 
         * Metodo para recuperar un personaje.
         * @return void No devuelve nada.
         */
        public function recoveryCharacter() {
            $id = $_GET['id'];

            if (!$id) {
                $this->view = 'error.php?e="No existe el ID"';
                return;
            } else {
                $this->MPersonaje->recoveryCharacter($id);
                header('Location: index.php?c=CPersonaje&a=viewRecovery');
                exit;
            }
        }
    }
?>