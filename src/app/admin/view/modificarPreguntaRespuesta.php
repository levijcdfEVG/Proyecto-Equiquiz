<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Pregunta/Respuestas</title>
    <link rel="stylesheet" href="/src/app/admin/assets/css/reset.css">
    <link rel="stylesheet" href="/src/app/admin/assets/css/preguntas.css">
</head>
<body id="cuerpo">
    <div id="contenedor">
        <h1>Modificar Pregunta/Respuestas</h1>
        <div id="form-contenedor">
            <div class="input-group">
                <label for="pregunta">Pregunta</label>
                <textarea id="pregunta" rows="4"></textarea>
            </div>
            <div class="input-group">
                <label for="respuesta1">Respuesta 1</label>
                <textarea id="respuesta1" rows="4"></textarea>
            </div>
            <div class="input-group">
                <label for="respuesta2">Respuesta 2</label>
                <textarea id="respuesta2" rows="4"></textarea>
            </div>
            <div class="input-group">
                <label for="respuesta3">Respuesta 3</label>
                <textarea id="respuesta3" rows="4"></textarea>
            </div>
        </div>
        <div id="button-group">
            <button class="btn volver">Volver</button>
            <button class="btn modificar">Modificar</button>
        </div>
    </div>
    <script type="text/javascript" src="/src/app/admin/view/js/validarModificacion.js"></script>
</body>
</html>
