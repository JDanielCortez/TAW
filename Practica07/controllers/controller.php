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
                    //Nombre de la persona a la que le pertenece el usuario
                    $_SESSION["nombre"] = $respuesta["usuario"];
                    //redireciona a la pagina de productos
                    header("Location:index.php?action=inicio");
    
                }
                //en caso de datos incorrectos
                else{
                    //regresa al inicio
                    header("Location:index.php?action=login&res=fallo");
    
                }
    
            }	
        }
      
      /******************************************************************************************************************
      *ALUMNOS-----------------------------------------------------------------------------------------------------------
      ******************************************************************************************************************/
      
        //Vista de los Alumnmos//////////////////////////////////////////////////////////////////////////////////////////
        public function vistaAlumnosController(){
            //llamada la metodo del modelo para recuperar los datos que seran mostrados
            $respuesta = Datos::vistaAlumnosModel("alumnos");
            //Se llenan las filas de la tabla con los datos recuperados
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["id"].'</td>
                    <td>'.$item["nombre"].' '.$item["paterno"].' '.$item["materno"].'</td>
                    <td>'.$item["correo"].'</td>
                    <td>'.$item["telefono"].'</td>
                    <td>
                        <a href="index.php?action=alumnos&id='.$item["id"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="index.php?action=alumnos&idBorrar='.$item["id"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                    </td>
                </tr>';

            }

        }

        //Metodo para mostrar el formulario de registro de Alumno ///////////////////////////////////////////////////////
        public function registrarAlumnoController(){
            ?>
            <div class="box-content card white">
            <h4 class="box-title">Datos del Alumno</h4>
            <!-- /.box-title -->
            
              <div class="card-content">
                <div class="row small-spacing">
                  <form method="post" action="index.php?action=alumnos">
                    <div class="form-group has-inverse col-xs-3">
                      <label >Matricula</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese matricula..." name="matriculaAlumno" required>
                        <i class="fa fa-hashtag item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-5">
                      <label>Nombre</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese nombre(s)..." name="nombreAlumno" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Apellido paterno</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese Ap. Peterno..." name="paternoAlumno" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Apellido Materno</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese Ap. Materno..." name="maternoAlumno" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Correo Electronico</label>
                      <div class="form-with-icon">
                        <input type="email" class="form-control" placeholder="Ingrese correo..." name="correoAlumno" required>
                        <i class="fa fa-envelope item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div class="form-group has-inverse col-xs-4">
                      <label>Telefono</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese telefono..." name="telefonoAlumno" required>
                        <i class="fa fa-phone item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div  class="col-xs-12 margin-top-10" align="right">
                      <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Aceptar</button>
                    </div>
                    </form>
                
                  </div>
              </div>
            </div>
            <?php
        }
      
      ///Registro de Alumnos ////////////////////////////////////////////////////////////////////////////////////////////////
        public function insertarAlumnoController(){
            //Valida que los campos hayan sido llenados
            if(isset($_POST["matriculaAlumno"])){
                //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
                $datosController = array("matricula"=>$_POST["matriculaAlumno"], 
                                         "nombre"=>$_POST["nombreAlumno"],
                                         "paterno"=>$_POST["paternoAlumno"],
                                         "materno"=>$_POST["maternoAlumno"],
                                         "correo" => $_POST['correoAlumno'],
                                         "telefono" => $_POST['telefonoAlumno']);
    
                //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
                $respuesta = Datos::registroAlumnoModel($datosController, "alumnos");
    
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
      
      //Editar Alumno /////////////////////////////////////////////////////////////////////////////////////////////////////
        public function editarAlumnoController(){
            //Se almacena el id selecciono del registro seleccionado 
            $datosController = $_GET["id"];
            //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
            $respuesta = Datos::editarAlumnoModel($datosController, "alumnos");
            //Se muestran los campos con los datos recuperados tras la consulta
           ?>
            <div class="box-content card white">
            <h4 class="box-title">Datos del Alumno</h4>
            <!-- /.box-title -->
            
              <div class="card-content">
                <div class="row small-spacing">
                  <form method="post" action="index.php?action=alumnos">
                    <div class="form-group has-inverse col-xs-3">
                      
                      <div class="form-with-icon">
                        <input type="hidden" class="form-control" placeholder="Ingrese matricula..." name="matriculaAlumnoEditar" value = "<?php echo $respuesta['id']; ?>" required >
                      </div>
                      
                      <label >Matricula</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese matricula..." value = "<?php echo $respuesta['id']; ?>" required disabled>
                        <i class="fa fa-hashtag item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-5">
                      <label>Nombre</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese nombre(s)..." name="nombreAlumnoEditar" value = "<?php echo $respuesta['nombre']; ?>" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Apellido paterno</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese Ap. Peterno..." name="paternoAlumnoEditar" value = "<?php echo $respuesta['paterno']; ?>" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Apellido Materno</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese Ap. Materno..." name="maternoAlumnoEditar" value = "<?php echo $respuesta['materno']; ?>" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Correo Electronico</label>
                      <div class="form-with-icon">
                        <input type="email" class="form-control" placeholder="Ingrese correo..." name="correoAlumnoEditar" value = "<?php echo $respuesta['correo']; ?>" required>
                        <i class="fa fa-envelope item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div class="form-group has-inverse col-xs-4">
                      <label>Telefono</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese telefono..." name="telefonoAlumnoEditar" value = "<?php echo $respuesta['telefono']; ?>" required>
                        <i class="fa fa-phone item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div  class="col-xs-12 margin-top-10" align="right">
                      <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Aceptar</button>
                    </div>
                    </form>
                
                  </div>
              </div>
            </div>
            <?php
        }
      
      
      //Actualizar Alumno
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
        public function actualizarAlumnoController(){
            //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
            if(isset($_POST["matriculaAlumnoEditar"])){
                //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
                $datosController = array("matricula"=>$_POST["matriculaAlumnoEditar"], 
                                         "nombre"=>$_POST["nombreAlumnoEditar"],
                                         "paterno"=>$_POST["paternoAlumnoEditar"],
                                         "materno"=>$_POST["maternoAlumnoEditar"],
                                         "correo" => $_POST['correoAlumnoEditar'],
                                         "telefono" => $_POST['telefonoAlumnoEditar']);
                //Se hace el llamado al metodo actualizar y se le envian dos parametros: el array con los datos y el nombre de la tabla en la que se hace la modificacion
                $respuesta = Datos::actualizarAlumnoModel($datosController, "alumnos");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <h4>Se han guardado los cambios exitosamente</h4>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <h4>No ha sido posible guardar los cambios</h4>
                    </div>';
                }
    
            }
        
        }
      
      //Eliminar Alumno ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function borrarAlumnoController(){
            //recupera el id del enlace, este sera usado para hacer referencia al registro a eliminar
            if(isset($_GET["idBorrar"])){
                //datosController almcen el id para ser enviado como parametro
                $datosController = $_GET["idBorrar"];
                //Se realiza el llamado al metodo en el modelo encargado de la eliminacion
                $respuesta = Datos::borrarAlumnoModel($datosController, "alumnos");
                
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

      
      /******************************************************************************************************************
      *MAESTROS-----------------------------------------------------------------------------------------------------------
      ******************************************************************************************************************/
      
        //Vista de los Maestros
        public function vistaMaestrosController(){
            //llamada la metodo del modelo para recuperar los datos que seran mostrados
            $respuesta = Datos::vistaMaestrosModel("maestros");
            //Se llenan las filas de la tabla con los datos recuperados
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["nombre"].' '.$item["paterno"].' '.$item["materno"].'</td>
                    <td>'.$item["correo"].'</td>
                    <td>'.$item["telefono"].'</td>
                    <td>
                        <a href="index.php?action=maestros&id='.$item["id"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="index.php?action=maestros&idBorrar='.$item["id"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                    </td>
                </tr>';

            }

        }

        //Metodo para mostrar el formulario de registro de Maestro
        public function registrarMaestroController(){
            ?>
            <div class="box-content card white">
            <h4 class="box-title">Datos del Alumno</h4>
            <!-- /.box-title -->
            
              <div class="card-content">
                <div class="row small-spacing">
                  <form  method="post" action="index.php?action=maestros">
                    
                     <div class="form-group has-inverse col-xs-4">
                      <label>Nombre</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese nombre(s)..." name="nombreMaestro" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Apellido paterno</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese Ap. Peterno..." name="paternoMaestro" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Apellido Materno</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese Ap. Materno..." name="maternoMaestro" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-6">
                      <label>Correo Electronico</label>
                      <div class="form-with-icon">
                        <input type="email" class="form-control" placeholder="Ingrese correo..." name="correoMaestro" required>
                        <i class="fa fa-envelope item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div class="form-group has-inverse col-xs-6">
                      <label>Telefono</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese telefono..." name="telefonoMaestro" required>
                        <i class="fa fa-phone item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div  class="col-xs-12 margin-top-10" align="right">
                      <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Aceptar</button>
                    </div>
                    </form>
                
                  </div>
              </div>
            </div>
            <?php
        }
      
      ///Registro de Alumnos ////////////////////////////////////////////////////////////////////////////////////////////////
        public function insertarMaestroController(){
            //Valida que los campos hayan sido llenados
            if(isset($_POST["nombreMaestro"])){
                //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
                $datosController = array("nombre"=>$_POST["nombreMaestro"],
                                         "paterno"=>$_POST["paternoMaestro"],
                                         "materno"=>$_POST["maternoMaestro"],
                                         "correo" => $_POST['correoMaestro'],
                                         "telefono" => $_POST['telefonoMaestro']);
    
                //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
                $respuesta = Datos::registroAlumnoModel($datosController, "maestros");
    
                //Verifica si la insercion ha sido exitosa
                //en caso de ser exitosa mostrara un mensaje que indica el exito de la accion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <h4>Se han insertado los datos exitosamente</h4>
                    </div>';
                }
                //En caso de que haya fallado la insercion se motrara un mensaje indicando el fallo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <h4>No ha sido posible guardar los datos</h4>
                    </div>';
                }
    
            }
    
        }
      
      //Editar Maestro /////////////////////////////////////////////////////////////////////////////////////////////////////
        public function editarMaestroController(){
            //Se almacena el id selecciono del registro seleccionado 
            $datosController = $_GET["id"];
            //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
            $respuesta = Datos::editarMaestroModel($datosController, "maestros");
            //Se muestran los campos con los datos recuperados tras la consulta
           ?>
            <div class="box-content card white">
            <h4 class="box-title">Datos del Maestro</h4>
            <!-- /.box-title -->
            
              <div class="card-content">
                <div class="row small-spacing">
                  <form method="post" action="index.php?action=maestros">
                    
                      
                      <div class="form-with-icon">
                        <input type="hidden" class="form-control" placeholder="Ingrese matricula..." name="idMaestroEditar" value = "<?php echo $respuesta['id']; ?>" required>
                       
                      </div>
                   

                     <div class="form-group has-inverse col-xs-4">
                      <label>Nombre</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese nombre(s)..." name="nombreMaestroEditar" value = "<?php echo $respuesta['nombre']; ?>" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Apellido paterno</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese Ap. Peterno..." name="paternoMaestroEditar" value = "<?php echo $respuesta['paterno']; ?>" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-4">
                      <label>Apellido Materno</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese Ap. Materno..." name="maternoMaestroEditar" value = "<?php echo $respuesta['materno']; ?>" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-6">
                      <label>Correo Electronico</label>
                      <div class="form-with-icon">
                        <input type="email" class="form-control" placeholder="Ingrese correo..." name="correoMaestroEditar" value = "<?php echo $respuesta['correo']; ?>" required>
                        <i class="fa fa-envelope item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div class="form-group has-inverse col-xs-6">
                      <label>Telefono</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese telefono..." name="telefonoMaestroEditar" value = "<?php echo $respuesta['telefono']; ?>" required>
                        <i class="fa fa-phone item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div  class="col-xs-12 margin-top-10" align="right">
                      <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Aceptar</button>
                    </div>
                    </form>
                
                  </div>
              </div>
            </div>
            <?php
        }
      
      //Actualizar Alumno
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
        public function actualizarMaestroController(){
            //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
            if(isset($_POST["idMaestroEditar"])){
                //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
                $datosController = array("id"=>$_POST["idMaestroEditar"], 
                                         "nombre"=>$_POST["nombreMaestroEditar"],
                                         "paterno"=>$_POST["paternoMaestroEditar"],
                                         "materno"=>$_POST["maternoMaestroEditar"],
                                         "correo" => $_POST['correoMaestroEditar'],
                                         "telefono" => $_POST['telefonoMaestroEditar']);
                //Se hace el llamado al metodo actualizar y se le envian dos parametros: el array con los datos y el nombre de la tabla en la que se hace la modificacion
                $respuesta = Datos::actualizarMaestroModel($datosController, "maestros");
                
                //verifica el resultado del llamado al metodo anterior
                //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
                if($respuesta == "success"){
                    echo '<div class="box-content bg-success text-white">
                        <h4>Se han guardado los cambios exitosamente</h4>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <h4>No ha sido posible guardar los cambios</h4>
                    </div>';
                }
    
            }
        
        }
      
      
       
      //Eliminar Maestro ////////////////////////////////////////////////////////////////////////////////////////////////////////////
        public function borrarMaestroController(){
            //recupera el id del enlace, este sera usado para hacer referencia al registro a eliminar
            if(isset($_GET["idBorrar"])){
                //datosController almcen el id para ser enviado como parametro
                $datosController = $_GET["idBorrar"];
                //Se realiza el llamado al metodo en el modelo encargado de la eliminacion
                $respuesta = Datos::borrarMaestroModel($datosController, "maestros");
                
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