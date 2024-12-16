<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Punto de Interés</title>
</head>
<body>
    <h1>Modificar Punto de Interés</h1>
    <form action="CPuntosInteres.php?action=modificarPuntoInteres" method="POST">
        <input type="hidden" name="idEscenario" value="<?= htmlspecialchars($_GET['idEscenario']) ?>">
        <input type="hidden" name="ptXAntigua" value="<?= htmlspecialchars($_GET['ptX']) ?>">
        <input type="hidden" name="ptYAntigua" value="<?= htmlspecialchars($_GET['ptY']) ?>">
        <label for="ptX">Nueva Coordenada X:</label>
        <input type="number" id="ptX" name="ptX" step="0.01" required><br>
        <label for="ptY">Nueva Coordenada Y:</label>
        <input type="number" id="ptY" name="ptY" step="0.01" required><br>
        <button type="submit">Modificar</button>
    </form>
</body>
</html>
