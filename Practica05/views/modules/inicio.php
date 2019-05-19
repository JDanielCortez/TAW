<div>
<h1>Iniciar Sesión</h1>

	<div>
        <form method="post">
            
            <input type="text" placeholder="Usuario" name="nombreUsuario" required>

            <input type="password" placeholder="Contraseña" name="contrasena" required>

            <input type="submit" value="Enviar">

        </form>
    </div>
    <div>
        ¿No tienes cuenta?
        <a href="index.php?action=registrarUsuario">Registrate</a>
    </div>
</div>

<?php

$ingreso = new MvcController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "fallo"){

		echo "Fallo al ingresar";
	
	}

}

if(isset($_GET["salir"])){

	if($_GET["salir"] == "1"){

		echo "Ha cerrado sesión exitosamente";
	
	}

}

?>