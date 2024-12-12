<?php
    require_once 'config/config.php';
    require_once 'model/MPInteres.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $idEscenario = $_POST['idEscenario'] ?? null;

        $objCPinteres = new CPInteres();

        switch ($action) {
            case 'getQuestion':
                if ($idEscenario) {
                    $result = $objCPinteres->getQuestion($idEscenario);
                    $questions = $result->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode(['status' => 'success', 'data' => $questions]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'ID de escenario no proporcionado.']);
                }
                break;
            default:
                echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
        }
    }
?>
