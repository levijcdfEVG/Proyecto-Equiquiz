<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Punto de Interés</title>
</head>
<body>
    <h1>Añadir Punto de Interés</h1>
    <form action="index.php?c=CPuntosInteres&a=addPoint " method="POST" enctype="multipart/form-data">
        <label for="idEscenario">ID del Escenario:</label>
        <input type="number" id="idEscenario" name="idEscenario"><br>
        <label for="ptX">Coordenada X:</label>
        <input type="number" id="ptX" name="ptX"><br>
        <label for="ptY">Coordenada Y:</label>
        <input type="number" id="ptY" name="ptY"><br>
        <button type="submit">Crear</button>
    </form>
</body>
</html>
