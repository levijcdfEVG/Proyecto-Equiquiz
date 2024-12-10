<?php
    // var_dump($parseData);
?>
<div id="addPersonBg">
    <nav>
        <a href="index.php?c=CPersonaje&a=viewListCharacter">Volver</a>
        <h2>Modificar <?php echo $parseData['name'] ?></h2>
    </nav>
    <form action="index.php?c=CPersonaje&a=modifyCharacter&id=<?php echo $parseData['id']?>" method="POST" class="formPersonajes" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $parseData['name'] ?>">
        
        <label for="edad">Edad:</label>
        <input type="number" name="edad" value="<?php echo $parseData['age'] ?>">
        
        <label for="genero">Género:</label>
        <!-- Falta que el genero se seleccion preguntar isa -->
        <div class="genero">
            <label for="hombre">H</label>
            <input type="radio" id="hombre" name="genero" value="Hombre" <?php if($parseData['gender'] === 'Hombre') echo 'checked' ?>>
            <label for="mujer">M</label>
            <input type="radio" id="mujer" name="genero" value="Mujer" <?php if($parseData['gender'] === 'Mujer') echo 'checked' ?>>
        </div>
        
        <label for="imagen">Imagen Jugador</label>
        <?php 
            if (!empty($parseData['imageUrl'])) {
                echo '<img src="' . $parseData['imageUrl'] . '" alt="Imagen actual" width="30">';
            }
        ?>
        <input type="file" name="imagen">
        
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"> <?php echo $parseData['description'] ?></textarea>
        
        <input type="submit" value="Modificar">
    </form>
</div>
<script src="../../../js/validAñadirModifi.js"></script>