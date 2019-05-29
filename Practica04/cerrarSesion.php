<?php
    /*Este archivo es para cerrar sesion -------------------------*/

    //Inicia sesion
    session_start();

    //Destruye la sesion actual en la pagina
    session_destroy();

    //Redirecciona a la pagina d inicio de sesion 
    header("Location: page-login.php");
?>