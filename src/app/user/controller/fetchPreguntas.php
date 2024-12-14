<?php
    require_once '../config/config.php';
    require_once '../model/MPInteres.php';
    require_once 'CPinteres.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $idEscenario = $_POST['idEscenario'] ?? null;

        $objCPinteres = new CPInteres();

        switch ($action) {
            case 'getQuestion':
                $result = $objCPinteres->getQuestion($idEscenario);
                $questions = $result->fetchAll(PDO::FETCH_ASSOC);

                // Registrar la pregunta en la tabla temporal
                if (!empty($questions)) {
                    $idPregunta = $questions[0]['idPregunta'];
                    $objCPinteres->registrarPreguntaTemporal($idPregunta, $idEscenario);
                }

                echo json_encode(['status' => 'success', 'data' => $questions]);
                break;

            default:
                echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
        }
    }
?>
