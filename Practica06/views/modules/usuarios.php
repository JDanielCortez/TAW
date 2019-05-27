
<?php
	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	
	}

$usuario = new MvcController();
$usuario -> insertarUsuarioController();
$usuario -> actualizarUsuarioController();
$usuario -> borrarUsuarioController();
if(isset($_GET['registrar'])){
	$usuario->registrarUsuarioController();   
}
else if(isset($_GET['id'])){
    $usuario -> editarUsuarioController();
}else{?>
	<div class="box-content">
            <h4 class="box-title">Listado de Usuarios</h4>
            <!-- /.box-title -->    
			<div class="dropdown js__drop_down">
            <a href="index.php?action=usuarios&registrar" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Usuario</i></a>
            </div>
            <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Tipo</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
				<tbody>
					<?php
						$usuario->vistaUsuariosController();
					?>
				</tbody>
				<?php
}

?>
