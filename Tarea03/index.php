<?php
    include_once "header.php";
    include "db/bd.php";
?>
    <div class="row">
        <div class="large-12 columns panel" >
            <b>Tecnologías y Aplicaciones web - PHP y SQL</b>
        </div>
        <div class="large-12 columns" align="center">
            <h1>Contando Datos</h1>
        </div> 
        <div class="large-12 columns" style="border: 1px solid #008CBA; background: lightblue">
            <h3>Totales</h3>
        </div>
        <div>&nbsp;</div>
        <section class="section-container tabs">
            <div class="content" data-slug="panel1">
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <th>Usuarios</th>
                            <th>Tipos</th>
                            <th>Status</th>
                            <th>Accesos</th>
                            <th>Usuarios Activos</th>
                            <th>Usuarios Inactivos</th>
                        <tr>
                    </thead>
                    <?php
                    //Objeto Database para establecer una conexion a la base de datos y realizar las consultas
                        $bd = new Database();
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $bd->contarRegistros("user")?></td>
                            <td><?php echo $bd->contarRegistros("user_type")?></td>
                            <td><?php echo $bd->contarRegistros("status")?></td>
                            <td><?php echo $bd->contarRegistros("user_log")?></td>
                            <td><?php echo $bd->contarEstadoUsuario("Activo")?></td>
                            <td><?php echo $bd->contarEstadoUsuario("Inactivo")?></td>
                        </tr>                          
                    </tbody>
                </table>
            </div>

            <div class="large-12 columns" style="border: 1px solid #008CBA; background: lightblue">
                <h3>User</h3>
            </div>
            <div>&nbsp;</div>
            <div class="content" data-slug="panel1">
                <table >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Contraseña</th>
                            <th>Status</th>
                            <th>Tipo de Usuario</th>
                        <tr>
                    </thead>
                    <tbody>
                    <?php
                    //Realizar consulta a la base de datos y obtener registros en la tabla user
                        $datos = $bd->consultarUsuarios();
                        foreach($datos as $row){
                    ?>
                        <tr>
                            <td><?php echo $row["Id"]?></td>
                            <td><?php echo $row["Email"]?></td>
                            <td><?php echo $row["Pssw"]?></td>
                            <td><?php echo $row["status"]?></td>
                            <td><?php echo $row["name"]?></td>
                        </tr>  
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            
            <div class="large-12 columns" style="border: 1px solid #008CBA; background: lightblue">
                <h3>User_log</h3>
            </div>
            <div>&nbsp;</div>
            <div class="content" data-slug="panel1">
                <table >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha acceso</th>
                            <th>Id de Usuario</th>
                        <tr>
                    </thead>
                    <tbody>
                    <?php
                    //Realizar consulta a la base de datos y obtener registros en la tabla user_log
                        $datos = $bd->consultarLoggins();
                        foreach($datos as $row){
                    ?>
                        <tr>
                            <td><?php echo $row["Id"]?></td>
                            <td><?php echo $row["Date_logged"]?></td>
                            <td><?php echo $row["User_id"]?></td>
                        </tr>  
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="large-12 columns" style="border: 1px solid #008CBA; background: lightblue">
                <h3>User_type</h3>
            </div>
            <div>&nbsp;</div>
            <div class="content" data-slug="panel1">
                <table >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                        <tr>
                    </thead>
                    <tbody>
                    <?php
                    //Realizar consulta a la base de datos y obtener registros en la tabla user_log
                        $datos = $bd->consultarTiposUsuario();
                        foreach($datos as $row){
                    ?>
                        <tr>
                            <td><?php echo $row["Id"]?></td>
                            <td><?php echo $row["Name"]?></td>
                        </tr>  
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="large-12 columns" style="border: 1px solid #008CBA; background: lightblue">
                <h3>Status</h3>
            </div>
            <div>&nbsp;</div>
            <div class="content" data-slug="panel1">
                <table >
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                        <tr>
                    </thead>
                    <tbody>
                    <?php
                    //Realizar consulta a la base de datos y obtener registros en la tabla user_log
                        $datos = $bd->consultarStatus();
                        foreach($datos as $row){
                    ?>
                        <tr>
                            <td><?php echo $row["Id"]?></td>
                            <td><?php echo $row["Name"]?></td>
                        </tr>  
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    