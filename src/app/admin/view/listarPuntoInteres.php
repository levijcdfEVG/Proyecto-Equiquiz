<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Puntos de Interés</title>
</head>
<body>
    <h1>Lista de Puntos de Interés</h1>
        <?php
    if(isset($points)){
        if ($points && $points->rowCount() > 0) {
            // Iteramos sobre los personajes
            while ($points = $points->fetch(PDO::FETCH_ASSOC)) {
                // echo $character['urlImagen'];
                ?>
                <div>
                    <span><?php echo $points['ptX']; ?></span>
                    <a href="index.php?c=CPuntosInteres&a=viewModifyPoint&id=<?php echo $points['idEscenario'] ?>">
                        <i class="fas fa-edit modificar"></i>
                    </a>
                    <a href="index.php?c=CPuntosInteres&a=deletePoint&id=<?php echo $points['idEscenario'] ?>">
                        <i class="fas fa-trash basura"></i>
                    </a>
                </div>
                <?php
            }
        } else {
            ?>
            <p>No hay puntos de interes disponibles.</p>
            <?php
        }
    } else {
        ?>
        <p>No hay puntos de interes disponibles.</p>
        <?php
    }
    ?>
</body>
</html>
