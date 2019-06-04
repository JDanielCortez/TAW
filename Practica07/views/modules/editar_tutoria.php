<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>


<form method="post">
	
	<?php

	$editarMaestro = new MvcController();
	$editarMaestro -> editarTutoriaController();
	$editarMaestro -> actualizarTutoriaController();

	?>

</form>



