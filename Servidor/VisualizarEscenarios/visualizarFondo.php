<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            <?php
                //Establece la imagen de fondo utilizando la ruta  en el parámetro GET 'rutaImg'
                echo 'background-image: url('.$_GET["rutaImg"].');';
            ?> 
        }
        
    </style>
</head>
<body>
</body>
</html>