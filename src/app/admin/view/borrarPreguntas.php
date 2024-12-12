<?php
$controller = isset($_GET['c']) ? $_GET['c'] : 'CPreguntas';
$action = isset($_GET['a']) ? $_GET['a'] : 'showDelete';
$idPregunta = isset($_GET['id']) ? $_GET['id'] : null;

if ($idPregunta) {
    echo "<script>
        if (confirm('¿Está seguro de que desea eliminar esta pregunta?')) {
            window.location.href = 'index.php?c=$controller&a=deleteQuestion&id=$idPregunta';
        } else {
            window.location.href = 'index.php?c=$controller&a=showQuestions';
        }
    </script>";
} else {
    echo "No se ha proporcionado un ID de pregunta válido.";
}
?>