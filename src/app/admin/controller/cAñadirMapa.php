<?php
    
    class CAñadirMapa {
        private $objmRecogerFormClass;
    
        public function __construct() {
            require_once("../model/mrecogerFormClass.php");
            $this->objmRecogerFormClass = new MRecogerFormClass(); 
        }
    
        public function cSubirImagen(){
            $text = "";
            $ambito = ""; 
            $img = "";

            if(isset($_POST["ambito"]) && isset($_FILES["img"])){
                $img = $_FILES['img']['name'];
    
                // Verifica si el archivo se ha subido correctamente
                if (empty($text) && $_FILES["img"]["error"] !== UPLOAD_ERR_OK) {
                    $text = "No existe imagen adjunta.";
                }
                // Verificar el tipo de archivo
                $permitidos = ['image/jpeg', 'image/jpg', 'image/png'];
                if (empty($text) && !in_array($_FILES["img"]["type"], $permitidos)) {
                    $text = "Tipo de archivo no permitido. Solo se permiten imágenes JPEG, JPG y PNG.";
                }
            } else {
                $text = "No existe ambito seleccionado";
            }
    
            if(!empty($text)){
                return $text;
            }else{
                $resultado = $this->objmRecogerFormClass->subirImagen($ambito, $img);
                if($resultado){
                    return true;
                }else{
                    return "Error al guardar la imagen";
                }
            }
        }
    }
    
?>