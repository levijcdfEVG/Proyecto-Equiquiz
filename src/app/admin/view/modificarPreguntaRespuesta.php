<?php
$idPregunta = $this->data['pregunta']['idPregunta'];
$pregunta = $this->data['pregunta']['pregunta'];
$respuestas = $this->data['respuestas'];
?>
<div id="contenedor">
    <h1>Modificar Pregunta/Respuestas</h1>
    <form class="form-contenedor" action="index.php?c=CPreguntas&a=modifyQuestion" method="POST">
        <input type="hidden" name="idPregunta" value="<?php echo $idPregunta; ?>">
        <div class="input-group">
            <label for="pregunta">Pregunta</label>
            <textarea class="respuestas" rows="4" name="pregunta"><?php echo htmlspecialchars($pregunta); ?></textarea>
        </div>
        <?php foreach ($respuestas as $index => $respuesta): ?>
        <div class="input-group">
            <label for="respuesta<?php echo $index + 1; ?>">Respuesta <?php echo $index + 1; ?></label>
            <textarea class="respuestas" rows="4" name="respuestas[]"><?php echo htmlspecialchars($respuesta['contenidos']); ?></textarea>
            <input type="radio" name="correcta" value="<?php echo $index + 1; ?>" <?php echo $respuesta['correcta'] ? 'checked' : ''; ?>>
        </div>
        <?php endforeach; ?>
        <div id="button-group">
            <button type="button" class="btn volver">Volver</button>
            <button type="submit" class="btn modificar">Modificar</button>
        </div>
    </form>
</div>