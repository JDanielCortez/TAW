
<?php
if(!isset($_SESSION['validar'])){
	header("location:index.php?action=login");
	exit();
}

?>

<form id="tutoriaForm" method="post" class="box-content card white col-xs-12">
	<?php
	
		$registro = new MvcController();
		$registro -> registroBaseTutoriaController();
		$registro -> registroTutoriaController();
	?>
</form>

<?php


if(isset($_GET["action"])){
	if($_GET["action"] == "ok_tutoria"){
		echo "Registro Exitoso";
	}
}

?>
