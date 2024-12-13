<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/stylezeus.css">
    <title>Resultado</title>
</head>
<body>
    <div id="addPersonBg">
        <?php
            if(is_bool($resultado) && $resultado){
                echo '<p>Imagen subida correctamente</p>';
            }else{
                echo '<p>'.$resultado.'</p>';
            }
        ?>
        <a href="../view/añadirMapa.html">Volver</a>
    </div>
</body>
</html>