<?php
    class MvcController{
        //Llamar a la plantilla

        public function plantilla(){
            //El iclude se utiliza para invocar el archivo que tiene el archivo que tiene el condigo html
            include "views/template.php";
        }

        //La interacción con el usuario
        public function enlacesPaginasController(){
            
            if(isset($_GET['action'])){
                $enlacesController = $_GET['action'];
            }else{
                $enlacesController = "index";
            }

            $respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);
            include $respuesta;
        } 

        /**USUARIOS------------------------------------------------------USUARIOS --------------------------------- USUARIOS --------------------------------------USUARIOS --------------------------------------USUARIOS---- --------------------------------------------USUARIOS -------------------------USUARIOS ------------------
         * 
         * 
         * 
        */
        //Vista de los Usuaarios
        public function vistaUsuariosController(){
            //llamada la metodo del modelo para recuperar los datos que seran mostrados
            $respuesta = Datos::vistaUsuariosModel("usuarios");
            //Se llenan las filas de la tabla con los datos recuperados
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["tipo"].'</td>
                    <td>'.$item["usuario"].'</td>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["correo"].'</td>
                    <td>
                        <a href="index.php?action=usuarios&id='.$item["id"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="index.php?action=usuarios&idBorrar='.$item["id"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                    </td>
                </tr>';

            }

        }

        //Inicio de sesion, recibe nombre de usuario y contraseña
        public function ingresoUsuarioController(){
            if(isset($_POST["Username"])){
    
                //contienene los valores que seran usados en la consulta SELECT para obneter los datos del usuariosados por el usuario
                $datosController = array( "usuario"=>$_POST["Username"], 
                                          "password"=>$_POST["Password"]);
    
                //llamada al metodo del controlador que pide al modelo hacer la consulta
                $respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

                //A partir de los valores retorntados en la llamada anterior se comparan para validar los datos
                if($respuesta["usuario"] == $_POST["Username"] && $respuesta["contrasena"] == $_POST["Password"]){
                    //Inicia sesion
                    session_start();
    
                    //Validacion de la sesion, indica que la sesion ha sido iniciada
                    $_SESSION["validar"] = true;
                    //Tipo de usuario correspondiente al usuario, sirve para determinar lo que se le muestra al usurio de acuerdo a su nivel de acceso en este caso Administrador y Recepcionistata (1 y 2) son los niveles de usuarios
                    $_SESSION["tipoUsuario"] = $respuesta["tipoUsuario"];
                    //Nombre de la persona a la que le pertenece el usuario
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    //redireciona a la pagina de productos
                    header("Location:index.php?action=habitaciones");
    
                }
                //en caso de datos incorrectos
                else{
                    //regresa al inicio
                    header("Location:index.php?action=login&res=fallo");
    
                }
    
            }	
        }

        //Metodo para mostrar el formulario de registro de Usuario
        public function registrarUsuarioController(){
            ?>
                <div id="">
                <form method="post" class="frm-single" action="index.php?action=usuarios">
                    <div class="inside">
                        <div class="title"><strong>Registrar</strong>&nbsp;Usuario</div>
    
                        
                        <div class="frm-input"><input type="text" placeholder="Nombre de Usuario" name="nombreUsuario" class="frm-inp" value="" required><i class="fa fa-user-plus frm-ico"></i></div>

                        <div class="frm-input"><input type="text" placeholder="Nombre" name="nombreCompleto" class="frm-inp" value="" required><i class="fa fa-user frm-ico"></i></div>
                        <!-- /.frm-input -->
                        <div class="frm-input"><input type="email" placeholder="E-mail" name="correoUsuario" class="frm-inp" requiered><i class="fa fa-envelope frm-ico"></i></div>
                        <!-- /.frm-input -->

                        <div class="frm-input"><input type="password" placeholder="Contraseña" name="contrasenaUsuario" class="frm-inp" requiered><i class="fa fa-lock frm-ico"></i></div>
                        <!-- /.frm-input -->                        
    
                        <div class="form-group margin-bottom-20">
                            <select class="form-control" name="tipoUsuario">
                                <option value="">Tipo de Usuario</option>
                                <option value="1">Administrador</option>
                                <option value="2">Recepcionista</option>
                            </select>
                        </div>
                        
                        <!-- /.clearfix -->
                        <button type="submit" class="frm-submit btn">Aceptar<i class="fa fa-arrow-circle-right"></i></button>
                        
                    </div>
                    <!-- .inside -->
                </form>
                <!-- /.frm-single -->
            </div><!--/#single-wrapper -->
            <?php
        }


        ///Registro de clientes
        public function insertarUsuarioController(){
            //Valida que los campos hayan sido llenados
            if(isset($_POST["nombreUsuario"])){
                //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
                $datosController = array("usuario"=>$_POST["nombreUsuario"], 
                                         "correo"=>$_POST["correoUsuario"],
                                         "nombre"=>$_POST["nombreCompleto"],
                                         "tipo"=>$_POST["tipoUsuario"],
                                          "contrasena" => $_POST['contrasenaUsuario']);
    
                //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
                $respuesta = Datos::registroUsuarioModel($datosController, "usuarios");
    
                //Verifica si la insercion ha sido exitosa
                //en caso de ser exitosa mostrara un mensaje que indica el exito de la accion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han insertado los datos exitosamente</p>
                    </div>';
                }
                //En caso de que haya fallado la insercion se motrara un mensaje indicando el fallo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible guardar los datos</p>
                    </div>';
                }
    
            }
    
        }

        //Editar Cliente
        public function editarUsuarioController(){
            //Se almacena el id selecciono del registro seleccionado 
            $datosController = $_GET["id"];
            //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
            $respuesta = Datos::editarUsuarioModel($datosController, "usuarios");
            //Se muestran los campos con los datos recuperados tras la consulta
            ?>
            <div id="">
            <form method="post" class="frm-single" action="index.php?action=usuarios">
                <div class="inside">
                    <div class="title"><strong>Editar</strong>&nbsp;Usuario</div>
                    
                    <div class="frm-input"><input type="hidden" name="idUsuarioEditar" class="frm-inp" value="<?php echo $respuesta['id']?>" required></div>

                    <div class="frm-input"><input type="text" placeholder="Nombre de Usuario" name="nombreUsuarioEditar" class="frm-inp" value="<?php echo $respuesta['usuario']?>" required><i class="fa fa-user-plus frm-ico"></i></div>

                    <div class="frm-input"><input type="text" placeholder="Nombre" name="nombreCompletoEditar" class="frm-inp" value="<?php echo $respuesta['nombre']?>" required><i class="fa fa-user frm-ico"></i></div>
                    <!-- /.frm-input -->
                    <div class="frm-input"><input type="email" placeholder="E-mail" name="correoUsuarioEditar" class="frm-inp" value="<?php echo $respuesta['correo']?>" requiered><i class="fa fa-envelope frm-ico"></i></div>
                    <!-- /.frm-input -->

                    <div class="frm-input"><input type="password" placeholder="Contraseña" name="contrasenaUsuarioEditar" class="frm-inp" value="<?php echo $respuesta['contrasena']?>" requiered><i class="fa fa-lock frm-ico"></i></div>
                    <!-- /.frm-input -->       
                    

                    <div class="form-group margin-bottom-20">
                        <select class="form-control" name="tipoUsuarioEditar">
                            <option value="">Tipo de cliente</option>
                            <option value="1" <?php if($respuesta['id_tipo_usuario'] == '1'){echo 'selected';} ?>>Administrador</option>
                            <option value="2" <?php if($respuesta['id_tipo_usuario'] == '2'){echo 'selected';} ?>>Recepcionista</option>
                        </select>
                    </div>
                    
                    <!-- /.clearfix -->
                    <button type="submit" class="frm-submit btn">Aceptar<i class="fa fa-arrow-circle-right"></i></button>
                    
                </div>
                <!-- .inside -->
            </form>
            <!-- /.frm-single -->
        </div><!--/#single-wrapper -->
        <?php
        }


        //Actualizar cliente
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
        public function actualizarUsuarioController(){
            //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
            if(isset($_POST["nombreUsuarioEditar"])){
                //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
                $datosController = array( "id"=>$_POST["idUsuarioEditar"],
                                          "usuario"=>$_POST["nombreUsuarioEditar"],
                                          "nombre"=>$_POST['nombreCompletoEditar'],
                                          "tipo"=>$_POST["tipoUsuarioEditar"],
                                          "correo"=>$_POST["correoUsuarioEditar"],
                                        "contrasena"=>$_POST["contrasenaUsuarioEditar"]);
                //Se hace el llamado al metodo actualizar y se le envian dos parametros: el array con los datos y el nombre de la tabla en la que se hace la modificacion
                $respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han guardado los cambios exitosamente</p>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible guardar los cambios</p>
                    </div>';
                }
    
            }
        
        }

        //Eliminar Usuario
        public function borrarUsuarioController(){
            //recupera el id del enlace, este sera usado para hacer referencia al registro a eliminar
            if(isset($_GET["idBorrar"])){
                //datosController almcen el id para ser enviado como parametro
                $datosController = $_GET["idBorrar"];
                //Se realiza el llamado al metodo en el modelo encargado de la eliminacion
                $respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han eliminado los datos exitosamente</p>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible eliminar los datos</p>
                    </div>';
                }
            }
    
        }

        /**CLIENTES--------------CLIENTES-------------------------------CLIENTES---------------------------------------------------------------------------CLIENTES----------------------------------CIENTEs-------------------------------------------------------------------------------------CLIENTES-----------------------------------------------------------------------------------CLIENTES-------------------------------------------------------------- */

        //Vista de los clientes
        public function vistaClientesController(){
            //llamada la metodo del modelo para recuperar los datos que seran mostrados
            $respuesta = Datos::vistaClientesModel("clientes");
            //Se llenan las filas de la tabla con los datos recuperados
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["email"].'</td>
                    <td>'.$item["telefono"].'</td>
                    <td>'.$item["tipo"].'</td>
                    <td>
                        <a href="index.php?action=clientes&id='.$item["id"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="index.php?action=clientes&idBorrar='.$item["id"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                    </td>
                </tr>';
    
            }
    
        }

        //Metodo para mostrar el formulario de registro de cliente
        public function registrarClienteController(){
        ?>
            <div id="">
            <form method="post" class="frm-single" action="index.php?action=clientes">
                <div class="inside">
                    <div class="title"><strong>Registrar</strong>&nbsp;Cliente</div>


                    <div class="frm-input"><input type="text" placeholder="Nombre" name="nombreCliente" class="frm-inp" value="" required><i class="fa fa-user frm-ico"></i></div>
                    <!-- /.frm-input -->
                    <div class="frm-input"><input type="email" placeholder="E-mail" name="correoCliente" class="frm-inp" requiered><i class="fa fa-envelope frm-ico"></i></div>
                    <!-- /.frm-input -->
                    <div class="frm-input"><input type="text" placeholder="Teléfono" name="telefonoCliente" class="frm-inp" requiered><i class="fa fa-phone frm-ico"></i></div>
                    <!-- /.frm-input -->

                    <div class="form-group margin-bottom-20">
                        <select class="form-control" name="tipoCliente">
                            <option value="">Tipo de cliente</option>
                            <option value="1">Habitual</option>
                            <option value="2">Esporadico</option>
                        </select>
                    </div>
                    
                    <!-- /.clearfix -->
                    <button type="submit" class="frm-submit btn">Aceptar<i class="fa fa-arrow-circle-right"></i></button>
                    
                </div>
                <!-- .inside -->
            </form>
            <!-- /.frm-single -->
        </div><!--/#single-wrapper -->
        <?php
        }

        

        ///Registro de clientes
        public function insertarClienteController(){
            //Valida que los campos hayan sido llenados
            if(isset($_POST["nombreCliente"])){
                //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
                $datosController = array("nombre"=>$_POST["nombreCliente"], 
                                         "correo"=>$_POST["correoCliente"],
                                         "telefono"=>$_POST["telefonoCliente"],
                                        "tipo"=>$_POST["tipoCliente"]);
    
                //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
                $respuesta = Datos::registroClienteModel($datosController, "clientes");
    
                //Verifica si la insercion ha sido exitosa
                //en caso de ser exitosa mostrara un mensaje que indica el exito de la accion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han insertado los datos exitosamente</p>
                    </div>';
                }
                //En caso de que haya fallado la insercion se motrara un mensaje indicando el fallo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible guardar los datos</p>
                    </div>';
                }
    
            }
    
        }

        //Editar Cliente
        public function editarClienteController(){
            //Se almacena el id selecciono del registro seleccionado 
            $datosController = $_GET["id"];
            //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
            $respuesta = Datos::editarClienteModel($datosController, "clientes");
            //Se muestran los campos con los datos recuperados tras la consulta
            ?>
            <div id="">
            <form method="post" class="frm-single" action="index.php?action=clientes">
                <div class="inside">
                    <div class="title"><strong>Editar</strong>&nbsp;Cliente</div>
                    
                    <div class="frm-input"><input type="hidden" name="idClienteEditar" class="frm-inp" value="<?php echo $respuesta['id']?>" required></div>

                    <div class="frm-input"><input type="text" placeholder="Nombre" name="nombreClienteEditar" class="frm-inp" value="<?php echo $respuesta['nombre']?>" required><i class="fa fa-user frm-ico"></i></div>
                    
                    <div class="frm-input"><input type="email" placeholder="E-mail" name="correoClienteEditar" class="frm-inp" value="<?php echo $respuesta['email']?>" requiered><i class="fa fa-envelope frm-ico"></i></div>
                    
                    <div class="frm-input"><input type="text" placeholder="Teléfono" name="telefonoClienteEditar" class="frm-inp" value="<?php echo $respuesta['telefono']?>" requiered><i class="fa fa-phone frm-ico"></i></div>
                    

                    <div class="form-group margin-bottom-20">
                        <select class="form-control" name="tipoClienteEditar">
                            <option value="">Tipo de cliente</option>
                            <option value="1" <?php if($respuesta['id_tipo_cliente'] == '1'){echo 'selected';} ?>>Habitual</option>
                            <option value="2" <?php if($respuesta['id_tipo_cliente'] == '2'){echo 'selected';} ?>>Esporadico</option>
                        </select>
                    </div>
                    
                    <!-- /.clearfix -->
                    <button type="submit" class="frm-submit btn">Aceptar<i class="fa fa-arrow-circle-right"></i></button>
                    
                </div>
                <!-- .inside -->
            </form>
            <!-- /.frm-single -->
        </div><!--/#single-wrapper -->
        <?php
        }

        //Actualizar cliente
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
        public function actualizarClienteController(){
            //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
            if(isset($_POST["nombreClienteEditar"])){
                //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
                $datosController = array( "id"=>$_POST["idClienteEditar"],
                                          "nombre"=>$_POST["nombreClienteEditar"],
                                          "tipo"=>$_POST["tipoClienteEditar"],
                                          "email"=>$_POST["correoClienteEditar"],
                                        "telefono"=>$_POST["telefonoClienteEditar"]);
                //Se hace el llamado al metodo actualizar y se le envian dos parametros: el array con los datos y el nombre de la tabla en la que se hace la modificacion
                $respuesta = Datos::actualizarClienteModel($datosController, "clientes");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han guardado los cambios exitosamente</p>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible guardar los cambios</p>
                    </div>';
                }
    
            }
        
        }


        //Eliminar Cliente
        public function borrarClienteController(){
            //recupera el id del enlace, este sera usado para hacer referencia al registro a eliminar
            if(isset($_GET["idBorrar"])){
                //datosController almcen el id para ser enviado como parametro
                $datosController = $_GET["idBorrar"];
                //Se realiza el llamado al metodo en el modelo encargado de la eliminacion
                $respuesta = Datos::borrarClienteModel($datosController, "clientes");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han eliminado los datos exitosamente</p>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible eliminar los datos</p>
                    </div>';
                }
            }
    
        }

        /**HABITACIONES -----------------------------------------HABITACIONES --------------------------HABITACIONES HABITACIONES--------------------------------HABITACIONES-------------------------------------------HABITACIONESHABITACIONES-------------------------------HABITACIONES---------------------------------------HABITACIONES---------
         * 
         * 
        */

        //Vista de las habitaciones
        public function vistaHabitacionesController(){
            //llamada la metodo del modelo para recuperar los datos que seran mostrados
            $respuesta = Datos::vistaHabitacionesModel("habitaciones");
            //Se llenan las filas de la tabla con los datos recuperados
            foreach($respuesta as $row => $item){
                if($_SESSION['tipoUsuario'] == 'Administrador'){
                    echo'<tr>
                        <td>'.$item["id"].'</td>
                        <td>'.$item["tipo"].'</td>
                        <td>$ '.$item["costo"].'</td>
                        <td>
                            <a href="index.php?action=habitaciones&id='.$item["id"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                            <a href="index.php?action=habitaciones&idBorrar='.$item["id"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                        </td>
                    </tr>';
                }else{
                    echo'<tr>
                        <td>'.$item["id"].'</td>
                        <td>'.$item["tipo"].'</td>
                        <td>$ '.$item["costo"].'</td>
                        <td>
                            <a href="index.php?action=habitaciones&id='.$item["id"].'&ver" class="edit" title="Ver habitación" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>';
                }
            }
    
        }


        //Vista de una habitacocion --busqueda de una habitacion a partir de su id
        public function vistaHabitacionController(){
           //Se almacena el id selecciono del registro seleccionado 
           $datosController = $_GET["id"];
           //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
           $respuesta = Datos::verHabitacionModel($datosController, "habitaciones");
            echo '
            <div class="box-content bordered" align="center">
                <h4 class="box-title">Información de Habitación</h4>
                <p>
                    <h4>Número de habitación: '.$respuesta['id'].'</h4>
                    <h4>Tipo de habitación:  '.$respuesta['tipo'].'</h4>
                    <h4>Costo:  $'.$respuesta['costo'].'</h4>
                </p>

                <img src="img/'.$respuesta['imagen'].'" alt="" height="500">
            </div>
            ';
    
        }


        //Metodo para mostrar el formulario de registro de cliente
        public function registrarHabitacionController(){
            ?>
                <div id="">
                <form method="post" class="frm-single" action="index.php?action=habitaciones" enctype="multipart/form-data">
                    <div class="inside">
                        <div class="title"><strong>Registrar</strong>&nbsp;Habitacion</div>

    
                        <div class="form-group margin-bottom-20">
                            <select class="form-control" name="tipoHabitacion">
                                <option value="">Tipo de Habitación</option>
                                <option value="1">Simple</option>
                                <option value="2">Doble</option>
                                <option value="3">Matrimonial</option>
                            </select>
                        </div>
                        
                        <div><input type="file" name="archivo" class="frm-inp" accept="image/*"></div>

                        <!-- /.clearfix -->
                        <button type="submit" class="frm-submit btn">Aceptar<i class="fa fa-arrow-circle-right"></i></button>
                        
                    </div>
                    <!-- .inside -->
                </form>
                <!-- /.frm-single -->
            </div><!--/#single-wrapper -->
            <?php
            }

        ///Registro de Habitaciones
        public function insertarHabitacionController(){
            //Valida que los campos hayan sido llenados
            if(isset($_POST["tipoHabitacion"])){
                //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
                $datosController = array("tipo"=>$_POST["tipoHabitacion"]);
    
                //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
                $respuesta = Datos::registroHabitacionModel($datosController, "habitaciones");
    
                //Verifica si la insercion ha sido exitosa
                //en caso de ser exitosa mostrara un mensaje que indica el exito de la accion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han insertado los datos exitosamente</p>
                    </div>';

                }
                //En caso de que haya fallado la insercion se motrara un mensaje indicando el fallo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible guardar los datos</p>
                    </div>';
                }
    
            }
    
        }

        //Editar Cliente
        public function editarHabitacionController(){
            //Se almacena el id selecciono del registro seleccionado 
            $datosController = $_GET["id"];
            //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
            $respuesta = Datos::editarHabitacionModel($datosController, "habitaciones");
            //Se muestran los campos con los datos recuperados tras la consulta
            ?>
            <div id="">
            <form method="post" class="frm-single" action="index.php?action=habitaciones" enctype="multipart/form-data">
                <div class="inside">
                    <div class="title"><strong>Editar</strong>&nbsp;Cliente</div>
                    
                    <div class="frm-input"><input type="hidden" name="idHabitacionEditar" class="frm-inp" value="<?php echo $respuesta['id']?>" required></div>

                    <div class="form-group margin-bottom-20">
                        <select class="form-control" name="tipoHabitacionEditar">
                            <option value="">Tipo de Habitaciòn</option>
                            <option value="1" <?php if($respuesta['id_tipo_habitacion'] == '1'){echo 'selected';} ?>>Simple</option>
                            <option value="2" <?php if($respuesta['id_tipo_habitacion'] == '2'){echo 'selected';} ?>>Doble</option>
                            <option value="3" <?php if($respuesta['id_tipo_habitacion'] == '3'){echo 'selected';} ?>>Matrimonial</option>
                        </select>
                    </div>
                    
                    <div><input type="file" name="archivo" class="frm-inp" accept="image/*"></div>
                    <!-- /.clearfix -->
                    <button type="submit" class="frm-submit btn">Aceptar<i class="fa fa-arrow-circle-right"></i></button>
                    
                </div>
                <!-- .inside -->
            </form>
            <!-- /.frm-single -->
        </div><!--/#single-wrapper -->
        <?php
        }

        //Actualizar Habtacion
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
        public function actualizarHabitacionController(){
            //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
            if(isset($_POST["idHabitacionEditar"])){
                //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
                $datosController = array( "id"=>$_POST["idHabitacionEditar"],
                                            "tipo"=>$_POST["tipoHabitacionEditar"]);
                //Se hace el llamado al metodo actualizar y se le envian dos parametros: el array con los datos y el nombre de la tabla en la que se hace la modificacion
                $respuesta = Datos::actualizarHabitacionModel($datosController, "habitaciones");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han guardado los cambios exitosamente</p>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible guardar los cambios</p>
                    </div>';
                }
    
            }
        
        }

        //Eliminar Habitacion
        public function borrarHabitacionController(){
            //recupera el id del enlace, este sera usado para hacer referencia al registro a eliminar
            if(isset($_GET["idBorrar"])){
                //datosController almcen el id para ser enviado como parametro
                $datosController = $_GET["idBorrar"];
                //Se realiza el llamado al metodo en el modelo encargado de la eliminacion
                $respuesta = Datos::borrarHabitacionModel($datosController, "habitaciones");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han eliminado los datos exitosamente</p>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible eliminar los datos</p>
                    </div>';
                }
            }
    
        }

        /**RESERVACIONES--------------RESERVACIONES-------------------------------RESERVACIONES---------------------------------------------------------------------------RESERVACIONES----------------------------------RESERVACIONES-------------------------------------------------------------------------------------RESERVACIONES-----------------------------------------------------------------------------------RESERVACIONES-------------------------------------------------------------- */

        //Vista de los clientes
        public function vistaReservacionesController(){
            //llamada la metodo del modelo para recuperar los datos que seran mostrados
            $respuesta = Datos::vistaReservacionesModel("reservaciones");
            //Se llenan las filas de la tabla con los datos recuperados
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["numero"].'</td>
                    <td>'.$item["habitacion"].'</td>
                    <td>'.$item["cliente"].'</td>
                    <td>'.$item["fecha"].'</td>
                    <td>'.$item["noches"].'</td>
                    <td>
                        <a href="index.php?action=reservaciones&id='.$item["numero"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="index.php?action=reservaciones&idBorrar='.$item["numero"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                    </td>
                </tr>';
    
            }
    
        }

        //Metodo para mostrar el formulario de registro de cliente
        public function registrarRervacionController(){
            //llamada la metodo del modelo para recuperar los datos que seran mostrados
            $respuesta = Datos::vistaHabitacionesModel("habitaciones");
        ?>
            <div id="">
            <form method="post" class="frm-single " action="index.php?action=reservaciones">
                <div class="inside">
                    <div class="title"><strong>Registrar</strong>&nbsp;Reservación</div>
                  
                  <div class="form-group margin-bottom-20">
                        <select class="form-control" name="habitacion">
                            <option value="">Número de habitación</option>
                           <?php foreach($respuesta as $row => $item){ ?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['id'].' - '.$item['tipo'] ?></option>
                           <?php } ?>
                        </select>
                    </div>

                  <?php 
                    //llamada la metodo del modelo para recuperar los datos que seran mostrados
                    $respuesta = Datos::vistaClientesModel("clientes"); 
                  ?>
                  
                  <div class="form-group margin-bottom-20">
                        <select class="form-control" name="cliente">
                            <option value="">Cliente</option>
                           <?php foreach($respuesta as $row => $item){ ?>
                            <option value="<?php echo $item['id']; ?>"><?php echo $item['nombre'] ?></option>
                           <?php } ?>
                        </select>
                    </div>
                 
										<div class="input-group margin-bottom-20">
											<input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" name="fecha">
											<span class="input-group-addon bg-primary text-white"><i class="fa fa-calendar"></i></span>
										</div>

                   <div class="frm-input"><input type="number" placeholder="Número de noches" name="numeroNoches" class="frm-inp" value="<?php echo $respuesta['telefono']?>" requiered><i class="fa fa-clock-o frm-ico"></i></div>
                  
                    <button type="submit" class="frm-submit btn">Aceptar<i class="fa fa-arrow-circle-right"></i></button>
                    
                </div>
                <!-- .inside -->
            </form>
            <!-- /.frm-single -->
        </div><!--/#single-wrapper -->
        <?php
        }
      
      
      ///Registro de reservacion
        public function insertarReservacionController(){
            //Valida que los campos hayan sido llenados
            if(isset($_POST["numeroNoches"])){
                //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
                $datosController = array("habitacion"=>$_POST["habitacion"], 
                                         "cliente"=>$_POST["cliente"],
                                         "fecha"=>$_POST["fecha"],
                                        "numero"=>$_POST["numeroNoches"]);
    
                //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
                $respuesta = Datos::registroReservacionModel($datosController, "reservaciones");
    
                //Verifica si la insercion ha sido exitosa
                //en caso de ser exitosa mostrara un mensaje que indica el exito de la accion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han insertado los datos exitosamente</p>
                    </div>';
                }
                //En caso de que haya fallado la insercion se motrara un mensaje indicando el fallo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible guardar los datos</p>
                    </div>';
                }
    
            }
    
        }
      
      //Editar Reservacion
        public function editarReservacionController(){
            //Se almacena el id selecciono del registro seleccionado 
            $datosController = $_GET["id"];
            //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
            $respuestaEditar = Datos::editarReservacionModel($datosController, "reservaciones");
            //Se muestran los campos con los datos recuperados tras la consulta
            $respuesta = Datos::vistaHabitacionesModel("habitaciones");
        ?>
            <div id="">
            <form method="post" class="frm-single " action="index.php?action=reservaciones">
                <div class="inside">
                    <div class="title"><strong>Registrar</strong>&nbsp;Reservación</div>
                  
                   <div class="frm-input"><input type="hidden" name="idEditarReservacion" class="frm-inp" value="<?php echo $respuestaEditar['id']?>" requiered></i></div>
                  
                  <div class="form-group margin-bottom-20">
                        <select class="form-control" name="habitacionEditar">
                            <option value="">Número de habitación</option>
                           <?php foreach($respuesta as $row => $item){ ?>
                            <option value="<?php echo $item['id']; ?>" selected= "<?php if($respuestaEditar['id_habitacion'] == $item['id']){ echo 'selected';}?>"><?php echo $item['id'].' - '.$item['tipo'] ?></option>
                           <?php } ?>
                        </select>
                    </div>

                  <?php 
                    //llamada la metodo del modelo para recuperar los datos que seran mostrados
                    $respuesta = Datos::vistaClientesModel("clientes"); 
                  ?>
                  
                  <div class="form-group margin-bottom-20">
                        <select class="form-control" name="clienteEditar">
                            <option value="">Cliente</option>
                           <?php foreach($respuesta as $row => $item){ ?>
                            <option value="<?php echo $item['id']; ?>" selected =" <?php if($respuestaEditar['id_cliente'] == $item['id']){ echo 'selected';}?>"><?php echo $item['nombre'] ?></option>
                           <?php } ?>
                        </select>
                    </div>
                 
										<div class="input-group margin-bottom-20">
											<input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" name="fechaEditar" value="<?php echo date('Y-m-d',strtotime(str_replace('-', '/', $respuestaEditar['fecha_entrada'])))?>">
											<span class="input-group-addon bg-primary text-white"><i class="fa fa-calendar"></i></span>
										</div>

                   <div class="frm-input"><input type="number" placeholder="Número de noches" name="numeroNochesEditar" class="frm-inp" value="<?php echo $respuestaEditar['numero_noches']?>" requiered><i class="fa fa-clock-o frm-ico"></i></div>
                  
                    <button type="submit" class="frm-submit btn">Aceptar<i class="fa fa-arrow-circle-right"></i></button>
                    
                </div>
                <!-- .inside -->
            </form>
            <!-- /.frm-single -->
        </div><!--/#single-wrapper -->
        <?php
        }
      
      //Actualizar Reservacion
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
        public function actualizarReservacionController(){
            //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
            if(isset($_POST["idEditarReservacion"])){
                //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
                $datosController = array("id"=>$_POST["idEditarReservacion"],
                                            "habitacion"=>$_POST["habitacionEditar"],
                                            "cliente"=>$_POST["clienteEditar"],
                                            "noches"=>$_POST["numeroNochesEditar"],
                                            "fecha"=>$_POST["fechaEditar"]);
                //Se hace el llamado al metodo actualizar y se le envian dos parametros: el array con los datos y el nombre de la tabla en la que se hace la modificacion
                $respuesta = Datos::actualizarReservacionModel($datosController, "reservaciones");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han guardado los cambios exitosamente</p>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible guardar los cambios</p>
                    </div>';
                }
    
            }
        
        }
      //borrarReservacionController
      //Eliminar Reservacion
        public function borrarReservacionController(){
            //recupera el id del enlace, este sera usado para hacer referencia al registro a eliminar
            if(isset($_GET["idBorrar"])){
                //datosController almcen el id para ser enviado como parametro
                $datosController = $_GET["idBorrar"];
                //Se realiza el llamado al metodo en el modelo encargado de la eliminacion
                $respuesta = Datos::borrarReservacionModel($datosController, "reservaciones");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <p>Se han eliminado los datos exitosamente</p>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <p>No ha sido posible eliminar los datos</p>
                    </div>';
                }
            }
    
        }
    }
?>