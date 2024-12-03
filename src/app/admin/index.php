<?php
    require_once 'src/app/config/config.php';

    $controller = isset($_GET['c']) ? $_GET['c'] : 'CAdministrador';
    $action = isset($_GET['a']) ? $_GET['a'] : 'viewPanelAdmin';

    // ucfirst convierte la 1 letra de la palabra en mayusculas
    $controllerFile = RUTACONTROLLER . ucfirst($controller) . '.php';

    if(file_exists($controllerFile)){
        require_once $controllerFile;

        //Instanciamos el controlador.
        $controllerClass = 'C' . ucfirst($controller);
        if(class_exists($controllerClass)) {
            $objController = new $controllerClass();

            //Verficar si el metodo que llamamos existe.
            if(method_exists($objController, $action))
                $objController->$action();
            else
                echo "El metodo llamado no existe en el Controlador";
        } else {
            echo "La clase no existe";
        }
    } else {
        echo "El arcivo del controlador no se encuentra";
    }
?>