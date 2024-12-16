<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Punto de Interés</title>
</head>
<body>
    <h1>Modificar Punto de Interés</h1>
    <div>
        <p>Id del Escenario Anterior: <?= htmlspecialchars($_GET['id']);
        $idEscenario = (int)$_GET['id'];?>
        </p>
        <p>Coordenada X anterior:
            <?php echo isset($_GET['ptX']) ? htmlspecialchars($_GET['ptX']) : 'No disponible'; 
            $ptXAntiguo = (float)$_GET['ptX'];?>
        </p>
        <p>Coordenada Y anterior:
            <?php echo isset($_GET['ptY']) ? htmlspecialchars($_GET['ptY']) : 'No disponible'; 
            $ptYAntiguo = (float)$_GET['ptY'];?>
        </p>
    </div>
    <form action="index.php?c=CPuntosInteres&a=modifyPoint&id=<?php $idEscenario; ?>&ptXAntiguo=<?php $ptXAntiguo; ?>&ptYAntiguo=<?php $ptYAntiguo; ?>" method="POST">
        <label for="ptX">Nueva Coordenada X:</label>
        <input type="number" id="ptX" name="ptX"><br>
        <label for="ptY">Nueva Coordenada Y:</label>
        <input type="number" id="ptY" name="ptY"><br>
        <button type="submit">Modificar</button>
    </form>
</body>
</html>
