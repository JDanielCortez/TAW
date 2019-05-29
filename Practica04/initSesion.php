<?php
//inicia sesion
session_start();
	//variable para el nombre de usuario
	$nombre='';
	//Verifica si la variable de sesion esta asignada en caso de ser verdadero redirecciona a la pagina principal index.php
	if(isset($_SESSION['nombre'])){
		//asigna nombre de usuario, el valor que contenga la variable de  sesion nombre
		$nombre=$_SESSION['nombre'];
		//Redireccion a la pagina principal
		header("Location: index.php");
	}else{//En caso de que no este asignada la variable de sesion nombre 
		//Verifica que haya datos que procesar en POST
		if(isset($_POST) && !empty($_POST)){
			//Objeto de base de datos para manejar el inicio de la sesion
			$sesion = New Database();

			//Almacena el valor del campo de nombre de usuario (Username)
			$usuario = $sesion->sanitize($_POST['Username']);
			//Almacena el valor del campo de contraseña (Password)
			$contrasena = $sesion->sanitize($_POST['Password']);
			
			//Llamada al metodo para validar los datos ingresado por el usuario, para iniciar sesion, envia el ususario y contraseña
			$res = $sesion->validar($usuario, $contrasena);
			
			//En caso de que sea correcto el inicio de sesion redirecciona a la pagina pricipal
			if($res != "incorrecto"){
				$_SESSION['nombre']=$res;
				header("Location: index.php");
			}
		}
    }
    
    ?>