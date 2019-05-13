        <?php
        /*Este arcivo contiene la generacio de la tabla de los clientes */
        ?>
        
        <div class="box-content">
            <h4 class="box-title">Clientes</h4>
            <!-- /.box-title -->
            <div class="dropdown js__drop_down">
                <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                <ul class="sub-menu">
                    <li><a href="#">Agregar Cliente</a></li>
                </ul>
                <!-- /.sub-menu -->
            </div>
        

            <table  id="example" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
						<th>E-mail</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>E-mail</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <?php 
                //incluye archivo de la clase que contiene los metodos de conexion y consultas a la base de datos
                include ('database.php');
                //Se crea un objeto del cliente
                $cliente = new Database();
                
                //Llama metodo read de la clase Database para traer los registros de la base de datos
				$clientes=$cliente->read();
				?>
                <tbody>
                    <?php 
                    //Ciclo que almacena en un array asosciativo lo datos contenidos en la base de datos, especificamente de la tabla de clientes, y a la ves va mostrando los datos en un tabla de la pagina
                        while ($row=mysqli_fetch_assoc($clientes)){
                            //Genera las filas con los datos obtenidos tras la consulta a la bbase de datos
                    ?>
                        <tr>
                            <td><?php echo $row['nombres'].' '. $row['apellidos'];?></td>
                            <td><?php echo $row['telefono'];?></td>
                            <td><?php echo $row['direccion'];?></td>
                            <td><?php echo $row['correo_electronico'];?></td>
                            <td>
                                <a href="update.php?id=<?php echo $row['id'];?>" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                <a href="delete.php?id=<?php echo $row['id'];?>" class="delete" title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>	
                    <?php
                        }
                    ?>    
                </tbody>
            </table>
        </div>
    </div>     
                        