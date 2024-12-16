<div id="modfPreguntas">
    <nav>
        <a href="index.php">Volver</a>
        <h2>Modificar Preguntas/Respuestas</h2>
    </nav>
    <section>
    <?php
        $preguntas =  $objController->$action();
        if (isset($preguntas) && is_array($preguntas)) {
            foreach ($preguntas as $idPregunta => $pregunta) {
                echo "<article class='preguntas'>";
                echo "<p>{$pregunta['pregunta']}</p>";
                echo "<a href='index.php?c=CPreguntas&a=showModify&id={$idPregunta}'><i class='fas fa-edit modificar' data-id='{$idPregunta}'></i></a>";
                echo "<a id='basura' href='index.php?c=CPreguntas&a=showDelete&id={$idPregunta}'><i class='fas fa-trash basura'  data-id='{$idPregunta}'></i></a>";
                echo "</article>";
            }
        } else {
            echo "<p>No hay preguntas disponibles.</p>";
        }
    ?>
    </section>
</div>
