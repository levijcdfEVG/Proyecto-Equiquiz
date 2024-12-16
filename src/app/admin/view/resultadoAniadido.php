<div id="resultadoAñadido">
    <h1>Resultado de la adición</h1>
    <?php if ($objController->resultado): ?>
        <p>La pregunta ha sido añadida correctamente.</p>
    <?php else: ?>
        <p>No se ha podido añadir la pregunta.</p>
    <?php endif; ?>
    <a href="index.php?c=CPreguntas&a=showAdd">Volver a añadir preguntas</a>
    <a href="index.php?c=CPreguntas&a=showQuestions">Volver al listado de preguntas</a>
</div>