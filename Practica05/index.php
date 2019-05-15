

<?php
    //El index muestra la salida de las vistas al usuario, tambien a traves de el enviaremos las distintas acciones que el usuario envie al controlador

    //requiere_once establce el codigo del archivo a utilizar
    require_once "controllers/controller.php";
    require_once "models/model.php";
    $mvc = new MvcController();
    $mvc -> plantilla();
?>