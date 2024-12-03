<?php require_once 'head.php'?>
    <div id="addPersonBg">
        <nav>
            <a href="panelAdmin.html">Volver</a>
            <h2>Añadir Personaje</h2>
        </nav>
        <form action="../controller/CPersonaje.php" method="POST" class="formPersonajes">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" placeholder="Introduce Nombre Personaje" required>
            
            <label for="edad">Edad:</label>
            <input type="number" name="edad" placeholder="Opcional">
            
            <label for="genero">Género:</label>
            <div class="genero">
                <label for="hombre">H</label>
                <input type="radio" id="hombre" name="genero" value="Hombre" >
                <label for="mujer">M</label>
                <input type="radio" id="mujer" name="genero" value="Mujer" >
            </div>
            
            <label for="imagen">Imagen Jugador</label>
            <input type="file" name="imagen">
            
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required></textarea>
            
            <input type="submit" value="Añadir">
        </form>
    </div>
<?php require_once 'footer.php'?>
