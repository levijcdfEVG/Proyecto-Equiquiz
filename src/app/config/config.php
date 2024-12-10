<?php

    //Rutas dinamicas
    define("RUTA", "../");
    define("VIEWPATHADMIN", RUTA . "admin/view/");
    define("PATHIMGADMIN", RUTA . "admin/assets/img/");

    //Vistas por defecto
    define("RUTACONTROLLERADMIN", "controller/");
    define("DEFAULTCONTROLLER", "CAdministrador");
    define("DEFAULTVIEW", "view");

    //Vistas del admin
    define("HEADADMIN", VIEWPATHADMIN . "head.php");
    define("FOOTERADMIN", VIEWPATHADMIN . "footer.php");
?>