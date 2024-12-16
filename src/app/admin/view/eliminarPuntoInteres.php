<!-- eliminar_punto_interes.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Punto de Interés</title>
</head>
<body>
    <h1>Eliminar Punto de Interés</h1>

    <!-- Mensaje de confirmación -->
    <p>¿Estás seguro de que deseas eliminar el punto de interés con las siguientes coordenadas?</p>

    <div>
        <?php 
            echo '<p><strong>Coordenada X:</strong> ' . htmlspecialchars($ptX) . '</p>';
            echo '<p><strong>Coordenada Y:</strong> ' . htmlspecialchars($ptY) . '</p>';
        ?>
    </div>

    <!-- Formulario para eliminar el punto de interés -->
    <form method="POST" action="index.php?controller=PuntosInteres&action=eliminar">
        <?php 
            echo '<input type="hidden" name="idEscenario" value="' . htmlspecialchars($idEscenario) . '">';
            echo '<input type="hidden" name="ptX" value="' . htmlspecialchars($ptX) . '">';
            echo '<input type="hidden" name="ptY" value="' . htmlspecialchars($ptY) . '">';
        ?>

        <div>
            <button type="submit">Confirmar Eliminación</button>
        </div>
    </form>

    <!-- Enlace para volver al listado de puntos de interés -->
    <a href="index.php?controller=PuntosInteres&action=listar">Volver a la lista</a>
</body>
</html>
