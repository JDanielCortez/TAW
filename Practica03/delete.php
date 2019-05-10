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
                    <div class="col-sm-8"><h2>¿Eliminar Cliente?</h2></div>
                   
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                
                </div>
                
            </div>
            <?php
                include "database.php";
                
                if(isset($_POST['id_c']) && !empty($_POST['id_c'])){

                    $cliente = new Database();
                    
                    $id = $cliente->sanitize($_POST['id_c']);

                    
                    $eliminado="";
                    if($res = $cliente->delete($id)){
                        $eliminado=1;
                    }else{
                        $eliminado=0;
                    }
                    header("location: index.php?e=$eliminado");
                }

            ?>
            <div class="row">
                    <form method="post">
                        <div class="col-md-6">	
                            <input type="hidden" name="id_c" id="id_c" class='form-control' maxlength="100" value="<?php echo $_GET['id'] ?>">
                        </div>
                        
                        <div class="col-md-12 pull-right">
                        <hr>
                            <button type="submit" class="btn btn-success">Eliminar datos</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>     
</body>
</html>                            