<?php
    //inicia la sesion
    session_start();
    //variable parra el nombre de usuario
    $nombre="";
    //Verifica que la variable de sesion 'nombre' tenga un valor, para despues ser asignada a la variable de con la cual se muestra el nombre de usuario
	if(isset($_SESSION['nombre'])){
		$nombre=$_SESSION['nombre'];
	}else{
        //Redirecciona a la pagina de incicio de sesion en caso de que la sesion no este asignada
		header("Location: page-login.php");
	}
?>