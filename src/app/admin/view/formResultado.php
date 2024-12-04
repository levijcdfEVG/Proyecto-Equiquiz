<?php
    require_once("../controller/cAñadirMapa.php");
    $objcAñadirMapa = new CAñadirMapa();
    $resultado = $objcAñadirMapa->cSubirImagen($_FILES["img"], $_POST["ambito"]);
?>
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
            if($resultado){
                echo '<p>Imagen subida correctamente</p>';
            }else{
                echo '<p>Error</p>';
            }
        ?>
        <a href="../view/añadirMapa.html">Volver</a>
    </div>
</body>
</html>