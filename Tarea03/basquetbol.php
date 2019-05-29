<?php
//inlusion de los archivos de cabecera
    include_once "header.php";
    //Inclucion del archivo con la clase Database con la conexion y operaciones a la base de datos
    include "db/bd.php";

    //instancia de la clase Database
    $bd = new Database();
?>
<br><br>
<div class="row">
    <div class="large-12 columns">
        <div class="large-10 columns"><h3>CRUD Basquetbolistas</h3></div> <div><a href="./createBas.php" class="button radius tiny primary">Agregar basquetbolista</a></div>

        <?php
                $message = "";
                $class="";
                //cuando regresa de una eliminacion de datos, verifica cual fue el resultado de dicha eliminacion para indicar si fue exitosa o no
                if(isset($_GET['e']) and $_GET['e']==1){
                    $message = "Jugador eliminado";
                }else if(isset($_GET['e']) and $_GET['e']!=1){
                    $message = "No se ha eliminado el Jugador";
                }
            ?>
        <div class="large-12 columns" >
            <b><?php echo $message ?></b>
        </div>

        <div class="section-container tabs" data-section>
            <section class="section-container tabs">
                <div class="content" data-slug="panel1"></div>
                    <?php 
                    //llamado al metodo de la clase Database encargado de realizar una consulta a la base de datos para recuperar los registros 
                        $datos = $bd->readBasquetbolistas();
                        //Se genera la tabla en caso de haber recibido datos
                        if($datos != null){ 
                        ?>
                        <table  style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Número</th>
                                    <th>Nombre</th>
                                    <th>Posición</th>
                                    <th>Carrera</th>
                                    <th>E-mail</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                //Se llena la tabla con los datos recuperados en la llamada del metoo anterior
                                foreach($datos as $row){
                            ?>
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['nombre']?></td>
                                    <td><?php echo $row['posicion']?></td>
                                    <td><?php echo $row['carrera']?></td>
                                    <td><?php echo $row['email']?></td>
                                    <td>
                                        <a href="./updateBas.php?id=<?php echo $row['id']; ?>" class="button radius tiny success">Actualizar</a>
                                        <a href="./deleteBas.php?id=<?php echo $row['id']; ?>" class="button radius tiny warning">Eliminar</a>
                                    </td>
                                </tr>
                            <?php
                                }
                            }else{
                                echo "<div>No hay registros</div>";
                            }
                            ?>

                            </tbody>
                        </table>
            </section>
        </div>
    </div>
    
</div>