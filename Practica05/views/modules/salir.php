<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}else{
    unset($_SESSION['validar']);
    header("location:index.php?action=inicio&salir=1");
}

?>