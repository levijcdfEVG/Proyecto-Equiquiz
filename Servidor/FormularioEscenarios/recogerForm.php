<?php
    require_once("../Config/config_db.php");
 
    $mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
   
    //Verifica si se han enviado los datos del formulario
    if(isset($_POST["ambito"]) && isset($_FILES["img"])){
        $ambito = $_POST["ambito"];
        $img = $_FILES['img']['name'];

        // Donde se guardarán las imágenes
        $directorio= "../../src/img/";
        //Construye la ruta completa del archivo de imagen
        $rutaImg = $directorio . basename($img); // Se utiliza para obtener solo el nombre del archivo sin la ruta completa
        
        //Verifica si el archivo se ha subido correctamente
        if ($_FILES["img"]["error"] !== UPLOAD_ERR_OK) {
            return "Error al subir la imagen.";
        }

        //Verificar el tipo de archivo
        $permitidos = ['image/jpeg','image/jpg', 'image/png'];
        if (!in_array($_FILES["img"]["type"], $permitidos)) { //Comprobar si existe en el array
            echo "Tipo de archivo no permitido. Solo se permiten imágenes JPEG, JPG y PNG .";
            die;
        }

        //Mueve el archivo subido al directorio especificado
        if (move_uploaded_file($_FILES['img']['tmp_name'], $rutaImg)) { 
            $consulta = "INSERT INTO Escenarios (ambito, rutaImagen) VALUES ('".$ambito."','".$rutaImg."');";
    
            $resultado = $mysqli->query($consulta);

            if($resultado){
                echo "Imagen guardada correctamente";
            }else{
                echo "Error al guardar la imagen";
            }

        } else {
            echo "Error al subir la imagen";
        }
    }
?>