<div id="modfPreguntas">
    <nav>
        <a href="index.php">Volver</a>
        <h2>Modificar Preguntas/Respuestas</h2>
    </nav>
    <section>
    <?php
        if (isset($preguntas) && is_array($preguntas)) {
            foreach ($preguntas as $idPregunta => $pregunta) {
                echo "<article class='preguntas'>";
                echo "<p>{$pregunta['pregunta']}</p>";
                echo "<i class='fas fa-edit modificar' data-id='{$idPregunta}'></i>";
                echo "<i class='fas fa-trash basura' data-id='{$idPregunta}'></i>";
                echo "</article>";
            }
        } else {
            echo "<p>No hay preguntas disponibles.</p>";
        }
    ?>
    </section>
</div>
