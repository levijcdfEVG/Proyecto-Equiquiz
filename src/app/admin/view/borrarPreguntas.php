<?php
$idPregunta = isset($_GET['id']) ? $_GET['id'] : null;

if ($idPregunta) {
    echo "<script>
        if (confirm('¿Está seguro de que desea eliminar esta pregunta?')) {
            window.location.href = 'index.php?c=CPreguntas&a=deleteQuestion&id=$idPregunta';
        } else {
            window.location.href = 'index.php?c=CPreguntas&a=showQuestions';
        }
    </script>";
} else {
    echo "No se ha proporcionado un ID de pregunta válido.";
}
?>