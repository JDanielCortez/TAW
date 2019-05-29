<?php
//Se incuye la cabecera
    include_once "header.php";
    //Se incuye  el archivo con la conexion y operaciones con la base de datos, los cuales se encuentran en la clase Database
    include "db/bd.php";
    $id = "";

    //valida que se hayan recibido datos a trves de GET espeificamente el id del registro que se desea eliminar
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'];
        
    }
    //una vez se ha confirmado la eliminacion del registro esntrara a esta condicion para realizar el llamado al metodo que realiza la consulta de eliminacion a la base de datos
    else if(isset($_GET['idf']) and !empty($_GET['idf'])){
        $id = $_GET['idf'];
        //instancia de la clase Database para operaciones con la base de datos
        $bd = new Database();
        
        $eliminado="";
        //verifica si el registro se ha eliminado, apartir del resultao de la consulta, realizada en el llamado al metodo anteriormente
        if($bd -> deleteFutbolista($id)){
            $eliminado=1;
        }else{
            $eliminado=0;
        }

        //redirecciona a la pagina de incio del crud
        header("location: futbol.php?e=$eliminado");

    }
?>
<br><br>
<div class="row">
    <div class="large-12 columns">
        <div class="large-10 columns">
            <h3>¿Eliminar jugador?</h3>
        </div>
        <div>
            <a href="./futbol.php" class="button radius tiny primary">Regresar</a>
        </div>
        
        <div >
            <a href="deleteFut.php?idf=<?php echo $id ?>" class="button radius tiny warning">Eliminar Datos</a>
        </div>
    </div>
</div>