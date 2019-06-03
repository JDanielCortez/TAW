<?php
	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	}

  $alumno = new MvcController();
  $alumno -> insertarAlumnoController();
  $alumno -> actualizarAlumnoController();
  $alumno -> borrarAlumnoController();
  if(isset($_GET['registrar'])){
    $alumno ->registrarAlumnoController();   
  }
  else if(isset($_GET['id'])){
      $alumno -> editarAlumnoController();
  }else{?>
  <div class="box-content">
              <h4 class="box-title">Listado de alumnos</h4>
              <!-- /.box-title -->    
        <div class="dropdown js__drop_down">
              <a href="index.php?action=alumnos&registrar" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Alumno</i></a>
              </div>
              <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                  <thead>
                      <tr>
                          <th>Matricula</th>
                          <th>Nombre</th>
                          <th>Carrera</th>
                          <th>Tutor</th>
                          <th>Acciones</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>Matricula</th>
                          <th>Nombre</th>
                          <th>Carrera</th>
                          <th>Tutor</th>
                          <th>Acciones</th>
                      </tr>
                  </tfoot>
          <tbody>
            <?php
              $alumno->vistaAlumnosController();
            ?>
          </tbody>
          <?php
  }

?>

