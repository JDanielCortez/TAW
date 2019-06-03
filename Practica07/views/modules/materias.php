<?php
	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	}

  $materia = new MvcController();
  $materia -> insertarMateriaController();
  $materia -> actualizarMateriaController();
  $materia -> borrarMateriaController();
  if(isset($_GET['registrar'])){
    $materia -> registrarMateriaController();   
  }else if(isset($_GET['ver'])){
    $materia -> bajaMateriaAlumnoController();
    $materia -> altaMateriaAlumnoController();
    $materia -> consultarMateriaController();
  }else if(isset($_GET['id'])){
      $materia -> editarMateriaController();
  }else{?>
  <div class="box-content">
              <h4 class="box-title">Listado de Materias</h4>
              <!-- /.box-title -->    
        <div class="dropdown js__drop_down">
              <a href="index.php?action=materias&registrar" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Materia</i></a>
              </div>
              <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                  <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Maestro</th>
                        <th>Acciones</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Maestro</th>
                        <th>Acciones</th>
                      </tr>
                  </tfoot>
          <tbody>
            <?php
              $materia->vistaMateriasController();
            ?>
          </tbody>
  </div>
          <?php
  }

?>

