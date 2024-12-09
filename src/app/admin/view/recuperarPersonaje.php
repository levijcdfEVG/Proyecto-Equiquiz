<div class="ABMPersonaje">
    <nav>
        <a href="index.php">Volver</a>
        <h2>Recuperar Personaje</h2>
    </nav>
    <?php
    if(isset($characters)){
        if ($characters && $characters->rowCount() > 0) {
            // Iteramos sobre los personajes
            while ($character = $characters->fetch(PDO::FETCH_ASSOC)) {
                // echo $character['urlImagen'];
                ?>
                <div>
                    <img src="<?php echo $character['urlImagen'];?>" alt="Imagen de <?php echo $character['nombre'];?>">
                    <span><?php echo $character['nombre']; ?></span>
                    <a href="index.php?c=CPersonaje&a=recoveryCharacter&id=<?php echo $character['idPersonaje'] ?>">
                        <i class="fas fa-arrow-up recuperar"></i>
                    </a>
                </div>
                <?php
            }
        } else {
            ?>
            <p>No hay personajes disponibles.</p>
            <?php
        }
    } else {
        ?>
        <p>No hay personajes disponibles.</p>
        <?php
    }
    ?>
</div>