<div id="container">
    <h1>Añadir Pregunta</h1>
    <form class="form-container" action="index.php?c=CPreguntas&a=addQuestion" method="POST">
        <div class="crear-input-group">
            <label for="pregunta">Pregunta</label>
            <textarea class="textarea" id="pregunta" name="pregunta" rows="2" required></textarea>
        </div>
        <div class="crear-input-group respuesta-group">
            <label for="respuesta">Respuesta/s</label>
            <div id="contenedorDeRespuestas" class="respuesta-container">
                <div class="respuesta-item">
                    <input type="text" id="respuestas1" name="respuestas[]" required>
                    <input type="radio" id="correcta1" name="correcta" value="1" required>
                </div>
                <div class="respuesta-item">
                    <input type="text" id="respuestas2" name="respuestas[]" required>
                    <input type="radio" id="correcta2" name="correcta" value="2" required>
                </div>
                <div class="respuesta-item">
                    <input type="text" id="respuestas3" name="respuestas[]">
                    <input type="radio" id="correcta3" name="correcta" value="3">
                </div>
                <div class="respuesta-item">
                    <input type="text" id="respuestas4" name="respuestas[]">
                    <input type="radio" id="correcta4" name="correcta" value="4">
                </div>
            </div>
        </div>
        <div class="crear-input-group">
            <label for="escenario">Escenario</label>
            <select id="escenario" name="escenario" required>
                <option value="1">Escenario 1</option>
                <option value="2">Escenario 2</option>
                <option value="3">Escenario 3</option>
            </select>
        </div>
        <div id="button-group">
            <button type="button" class="btn volver" id="volver">Volver</button>
            <button type="submit" id="submitButton" class="btn añadir">Añadir</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="../admin/view/js/validarInsercionPregunta.js"></script>