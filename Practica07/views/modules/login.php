<div id="single-wrapper">
	<form method="post" class="frm-single">
		<div class="inside">
			<div class="title"><strong>Gestor</strong>Escolar</div>
			<!-- /.title -->
			<div align="center"><img src="views/img/eductaion-hat-school-icon-4-300x300.png" height="210" width="210"></div>
			<div class="frm-title">Acceder</div>
			<!-- /.frm-title -->
			<div class="frm-input"><input type="email" placeholder="Nombre de Usuario" name="emailIngreso" class="frm-inp" value="<?php if(isset($_POST['emailIngreso'])){ echo $_POST['emailIngreso'];}?>"><i class="fa fa-user frm-ico"></i></div>
			<!-- /.frm-input -->
			<div class="frm-input"><input type="password" placeholder="Contraseña" name="passwordIngreso" class="frm-inp" ><i class="fa fa-lock frm-ico"></i>       </div>
			<!-- /.frm-input -->
			
			<!-- /.clearfix -->
			<button type="submit" class="frm-submit">Acceder<i class="fa fa-arrow-circle-right"></i></button>
			
			<div class="frm-footer">No es NinjaAdmin © 2016.</div>
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