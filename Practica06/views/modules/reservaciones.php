
<?php
	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	
	}

$reserva = new MvcController();
//$cliente -> insertarClienteController();
//$cliente -> actualizarClienteController();
//$cliente -> borrarClienteController();
if(isset($_GET['registrar'])){
	$cliente->registrarClienteController();   
}
else if(isset($_GET['id'])){
    $cliente -> editarClienteController();
}else{?>
	<div class="box-content">
            <h4 class="box-title">Listado de Reservaciones</h4>
            <!-- /.box-title -->    
			<div class="dropdown js__drop_down">
            <a href="index.php?action=clientes&registrar" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Reservacion</i></a>
            </div>
            <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Habitación</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Noches</th>
						<th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Número</th>
                        <th>Habitación</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Noches</th>
						<th>Acciones</th>
                    </tr>
                </tfoot>
				<tbody>
					<?php
						$reserva->vistaReservacionesController();
					?>
				</tbody>
				<?php
}

?>
