<div>
<h1>Registrar Usuario</h1>

    <div>
        <form method="post">
            
            <input type="text" placeholder="Usuario" name="usuarioRegistro" required>

            <input type="password" placeholder="Contraseña" name="passwordRegistro" required>

            <input type="email" placeholder="Email" name="emailRegistro" required>

            <input type="submit" value="Enviar">

        </form>
    </div>
</div>

<?php

$registro = new MvcController();
$registro -> registroUsuarioController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>