<?php
    //incluye los archivos de cabecera
    include_once "header.php";
    //incluye el archivo que contiente la clase Database para la conexion a la base de datos y las sentencias sql
    include "db/bd.php";
    //instancia de la clase DAtabase para operaciones con la base de datos
    $bd = new Database();
    $message = "";
    //Verifica si ya han ingresado datos por parte del usuario en los campos de texto
    if(isset($_POST) and !empty($_POST)){
       // echo "hoola";
       //Se almacenan los valores de los campos de texto 
       $numero = $_POST['numero'];
       $numeroActual = $_POST['numeroAct'];
       $nombre = $_POST['nombre'];
       $posicion = $_POST['posicion'];
       $carrera = $_POST['carrera'];
       $email = $_POST['email'];

       //echo $numero;
        //Se llama al metodo de actualizacion de datos de la clase Database, se envian los datos de los campos de texto almacenados anteriormente, y a su vez como el id (o numero) es modificable se envia el nuevo y el actual para asi realizar la actualizacion en el registro correcto (los id siguen siendo unicos)
       $res = $bd->updateFutbolista($numero, $nombre, $posicion, $carrera, $email, $numeroActual);
        //Verifica el resultado de la consulta
       if($res){
           $message = "Datos actualizados correctamente";
       }else{
           $message = "No se pudieron actualizar los datos";
       }

       //Este llama al metodo que regresa un soo registro de un jugador, esto para llenar los campos con sus datos actuales una vez han sido actualizados (recordando que el id podria cambiar y por eso se envian dos id)
       $res = $bd->singleRecordFutbolista($numero);

    }
    ///valida que no se hayan ingresado datos y que GET contenga el id para realizar la busqueda en el metodo que regresa un solo registro
    if(isset($_GET['id']) and !isset($_POST['numero'])){
        $res = $bd->singleRecordFutbolista($_GET['id']);
    }

?>
<br><br>
<div class="row">
    <div class="large-12 columns">
        <div class="large-10 columns">
            <h3>Actualizar Futbolista</h3>
        </div>
        <div>
            <a href="./futbol.php" class="button radius tiny primary">Regresar</a>
        </div>
        <div class="large-12 columns" >
            <b><?php echo $message ?></b>
        </div>
        <form method="post" >
            <div class="large-3 columns">
                <label><b>Número:</b></label>
                <input type="text" name="numero" id="numero"  maxlength="100" required value="<?php echo $res['id'];?>">
            </div>

            <div class="large-3 columns">
                <input type="hidden" name="numeroAct" id="numeroAct"  maxlength="100" required value="<?php echo $res['id'];?>">
            </div>

            <div class="large-5 columns">
                <label><b>Nombre:</b></label>
                <input type="text" name="nombre" id="nombre" maxlength="100 " required value="<?php echo $res['nombre'];?>">
            </div>

            <div class="large-4 columns">
                <label><b>Posición:</b></label>
                <input type="text" name="posicion" id="posicion" maxlength="100" required value="<?php echo $res['posicion'];?>">
            </div>

            <div class="large-6 columns">
                <label><b>Carrera:</b></label>
                <input type="text" name="carrera" id="carrera" maxlength="100" required value="<?php echo $res['carrera'];?>">
            </div>

            <div class="large-6 columns">
                <label><b>E-mail:</b></label>
                <input type="email" name="email" id="email" maxlength="100" required value="<?php echo $res['email'];?>">
            </div>

            <div class="large-12 columns">
                <button type="submit" class="button radius tiny success">Guardar Datos</button>
            </div>
        </form>
    </div>
</div>