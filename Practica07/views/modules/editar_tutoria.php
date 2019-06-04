<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>


<form method="post" class="box-content card white col-xs-12">
	
	<?php

	$editarMaestro = new MvcController();
	$editarMaestro -> editarTutoriaController();
	$editarMaestro -> actualizarTutoriaController();

	?>

</form>



