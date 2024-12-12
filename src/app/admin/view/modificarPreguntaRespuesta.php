<?php
$idPregunta = (int)$_GET['id'];

$data = $objController->$action($idPregunta);
$pregunta = $data['pregunta'];
$respuestas = $data['respuestas'];
?>

<div id="contenedor">
    <h1>Modificar Pregunta/Respuestas</h1>
    <div id="form-contenedor">
        <div class="input-group">
            <label for="pregunta">Pregunta</label>
            <textarea class="respuestas" rows="4"><?php echo htmlspecialchars($pregunta); ?></textarea>
        </div>
        <?php foreach ($respuestas as $index => $respuesta): ?>
        <div class="input-group">
            <label for="respuesta<?php echo $index + 1; ?>">Respuesta <?php echo $index + 1; ?></label>
            <textarea class="respuestas" rows="4"><?php echo htmlspecialchars($respuesta['contenidos']); ?></textarea>
        </div>
        <?php endforeach; ?>
    </div>
    <div id="button-group">
        <button class="btn volver">Volver</button>
        <button class="btn modificar">Modificar</button>
    </div>
</div>