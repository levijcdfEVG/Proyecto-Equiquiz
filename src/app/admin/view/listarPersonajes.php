<div class="ABMPersonaje">
    <nav>
        <a href="index.php">Volver</a>
        <h2>Listado de Personajes</h2>
    </nav>
    <label for="PersonajesAntiguos">
        Personajes Antiguos
        <input type="checkbox">
    </label>

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
                    <a href="index.php?c=CPersonaje&a=viewmodifyCharacter&id=<?php echo $character['idPersonaje'] ?>">
                        <i class="fas fa-edit modificar"></i>
                    </a>
                    <a href="index.php?c=CPersonaje&a=deleteCharacter&id=<?php echo $character['idPersonaje'] ?>">
                        <i class="fas fa-trash basura"></i>
                    </a>
                </div>
                <?php
            }
        } else {
            ?>
            <p class="noPersonaje">No hay personajes disponibles.</p>
            <?php
        }
    } else {
        ?>
        <p class="noPersonaje">No hay personajes disponibles.</p>
        <?php
    }
    ?>
</div>
