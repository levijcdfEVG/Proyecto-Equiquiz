<?php
    require_once 'config/config.php';

    //Esto lo usamos para el manejo de errores.
    if (isset($_GET['error'])) {
        $error = htmlspecialchars($_GET['error']);
        require_once HEADADMIN;
        require_once DEFAULTVIEW.'/error.php';
        require_once FOOTERADMIN;
        exit;
    }

    $controller = isset($_GET['c']) ? $_GET['c'] : DEFAULTCONTROLLER;
    $action = isset($_GET['a']) ? $_GET['a'] : DEFAULTVIEW;

    // ucfirst convierte la 1 letra de la palabra en mayusculas
    $controllerFile = RUTACONTROLLERADMIN . ucfirst($controller) . '.php';
    

    if(file_exists($controllerFile)){
        require_once $controllerFile;

        //Instanciamos el controlador.
        $controllerClass = ucfirst($controller);
        // echo $controllerClass;
        if(class_exists($controllerClass)) {
            $objController = new $controllerClass();

            //Verficar si el metodo que llamamos existe.
            if(method_exists($objController, $action)){
                $objController->$action();
                require_once HEADADMIN;
                require_once VIEWPATHADMIN.$objController->view;
                require_once FOOTERADMIN;
            }
            else
                echo "El metodo llamado no existe en el Controlador";
        } else {
            echo "La clase no existe";
        }
    } else {
        echo "El archivo del controlador no se encuentra";
    }
?>
