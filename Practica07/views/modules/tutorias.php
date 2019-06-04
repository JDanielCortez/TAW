<?php

	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	}

?>

<div class="box-content">
              <h4 class="box-title">Listado de Tutorias</h4>
              <!-- /.box-title -->    
        <div class="dropdown js__drop_down">
              <a href="index.php?action=registro_tutoria" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Tutoria</i></a>
              </div>
              <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
				<thead>
					<tr>
						<th>Id</th>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Tema</th>
						<th>Tipo</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Id</th>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Tema</th>
						<th>Tipo</th>
						<th>Acciones</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
		
					$vistaAlumno = new MvcController();
					$vistaAlumno -> vistaTutoriasController();
					$vistaAlumno -> borrarTutoriaController();
		
					?>
		
				</tbody>
		  </table>
  </div>

<?php

if(isset($_GET["action"])){
	if($_GET["action"] == "cambio"){
		echo "Cambio Exitoso";
	}
}

?>


