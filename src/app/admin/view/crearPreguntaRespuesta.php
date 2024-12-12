<div id="container">
    <h1>Añadir Pregunta</h1>
    <form class="form-container" action="index.php?c=CPreguntas&a=addQuestion" method="POST">
        <div class="crear-input-group">
            <label for="pregunta">Pregunta</label>
            <textarea class="textarea" id="pregunta" name="pregunta" rows="2"></textarea>
        </div>
        <div class="crear-input-group respuesta-group">
            <label for="respuesta">Respuesta/s</label>
            <div id="contenedorDeRespuestas" class="respuesta-container">
                <input type="text" id="respuestas1" name="respuestas[]" required>
                <input type="radio" id="correcta1" name="correcta" value="1">
            </div>
            <button type="button" id="aniadirRespuestas" class="add-btn">+</button>
            <button type="button" id="quitarRespuestas" class="add-btn">-</button>
        </div>
        <div class="crear-input-group">
            <label for="escenario">Escenario</label>
            <select id="escenario" name="escenario">
                <option value="1">Escenario 1</option>
                <option value="2">Escenario 2</option>
                <option value="3">Escenario 3</option>
            </select>
        </div>
        <div id="button-group">
            <button type="button" class="btn volver">Volver</button>
            <button type="submit" id="submitButton" class="btn añadir">Añadir</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="../admin/view/js/validarInsercionPregunta.js"></script>
