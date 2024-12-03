    <?php 
        require_once 'head.php';
    ?>
        <div class="ABMPersonaje">
            <nav>
                <a href="panelAdmin.html">Volver</a>
                <h2>Listado de Personajes</h2>
            </nav>
            <label for="">
                Personajes Antiguos
                <input type="checkbox">
            </label>
            <div>
                <img src="../assets/img/luis.png" alt="Imagen personaje">
                <span>Luis</span>
                <a href="modificarParte2.html">
                    <i class="fas fa-edit modificar"></i> <!-- Pasar por url el nombre del personaje en un futuro -->
                </a>
                <a href="panelAdmin.html"> <!-- Cambiar por la página de eliminar -->
                    <i class="fas fa-trash basura"></i>
                </a>
            </div>
            <div>
                <img src="../assets/img/martina.png" alt="Imagen personaje">
                <span>Martina</span>
                <a href="modificarParte2.html"> <!-- Pasar por url el nombre del personaje en un futuro -->
                    <i class="fas fa-edit modificar"></i>
                </a>
                <a href="panelAdmin.html"> <!-- Cambiar por la página de eliminar -->
                    <i class="fas fa-trash basura"></i>
                </a>
            </div>
        </div>
    </body>
</html>