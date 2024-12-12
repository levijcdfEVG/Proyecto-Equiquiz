<?php
$data = $objController->$action();

if (!isset($data) || empty($data)) {
    echo "No se encontraron datos.";
    exit;
}

$idPregunta = $data['pregunta']['idPregunta'];
$pregunta = $data['pregunta']['contenido_P'];
$respuestas = $data['respuestas'];
?>
<div id="container">
    <h1>Modificar Pregunta</h1>
    <form class="form-container" action="index.php?c=CPreguntas&a=modifyQuestion" method="POST">
        <input type="hidden" name="idPregunta" value="<?php echo $idPregunta; ?>">
        <div class="crear-input-group">
            <label for="pregunta">Pregunta</label>
            <textarea class="textarea" id="pregunta" name="pregunta" rows="2"><?php echo htmlspecialchars($pregunta); ?></textarea>
        </div>
        <div class="crear-input-group respuesta-group">
            <label for="respuesta">Respuesta/s</label>
            <div id="contenedorDeRespuestas" class="respuesta-container">
                <?php foreach ($respuestas as $index => $respuesta): ?>
                <div class="respuesta-item">
                    <input type="text" id="respuestas<?php echo $index + 1; ?>" name="respuestas[]" value="<?php echo htmlspecialchars($respuesta['contenidos']); ?>" required>
                    <input type="radio" id="correcta<?php echo $index + 1; ?>" name="correcta" value="<?php echo $index + 1; ?>" <?php echo $respuesta['esCorrecto'] ? 'checked' : ''; ?>>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="button" id="aniadirRespuestas" class="add-btn">+</button>
            <button type="button" id="quitarRespuestas" class="add-btn">-</button>
        </div>
        <div class="crear-input-group">
            <label for="escenario">Escenario</label>
            <select id="escenario" name="escenario">
                <option value="1" <?php echo $data['pregunta']['idEscenario'] == 1 ? 'selected' : ''; ?>>Escenario 1</option>
                <option value="2" <?php echo $data['pregunta']['idEscenario'] == 2 ? 'selected' : ''; ?>>Escenario 2</option>
                <option value="3" <?php echo $data['pregunta']['idEscenario'] == 3 ? 'selected' : ''; ?>>Escenario 3</option>
            </select>
        </div>
        <div id="button-group">
            <button type="button" class="btn volver">Volver</button>
            <button type="submit" id="submitButton" class="btn modificar">Modificar</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="../admin/view/js/validarInsercionPregunta.js"></script>