<div id="contenedor">
    <h1>Modificar Puntos de Interes</h1>
    <div id="form-contenedor">
        <?php
        $data =  $objController->$action();
        $pregunta = $data['pregunta'];
        $respuestas = $data['respuestas'];
        ?>
        <div class="input-group">
            <label for="pregunta">Pregunta</label>
            <textarea id="pregunta" rows="4"><?php echo htmlspecialchars($pregunta['contenido']); ?></textarea>
        </div>
        <?php foreach ($respuestas as $index => $respuesta): ?>
            <div class="input-group">
                <label for="respuesta<?php echo $index + 1; ?>">Respuesta <?php echo $index + 1; ?></label>
                <textarea id="respuesta<?php echo $index + 1; ?>" rows="4"><?php echo htmlspecialchars($respuesta['contenido']); ?></textarea>
            </div>
        <?php endforeach; ?>
        </div>
        <div id="button-group">
            <button class="btn volver">Volver</button>
            <button class="btn modificar">Modificar</button>
        </div>
        </div>
<script type="text/javascript" src="/src/app/admin/view/js/validarModificacion.js"></script>