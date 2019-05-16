<?php
    //Incluye los archivos de cabecera
    include_once "header.php";
    //incluye el archivo que contiene la clase
    include "db/bd.php";
    //Instancia de la clase database para las conexiones a la base de datos y las sentencias
    $bd = new Database();
    //Para almcenar mensajes de exito o error
    $message = "";
    //verifica si hay datos en el POST
    if(isset($_POST) and !empty($_POST)){
       // echo "hoola";
       //Se almacenan los valores de los campos de texto para despues ser pasados como parametros a la funcion de creacion o insercion a la tabla
       $numero = $_POST['numero'];
       $nombre = $_POST['nombre'];
       $posicion = $_POST['posicion'];
       $carrera = $_POST['carrera'];
       $email = $_POST['email'];

       //echo $numero;
        //Llama metodo de la clase Database para la insercion de registros en la base de datos 
       $res = $bd->createFutbolista($numero, $nombre, $posicion, $carrera, $email);
        //Verifica los resultados de la consulta realizada en el metodo de insercion llamado anteriormente
       if($res){
           $message = "Datos insertados correctamente";
       }else{
           $message = "no se pudieron insertar los datos";
       }

    }

?>
<br><br>
<div class="row">
    <div class="large-12 columns">
        <div class="large-10 columns">
            <h3>Agregar Futbolista</h3>
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
                <input type="text" name="numero" id="numero"  maxlength="100" required>
            </div>

            <div class="large-5 columns">
                <label><b>Nombre:</b></label>
                <input type="text" name="nombre" id="nombre" maxlength="100 " required>
            </div>

            <div class="large-4 columns">
                <label><b>Posición:</b></label>
                <input type="text" name="posicion" id="posicion" maxlength="100" required>
            </div>

            <div class="large-6 columns">
                <label><b>Carrera:</b></label>
                <input type="text" name="carrera" id="carrera" maxlength="100" required>
            </div>

            <div class="large-6 columns">
                <label><b>E-mail:</b></label>
                <input type="email" name="email" id="email" maxlength="100" required>
            </div>

            <div class="large-12 columns">
                <button type="submit" class="button radius tiny success">Guardar Datos</button>
            </div>
        </form>
    </div>
</div>