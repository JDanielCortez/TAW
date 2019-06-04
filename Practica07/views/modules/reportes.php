<?php

session_start();

if(!$_SESSION["validar"]){
	header("location:index.php?action=ingresar");
	exit();
}

?>
<div class="box-content">
	<div align="center"><h1>Alumnos</h1></div>
	<table id="table_alumnos" class="table table-striped table-bordered display">
		<thead>
			<tr>
				<th>Matricula</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Tutor</th>
			</tr>
		</thead>
		<tbody>
			<?php

			$vistaAlumno = new MvcController();
			$vistaAlumno -> vistaReporteAlumnosController();

			?>

		</tbody>
	</table>
</div>


<div class="box-content">
	<div align="center"><h1>Maestros</h1></div>
	<table id="table_maestros" class="table table-striped table-bordered display">
		<thead>
			<tr>
				<th>Num. Empleado</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Carrera</th>
				<th>Nivel</th>
			</tr>
		</thead>
		<tbody>
			<?php

			$vistaMaestro = new MvcController();
			$vistaMaestro -> vistaReporteMaestrosController();

			?>

		</tbody>
	</table>
</div>

<div class="box-content">
	<div align="center"><h1>Tutorias</h1></div>
	<table id="table_tutorias" class="table table-striped table-bordered display">
		<thead>
			<tr>
				<th>Id</th>
				<th>Hora</th>
				<th>Fecha</th>
				<th>Tema</th>
				<th>Tipo</th>
			</tr>
		</thead>
		<tbody>
			<?php

			$vistaTutorias = new MvcController();
			$vistaTutorias -> vistaReporteTutoriasController();

			?>

		</tbody>
	</table>
</div>

<?php

?>


