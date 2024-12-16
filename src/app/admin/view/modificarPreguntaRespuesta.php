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
            <textarea class="textarea" id="pregunta" name="pregunta" rows="2" required><?php echo htmlspecialchars($pregunta); ?></textarea>
        </div>
        <div class="crear-input-group respuesta-group">
            <label for="respuesta">Respuesta/s</label>
            <div id="contenedorDeRespuestas" class="respuesta-container">
                <?php for ($i = 0; $i < 4; $i++): ?>
                    <div class="respuesta-item">
                        <input type="text" id="respuestas<?php echo $i + 1; ?>" name="respuestas[]" value="<?php echo isset($respuestas[$i]) ? htmlspecialchars($respuestas[$i]['contenidos']) : ''; ?>" <?php echo $i < 2 ? 'required' : ''; ?>>
                        <input type="radio" id="correcta<?php echo $i + 1; ?>" name="correcta" value="<?php echo $i + 1; ?>" <?php echo isset($respuestas[$i]) && $respuestas[$i]['esCorrecto'] ? 'checked' : ''; ?>>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="crear-input-group">
            <label for="escenario">Escenario</label>
            <select id="escenario" name="escenario" required>
                <option value="1" <?php echo $data['pregunta']['idEscenario'] == 1 ? 'selected' : ''; ?>>Educacion</option>
                <option value="2" <?php echo $data['pregunta']['idEscenario'] == 2 ? 'selected' : ''; ?>>Empleo</option>
                <option value="3" <?php echo $data['pregunta']['idEscenario'] == 3 ? 'selected' : ''; ?>>Salud</option>
            </select>
        </div>
        <div id="button-group">
            <button type="button" class="btn volver" id="volver">Volver</button>
            <button type="submit" id="submitButton" class="btn modificar">Modificar</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="../admin/view/js/validarInsercionPregunta.js"></script>
