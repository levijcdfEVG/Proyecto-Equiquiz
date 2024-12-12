<div id="resultadoBorrado">
    <h1>Resultado de la eliminación:</h1>
    <?php if ($objController->resultado): ?>
        <p>La pregunta ha sido eliminada correctamente.</p>
    <?php else: ?>
        <p>No se ha podido eliminar la pregunta.</p>
    <?php endif; ?>
    <a href="index.php?c=CPreguntas&a=showQuestions">Volver al listado de preguntas</a>
</div>