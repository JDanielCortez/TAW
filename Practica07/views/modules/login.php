<div id="single-wrapper">
	<form method="post" class="frm-single">
		<div class="inside">
			<div class="title"><strong>Gestor</strong>Escolar</div>
			<!-- /.title -->
			<div class="frm-title">Login</div>
			<!-- /.frm-title -->
			<div class="frm-input"><input type="text" placeholder="Username" name="Username" class="frm-inp" value="<?php if(isset($_POST['Username'])) echo $_POST['Username'];?>"><i class="fa fa-user frm-ico"></i></div>
			<!-- /.frm-input -->
			<div class="frm-input"><input type="password" placeholder="Password" name="Password" class="frm-inp" ><i class="fa fa-lock frm-ico"></i></div>
			<!-- /.frm-input -->
			
			<!-- /.clearfix -->
			<button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
			
			<div class="frm-footer">NinjaAdmin © 2016.</div>
			<!-- /.footer -->
		</div>
		<!-- .inside -->
	</form>
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->



<?php

$ingreso = new MvcController();
$ingreso -> ingresoUsuarioController();

if(isset($_GET["res"])){

	if($_GET["res"] == "fallo"){

		echo "Fallo al ingresar";
	
	}

}

if(isset($_GET["salir"])){

	if($_GET["salir"] == "1"){

		echo "Ha cerrado sesión exitosamente";
	
	}

}
?>