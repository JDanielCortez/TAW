<?php
	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	}

  $grupo = new MvcController();
  $grupo -> insertarGrupoController();
  $grupo -> actualizarGrupoController();
  $grupo -> borrarGrupoController();
  if(isset($_GET['registrar'])){
    $grupo -> registrargrupoController();   
  }else if(isset($_GET['ver'])){
    $grupo -> bajaGrupoMateriaController();
    $grupo -> altaGrupoMateriaController();
    $grupo -> consultarGrupoController();
  }else if(isset($_GET['id'])){
      $grupo -> editarGrupoController();
  }else{?>
  <div class="box-content">
              <h4 class="box-title">Listado de grupos</h4>
              <!-- /.box-title -->    
        <div class="dropdown js__drop_down">
              <a href="index.php?action=grupos&registrar" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Grupo</i></a>
              </div>
              <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                  <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Acciones</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Carrera</th>
                        <th>Acciones</th>
                      </tr>
                  </tfoot>
          <tbody>
            <?php
              $grupo->vistaGruposController();
            ?>
          </tbody>
          <?php
  }

?>

