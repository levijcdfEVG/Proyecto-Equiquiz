<?php

//Verificar el estado del envio de datos.
if( $objController->$action()){
    echo "<script>alert('Pregunta añadida correctamente');</script>";
}else{
    echo "<script>alert('Error al añadir la pregunta');</script>";
}

echo "<p><a href='index.php?c=CPreguntas&a=showAdd'>Volver</a></p>";
