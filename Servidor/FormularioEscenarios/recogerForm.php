<?php
    require_once("./config_db.php");
 
    $mysqli = new mysqli($servidor, $usuario, $contraseña, $basedatos);
   
    if(isset($_POST["ambito"]) && isset($_FILES["img"])){
        $ambito = $_POST["ambito"];
        $img = $_FILES['img']['name'];
        
        $directorio= "../../src/img/";
        $rutaImg = $directorio . basename($img); // Se utiliza para obtener el nombre del archivo de la imagen
        

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
        /*Formulario*/
    }

?>