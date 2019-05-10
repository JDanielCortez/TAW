<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD con PHP usando Programación Orientada a Objetos</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Clientes</b></h2></div>
                    <div class="col-sm-4">
                        <a href="create.php" class="btn btn-info add-new">
                            <i class="fa fa-plus"></i> Agregar cliente
                        </a>
                    </div>
                </div>
            </div>
            <?php
                $message = "";
                $class="";
                if(isset($_GET['e']) and $_GET['e']==1){
                    $message = "Cliente eliminado";
                    $class="alert alert-success";
                }else if(isset($_GET['e']) and $_GET['e']!=1){
                    $message = "No se ha eliminado el cliente";
                    $class="alert alert-danger";
                }
            ?>
            <div class="<?php echo $class?>">
                    <?php echo $message;?>
                </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
						<th>E-ail</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
				<?php 
				include ('database.php');
				$cliente = new Database();
				$clientes=$cliente->read();
				?>
                <tbody>
                    <?php 
                        while ($row=mysqli_fetch_assoc($clientes)){
                    ?>
                        <tr>
                            <td><?php echo $row['nombres'].' '. $row['apellidos'];?></td>
                            <td><?php echo $row['telefono'];?></td>
                            <td><?php echo $row['direccion'];?></td>
                            <td><?php echo $row['correo_electronico'];?></td>
                            <td>
                                <a href="update.php?id=<?php echo $row['id'];?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="delete.php?id=<?php echo $row['id'];?>" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>	
                    <?php
                        }
                    ?>    
                </tbody>
            </table>
        </div>
    </div>     
</body>
</html>                            