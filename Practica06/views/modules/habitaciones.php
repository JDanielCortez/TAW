<?php
	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	
	}

$habitacion = new MvcController();
$habitacion -> insertarHabitacionController();
$habitacion -> actualizarHabitacionController();
$habitacion -> borrarHabitacionController();
if($_SESSION['tipoUsuario'] == 'Administrador'){
    if(isset($_GET['registrar'])){
        $habitacion->registrarHabitacionController();   
    }
    else if(isset($_GET['id'])){
        $habitacion -> editarHabitacionController();
    }else{?>
        <div class="box-content">
                <h4 class="box-title">Listado de habitaciones</h4>
                <!-- /.box-title -->    
                <div class="dropdown js__drop_down">
                <a href="index.php?action=habitaciones&registrar" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Habitación</i></a>
                </div>
                <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Costo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Costo</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $habitacion->vistaHabitacionesController();
                        ?>
                    </tbody>
                    <?php
    }
}
else{
    if(isset($_GET['ver'])){
        $habitacion->vistaHabitacionController();   
    }else{?>
        <div class="box-content">
                <h4 class="box-title">Listado de habitaciones</h4>
                <!-- /.box-title -->    
                <div class="dropdown js__drop_down">
                <a href="index.php?action=habitaciones&registrar" class="btn btn-info btn-xs waves-effect waves-light" title="Agregar" data-toggle="tooltip"><i class="fa fa-plus">Agregar Habitación</i></a>
                </div>
                <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Costo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Costo</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $habitacion->vistaHabitacionesController();
                        ?>
                    </tbody>
                    <?php
    }
}
?>