<div id="modfPreguntas">
    <nav>
        <a href="panelAdmin.html">Volver</a>
        <h2>Modificar Preguntas/Respuestas</h2>
    </nav>
    <section>
    <?php
        require_once '../../controller/CPreguntas.php';

        $controller = new CPreguntas();
        $preguntas = $controller->getQuestionData();

        foreach ($preguntas as $idPregunta => $pregunta) {
            echo '<article class="preguntas">';
            echo '<p>' . htmlspecialchars($pregunta['pregunta']) . '</p>';
            echo '<i class="fas fa-edit modificar" data-id="' . $idPregunta . '"></i>';
            echo '<i class="fas fa-trash basura" data-id="' . $idPregunta . '"></i>';
            echo '</article>';
        }
    ?>
    </section>
</div>
