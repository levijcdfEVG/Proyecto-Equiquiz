<?php
    
    class CAñadirMapa{
        private $objmRecogerFormClass;

        public function __construct() {
            require_once("../model/mrecogerFormClass.php");
            require_once("../config/config_db.php");
            $mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
            $this->objmRecogerFormClass = new MRecogerFormClass($mysqli);
        }
        
        public function cSubirImagen($img,$ambito){
            if(isset($_POST["ambito"]) && isset($_FILES["img"])){
                $ambito = $_POST["ambito"];
                $img = $_FILES['img']['name'];

                // Verifica si el archivo se ha subido correctamente 
                if ($_FILES["img"]["error"] !== UPLOAD_ERR_OK) {
                    return "Error al subir la imagen.";
                }
                // Verificar el tipo de archivo
                $permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!in_array($_FILES["img"]["type"], $permitidos)) {
                    return "Tipo de archivo no permitido. Solo se permiten imágenes JPEG, JPG y PNG.";
                }
            }

            $resultado = $this->objmRecogerFormClass->subirImagen($ambito, $img);
            if($resultado){
                return true;
            }else{
                return false;
            }
        }

    }
?>