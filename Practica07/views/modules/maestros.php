<?php
	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	}

  $maestro = new MvcController();
  $maestro -> insertarMaestroController();
  $maestro -> actualizarMaestroController();
  $maestro -> borrarMaestroController();
  if(isset($_GET['registrar'])){
    $maestro -> registrarMaestroController();   
  }
  else if(isset($_GET['id'])){
      $maestro -> editarMaestroController();
  }else{?>
  <div class="box-content">
              <h4 class="box-title">Listado de alumnos</h4>
              <!-- /.box-title -->    
        <div class="dropdown js__drop_down">
              <a href="index.php?action=maestros&registrar" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Maestro</i></a>
              </div>
              <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                  <thead>
                      <tr>
                          <th>Num. Empleado</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Carrera</th>
                          <th>Nivel</th>
                          <th>Acciones</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Num. Empleado</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>Carrera</th>
                          <th>Nivel</th>
                          <th>Acciones</th>
                      </tr>
                  </tfoot>
          <tbody>
            <?php
              $maestro->vistaMaestrosController();
            ?>
          </tbody>
          <?php
  }

?>

