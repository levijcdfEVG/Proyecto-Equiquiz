<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Puntos de Interés</title>
</head>
<body>
    <h1>Lista de Puntos de Interés</h1>
    <?php
    // Mostrar los datos para depuración
    // var_dump($points);

    // Verificar si $points tiene datos y si contiene filas
    if (isset($points) && $points->rowCount() > 0) {
        ?>
        <?php while ($point = $points->fetch(PDO::FETCH_ASSOC)): ?>
            <div>
                <span><?php echo htmlspecialchars($point['ptX']); ?></span>
                <span><?php echo htmlspecialchars($point['ptY']); ?></span>
                <a href="index.php?c=CPuntosInteres&a=viewModifyPoint&id=<?php echo htmlspecialchars($point['idEscenario']); ?>&ptX=<?php echo urlencode($point['ptX']); ?>&ptY=<?php echo urlencode($point['ptY']); ?>">
                    <i class="fas fa-edit modificar"></i>
                </a>
                <a href="index.php?c=CPuntosInteres&a=deletePoint&id=<?php echo htmlspecialchars($point['idEscenario']); ?>">
                    <i class="fas fa-trash basura"></i>
                </a>
            </div>
        <?php endwhile; ?>
        <?php
    } else {
        // Mensaje si no hay puntos de interés disponibles
        ?>
        <p>No hay puntos de interés disponibles.</p>
        <?php
    }
    ?>
</body>
</html>
