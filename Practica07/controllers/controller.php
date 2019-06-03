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
          if(isset($_POST["emailIngreso"])){
            $datosController = array( "email"=>$_POST["emailIngreso"], 
                            "password"=>$_POST["passwordIngreso"]);
      
            $respuesta = Datos::ingresoUsuarioModel($datosController, "maestros");
            
            //Valiación de la respuesta del modelo para ver si es un usuario correcto.
            if($respuesta["email"] == $_POST["emailIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
              session_start();
              $_SESSION["validar"] = true;
              $_SESSION["num_empleado"] = $respuesta["num_empleado"];
              setcookie("nivel",$respuesta["nivel"], time() + (86400 * 30), "/");
              header("location:index.php?action=tutorias");
            }
            else{
              header("location:index.php?action=fallo");
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
                    <td>'.$item["matricula"].'</td>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["carrera"].'</td>
                    <td>'.$item["tutor"].'</td>
                    <td>
                        <a href="index.php?action=alumnos&id='.$item["matricula"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="index.php?action=alumnos&idBorrar='.$item["matricula"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                    </td>
                </tr>';

            }

        }

        //Metodo para mostrar el formulario de registro de Alumno ///////////////////////////////////////////////////////
        public function registrarAlumnoController(){
          $respuesta_carreras = Datos::obtenerCarrerasModel("carrera");
          $respuesta_tutores = Datos::obtenerTutoresModel("maestros");
      
          $st_carreras="";
          for($i=0;$i<sizeof($respuesta_carreras);$i++)
            $st_carreras=$st_carreras."<option value='".$respuesta_carreras[$i]['id']."'>".$respuesta_carreras[$i]['nombre']."</option>";
      
          $st_tutores="";
          for($i=0;$i<sizeof($respuesta_tutores);$i++)
            $st_tutores=$st_tutores."<option value='".$respuesta_tutores[$i]['num_empleado']."'>".$respuesta_tutores[$i]['nombre']."</option>";
          

            ?>
            <div class="col-xs-2"></div>
            <div class="box-content card white col-xs-8">
            <h4 class="box-title">Datos del Alumno</h4>
            <!-- /.box-title -->
            
              <div class="card-content col-xs">
                <div class="row small-spacing">
                  <form method="post" action="index.php?action=alumnos">
                    <div class="form-group has-inverse col-xs-5">
                      <label >Matricula</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese matricula..." name="matriculaAlumno" required>
                        <i class="fa fa-hashtag item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-7">
                      <label>Nombre</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese nombre(s)..." name="nombreAlumno" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>
                  
                    <div class="form-group has-inverse col-xs-12">
                      <label>Carrera</label>
                      <select class="form-control select2_1" name="id_carrera">
                        <?php echo $st_carreras; ?>
					            </select>
                    </div>
                    
                    <div class="form-group has-inverse col-xs-12">
                      <label>Tutor</label>
                      <select class="form-control select2_1" name="id_tutor">
                        <?php echo $st_tutores; ?>
					            </select>
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
                                        "carrera"=>$_POST["id_carrera"],
                                        "tutor"=>$_POST["id_tutor"]);
    
                //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
                $respuesta = Datos::registroAlumnoModel($datosController, "alumnos");
    
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
      
      //Editar Alumno /////////////////////////////////////////////////////////////////////////////////////////////////////
        public function editarAlumnoController(){
            //Se almacena el id selecciono del registro seleccionado 
            $datosController = $_GET["id"];
            //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
            $respuesta = Datos::editarAlumnoModel($datosController, "alumnos");
            $respuesta_carreras = Datos::obtenerCarrerasModel("carrera");
            $respuesta_tutores = Datos::obtenerTutoresModel("maestros");
      
          $st_carreras="";
          $cs="";
          for($i=0;$i<sizeof($respuesta_carreras);$i++){
            if($respuesta_carreras[$i]['id'] == $respuesta['id_carrera']){
              $cs = "selected";
            }else{ $cs = '';}
            $st_carreras=$st_carreras."<option value='".$respuesta_carreras[$i]['id']."' ".$cs." >".$respuesta_carreras[$i]['nombre']."</option>";}
      
          $st_tutores="";
          $ts="";
          for($i=0;$i<sizeof($respuesta_tutores);$i++){
            if($respuesta_tutores[$i]['num_empleado'] == $respuesta['id_tutor']){
              $ts = "selected";
            }else{ $ts = '';}
            $st_tutores=$st_tutores."<option value='".$respuesta_tutores[$i]['num_empleado']."' ". $ts ." >".$respuesta_tutores[$i]['nombre']."</option>";}
          
          

            ?>
            <div class="col-xs-2"></div>
            <div class="box-content card white col-xs-8">
            <h4 class="box-title">Datos del Alumno</h4>
            <!-- /.box-title -->
            
              <div class="card-content col-xs">
                <div class="row small-spacing">
                  <form method="post" action="index.php?action=alumnos">
                    <div class="form-group has-inverse col-xs-5">
                      <label >Matricula</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese matricula..." name="matriculaAlumno" required disabled value="<?php echo $respuesta['matricula'] ?>">
                        <i class="fa fa-hashtag item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <input type="hidden" class="form-control" placeholder="Ingrese matricula..." name="matriculaAlumnoEditar" required value="<?php echo $respuesta['matricula'] ?>">

                     <div class="form-group has-inverse col-xs-7">
                      <label>Nombre</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese nombre(s)..." name="nombreAlumnoEditar" required value="<?php echo $respuesta['nombre'] ?>">
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>
                  
                    <div class="form-group has-inverse col-xs-12">
                      <label>Carrera</label>
                      <select class="form-control select2_1" name="id_carreraEditar">
                        <?php echo $st_carreras; ?>
					            </select>
                    </div>
                    
                    <div class="form-group has-inverse col-xs-12">
                      <label>Tutor</label>
                      <select class="form-control select2_1" name="id_tutorEditar">
                        <?php echo $st_tutores; ?>
					            </select>
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
                                        "carrera"=>$_POST["id_carreraEditar"],
                                        "tutor"=>$_POST["id_tutorEditar"]);
                                        
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
                        <h4>Se han eliminado los datos exitosamente</h4>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <h4>No ha sido posible eliminar los datos</h4>
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
              $item["nivel"]=$item["nivel"]==1?"SuperAdmin":"Maestro";
            echo'<tr>
                    <td>'.$item["num_empleado"].'</td>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["email"].'</td>
                    <td>'.$item["carrera"].'</td>
                    <td>'.$item["nivel"].'</td>
                    <td>
                        <a href="index.php?action=maestros&id='.$item["num_empleado"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        <a href="index.php?action=maestros&idBorrar='.$item["num_empleado"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                    </td>
                </tr>';

            }

        }

        //Metodo para mostrar el formulario de registro de Maestro
        public function registrarMaestroController(){

          $respuesta_carreras = Datos::obtenerCarrerasModel("carrera");
          $st_carreras="";
          for($i=0;$i<sizeof($respuesta_carreras);$i++)
            $st_carreras=$st_carreras."<option value='".$respuesta_carreras[$i]['id']."'>".$respuesta_carreras[$i]['nombre']."</option>";
            ?>
            <div class="col-xs-2"></div>
            <div class="box-content card white col-xs-8">
            <h4 class="box-title">Datos del Maestro</h4>
            <!-- /.box-title -->
            
              <div class="card-content col-xs">
                <div class="row small-spacing">
                  <form  method="post" action="index.php?action=maestros">
                    
                  <div class="form-group has-inverse col-xs-4">
                      <label>Numero de Empleado</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese numero..." name="numeroEmpleado" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>


                     <div class="form-group has-inverse col-xs-8">
                      <label>Nombre</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese nombre(s)..." name="nombreMaestro" required>
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-6">
                      <label>E-mail</label>
                      <div class="form-with-icon">
                        <input type="email" class="form-control" placeholder="Ingrese correo..." name="correoMaestro" required>
                        <i class="fa fa-envelope item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div class="form-group has-inverse col-xs-6">
                      <label>Contraseña</label>
                      <div class="form-with-icon">
                        <input type="password" class="form-control" placeholder="Ingrese contraseña..." name="contrasenaMaestro" required>
                        <i class="fa fa-lock item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div class="form-group has-inverse col-xs-8">
                      <label>Carrera</label>
                      <select class="form-control select2_1" name="id_carrera">
                        <?php echo $st_carreras; ?>
					            </select>
                    </div>

                    <div class="form-group has-inverse col-xs-4">
                      <label>Nivel</label>
                      <select class="form-control select2_1" name="nivelMaestro">
                        <option value="0">Superadmin</option>
                        <option value="1">Maestro</option>
					            </select>
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
      
      ///Registro de Maestros ////////////////////////////////////////////////////////////////////////////////////////////////
        public function insertarMaestroController(){
            //Valida que los campos hayan sido llenados
            if(isset($_POST["numeroEmpleado"])){
                //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
                $datosController = array("numero"=>$_POST['numeroEmpleado'],
                                        "nombre"=>$_POST["nombreMaestro"],
                                        "email"=> $_POST['correoMaestro'],
                                        "carrera"=>$_POST['id_carrera'],
                                        "password"=>$_POST['contrasenaMaestro'],
                                        "nivel"=>$_POST['nivelMaestro']
                                        );
    
                //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
                $respuesta = Datos::registroMaestroModel($datosController, "maestros");
    
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

            $respuesta_carreras = Datos::obtenerCarrerasModel("carrera");
        
            $st_carreras="";
            $cs="";
            for($i=0;$i<sizeof($respuesta_carreras);$i++){
              if($respuesta_carreras[$i]['id'] == $respuesta['id_carrera']){
                $cs = "selected";
              }else{ $cs = '';}
              $st_carreras=$st_carreras."<option value='".$respuesta_carreras[$i]['id']."' ".$cs." >".$respuesta_carreras[$i]['nombre']."</option>";}

            //Se muestran los campos con los datos recuperados tras la consulta
            ?>
            <div class="col-xs-2"></div>
            <div class="box-content card white col-xs-8">
            <h4 class="box-title">Datos del Maestro</h4>
            <!-- /.box-title -->
            
              <div class="card-content col-xs">
                <div class="row small-spacing">
                  <form  method="post" action="index.php?action=maestros">
                    
                  <div class="form-group has-inverse col-xs-4">
                      <label>Numero de Empleado</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese numero..." name="" required disabled value="<?php echo $respuesta['num_empleado']; ?>">
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <input type="hidden" class="form-control" name="numeroEmpleadoEditar" required  value="<?php echo $respuesta['num_empleado']; ?>">

                     <div class="form-group has-inverse col-xs-8">
                      <label>Nombre</label>
                      <div class="form-with-icon">
                        <input type="text" class="form-control" placeholder="Ingrese nombre(s)..." name="nombreMaestroEditar" required  value="<?php echo $respuesta['nombre']; ?>">
                        <i class="fa fa-user item-icon item-icon-right"></i>
                      </div>
                    </div>

                     <div class="form-group has-inverse col-xs-6">
                      <label>E-mail</label>
                      <div class="form-with-icon">
                        <input type="email" class="form-control" placeholder="Ingrese correo..." name="correoMaestroEditar" required  value="<?php echo $respuesta['email']; ?>">
                        <i class="fa fa-envelope item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div class="form-group has-inverse col-xs-6">
                      <label>Contraseña</label>
                      <div class="form-with-icon">
                        <input type="password" class="form-control" placeholder="Ingrese contraseña..." name="contrasenaMaestroEditar" required  value="<?php echo $respuesta['password']; ?>">
                        <i class="fa fa-lock item-icon item-icon-right"></i>
                      </div>
                    </div>

                    <div class="form-group has-inverse col-xs-8">
                      <label>Carrera</label>
                      <select class="form-control select2_1" name="id_carreraEditar">
                        <?php echo $st_carreras; ?>
					            </select>
                    </div>

                    <div class="form-group has-inverse col-xs-4">
                      <label>Nivel</label>
                      <select class="form-control select2_1" name="nivelMaestroEditar">
                        <option value="0" <?php if($respuesta['nivel'] == '0'){ echo 'selected';} ?>>Superadmin</option>
                        <option value="1"  <?php if($respuesta['nivel'] == '1'){ echo 'selected';} ?>>Maestro</option>
					            </select>
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
      
      //Actualizar Maestro
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
        public function actualizarMaestroController(){
            //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
            if(isset($_POST["numeroEmpleadoEditar"])){
                //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
                $datosController = array("numero"=>$_POST['numeroEmpleadoEditar'],
                                        "nombre"=>$_POST["nombreMaestroEditar"],
                                        "email"=> $_POST['correoMaestroEditar'],
                                        "carrera"=>$_POST['id_carreraEditar'],
                                        "password"=>$_POST['contrasenaMaestroEditar'],
                                        "nivel"=>$_POST['nivelMaestroEditar']
                                        );
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
                        <h4>Se han eliminado los datos exitosamente</h4>
                    </div>';
                }
                //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
                else{
                    echo '<div class="box-content bg-danger text-white">
                        <h4>No ha sido posible eliminar los datos</h4>
                    </div>';
                }
            }
    
        }
      

      /******************************************************************************************************************
      *MATERIAS-----------------------------------------------------------------------------------------------------------
      ******************************************************************************************************************/
      
        //Vista de los Materia
        public function vistaMateriasController(){
          //llamada la metodo del modelo para recuperar los datos que seran mostrados
          $respuesta = Datos::vistaMateriasModel("materias");
          //Se llenan las filas de la tabla con los datos recuperados
          foreach($respuesta as $row => $item){
          echo'<tr>
                  <td>'.$item["nombre"].'</td>
                  <td>'.$item["carrera"].'</td>
                  <td>'.$item["maestro"].'</td>
                  <td>
                      <a href="index.php?action=materias&ver=1&id='.$item["id_materia"].'" class="edit" title="Consultar" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                      <a href="index.php?action=materias&id='.$item["id_materia"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                      <a href="index.php?action=materias&idBorrar='.$item["id_materia"].'" class="danger" title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                  </td>
              </tr>';

          }

      }

      //Consulta de los Materia para mostrar sus datos
      public function consultarMateriaController(){
        //Se almacena el id selecciono del registro seleccionado 
        $datosController = $_GET["id"];
        //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
        $respuesta = Datos::consultarMateriaModel($datosController, "materias");
        $respuesta_inscritos = Datos::consultarMateriaInscritosModel($datosController,"materias");
        $respuesta_alumnos =  Datos::obtenerAlumnosCarreraModel("alumnos", $respuesta['id_carrera']);


        $st_alumnos="";
        for($i=0;$i<sizeof($respuesta_alumnos);$i++)
          $st_alumnos=$st_alumnos."<option value='".$respuesta_alumnos[$i]['matricula']."'>".$respuesta_alumnos[$i]['nombre']."</option>";

        ?>
          <div class="box-content card white col-xs-5">
            <h4 class="box-title">Datos de la Materia</h4>
            <!-- /.box-title -->
              <div class="card-content col-xs">
                <div class="row small-spacing">
                  <b>Nombre:</b>&nbsp;<?php echo $respuesta['nombre'];?><br>
                  <b>Carrera:</b>&nbsp;<?php echo $respuesta['carrera'];?><br>
                  <b>Maestro:</b>&nbsp;<?php echo $respuesta['maestro'];?><br>
                </div>
              </div>
          </div>
          <div class="col-xs-1"></div>
          
          <div class="box-content card white col-xs-6">
            <h4 class="box-title">Dar de alta alumno</h4>
            <!-- /.box-title -->
              <div class="card-content col-xs">
                <div class="row small-spacing">
                <form method="post" action="index.php?action=materias&ver=1&id=<?php echo $_GET['id'];?>">
                  <input type="hidden" name="id_materiaAlta" value="<?php echo $_GET['id'];?>">
                  <div class="form-group has-inverse col-xs-8">
                    <select class="form-control select2_1" name="id_alumnoMateria">
                      <?php echo $st_alumnos; ?>
                    </select>
                  </div>

                  <div  class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Aceptar</button>
                  </div>

                  </form>
                </div>
              </div>
          </div>

          <div class="box-content col-xs-12">
              <h4 class="box-title">Alumnos inscritos a la materia</h4>
              <!-- /.box-title -->    
            
              <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                  <thead>
                      <tr>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php
                      foreach($respuesta_inscritos as $row => $item){
                        echo'<tr>
                                <td>'.$item["matricula_alumno"].'</td>
                                <td>'.$item["nombre"].'</td>
                                <td>
                                    <a href="index.php?action=materias&ver=1&id='.$_GET["id"].'&idBaja='.$item["matricula_alumno"].'" class="danger" title="Dar de baja" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                                </td>
                            </tr>';
                      }
                      ?>
                  </tbody>
              </table>
            </div>
        <?php
      }

      ///Registro de un alumno en una materia//////////////////////////////////////////////////////////////////////////////////
      public function altaMateriaAlumnoController(){
        //Valida que los campos hayan sido llenados
        if(isset($_POST["id_materiaAlta"])){
            //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
            $datosController = array("id_materia"=>$_POST['id_materiaAlta'],
                                    "matricula"=>$_POST["id_alumnoMateria"]
                                    );

            //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
            $respuesta = Datos::altaMateriaAlumnoModel($datosController, "materia_alumno");

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

       ////Baja de un alumno en una materia////////////////////////////////////////////////////////////////////////
       public function bajaMateriaAlumnoController(){
        //Valida que los campos hayan sido llenados
        if(isset($_GET["idBaja"])){
            //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
            $datosController =array("materia"=>$_GET['id'],
                                    "matricula"=>$_GET["idBaja"]
                                    );

            //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
            $respuesta = Datos::bajaMateriaAlumnoModel($datosController, "materia_alumno");

            //Verifica si la insercion ha sido exitosa
            //en caso de ser exitosa mostrara un mensaje que indica el exito de la accion
            if($respuesta == "success"){
                echo '<div class="box-content bg-success text-white">
                    <h4>Se han eliminado los datos exitosamente</h4>
                </div>';
            }
            //En caso de que haya fallado la insercion se motrara un mensaje indicando el fallo
            else{
                echo '<div class="box-content bg-danger text-white">
                    <h4>No ha sido posible eliminar los datos</h4>
                </div>';
            }

        }

      }

      //Metodo para mostrar el formulario de registro de Materia ///////////////////////////////////////////////////////
      public function registrarMateriaController(){
        $respuesta_carreras = Datos::obtenerCarrerasModel("carrera");
        $respuesta_tutores = Datos::obtenerTutoresModel("maestros");
    
        $st_carreras="";
        for($i=0;$i<sizeof($respuesta_carreras);$i++)
          $st_carreras=$st_carreras."<option value='".$respuesta_carreras[$i]['id']."'>".$respuesta_carreras[$i]['nombre']."</option>";
    
        $st_tutores="";
        for($i=0;$i<sizeof($respuesta_tutores);$i++)
          $st_tutores=$st_tutores."<option value='".$respuesta_tutores[$i]['num_empleado']."'>".$respuesta_tutores[$i]['nombre']."</option>";
        

          ?>
          <div class="col-xs-3"></div>
          <div class="box-content card white col-xs-6">
          <h4 class="box-title">Datos de Materia</h4>
          <!-- /.box-title -->
          
            <div class="card-content col-xs">
              <div class="row small-spacing">
                <form method="post" action="index.php?action=materias">
                  <div class="form-group has-inverse col-xs-12">
                    <label >Nombre</label>
                    <div class="form-with-icon">
                      <input type="text" class="form-control" placeholder="Ingrese nombre de materia..." name="nombreMateria" required>
                      <i class="fa fa-book item-icon item-icon-right"></i>
                    </div>
                  </div>
                
                  <div class="form-group has-inverse col-xs-12">
                    <label>Carrera</label>
                    <select class="form-control select2_1" name="id_carrera">
                      <?php echo $st_carreras; ?>
                    </select>
                  </div>
                  
                  <div class="form-group has-inverse col-xs-12">
                    <label>Maestro</label>
                    <select class="form-control select2_1" name="id_maestro">
                      <?php echo $st_tutores; ?>
                    </select>
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

      ///Registro de Materia ////////////////////////////////////////////////////////////////////////////////////////////////
      public function insertarMateriaController(){
        //Valida que los campos hayan sido llenados
        if(isset($_POST["nombreMateria"])){
            //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
            $datosController = array("nombre"=>$_POST['nombreMateria'],
                                    "carrera"=>$_POST["id_carrera"],
                                    "maestro"=> $_POST['id_maestro']
                                    );

            //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
            $respuesta = Datos::registroMateriaModel($datosController, "materias");

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

      //Editar Materia /////////////////////////////////////////////////////////////////////////////////////////////////////
      public function editarMateriaController(){
        //Se almacena el id selecciono del registro seleccionado 
        $datosController = $_GET["id"];
        //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
        $respuesta = Datos::editarMateriaModel($datosController, "materias");
        $respuesta_carreras = Datos::obtenerCarrerasModel("carrera");
        $respuesta_maestros = Datos::obtenerTutoresModel("maestros");
  
        $st_carreras="";
        $cs="";
        for($i=0;$i<sizeof($respuesta_carreras);$i++){
          if($respuesta_carreras[$i]['id'] == $respuesta['id_carrera']){
            $cs = "selected";
          }else{ $cs = '';}
          $st_carreras=$st_carreras."<option value='".$respuesta_carreras[$i]['id']."' ".$cs." >".$respuesta_carreras[$i]['nombre']."</option>";}
    
        $st_tutores="";
        $ts="";
        for($i=0;$i<sizeof($respuesta_maestros);$i++){
          if($respuesta_maestros[$i]['num_empleado'] == $respuesta['num_empleado']){
            $ts = "selected";
          }else{ $ts = '';}
          $st_tutores=$st_tutores."<option value='".$respuesta_maestros[$i]['num_empleado']."' ". $ts ." >".$respuesta_maestros[$i]['nombre']."</option>";}
        
          ?>
          <div class="col-xs-3"></div>
          <div class="box-content card white col-xs-6">
          <h4 class="box-title">Datos de Materia</h4>
          <!-- /.box-title -->
          
            <div class="card-content col-xs">
              <div class="row small-spacing">
                <form method="post" action="index.php?action=materias">
                  <div class="form-group has-inverse col-xs-12">
                    <label >Nombre</label>
                    <div class="form-with-icon">
                      <input type="text" class="form-control" placeholder="Ingrese nombre de materia..." name="nombreMateriaEditar" required value="<?php echo $respuesta['nombre']; ?>">
                      <i class="fa fa-book item-icon item-icon-right"></i>
                    </div>
                  </div>
                
                  <input type="hidden" name="id_materiaEditar" required value="<?php echo $respuesta['id_materia']; ?>">

                  <div class="form-group has-inverse col-xs-12">
                    <label>Carrera</label>
                    <select class="form-control select2_1" name="id_carreraEditar">
                      <?php echo $st_carreras; ?>
                    </select>
                  </div>
                  
                  <div class="form-group has-inverse col-xs-12">
                    <label>Maestro</label>
                    <select class="form-control select2_1" name="id_maestroEditar">
                      <?php echo $st_tutores; ?>
                    </select>
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


      //Actualizar Materia
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
       public function actualizarMateriaController(){
          //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
          if(isset($_POST["id_materiaEditar"])){
              //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
              $datosController = array("nombre"=>$_POST['nombreMateriaEditar'],
                                      "carrera"=>$_POST["id_carreraEditar"],
                                      "maestro"=> $_POST['id_maestroEditar'],
                                      "id"=>$_POST['id_materiaEditar']
                                    );
              //Se hace el llamado al metodo actualizar y se le envian dos parametros: el array con los datos y el nombre de la tabla en la que se hace la modificacion
              $respuesta = Datos::actualizarMateriaModel($datosController, "materias");
              
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

       //Eliminar Materia/////////////////////////////////////////////////////////////////////////////////////////////////////
      public function borrarMateriaController(){
        //recupera el id del enlace, este sera usado para hacer referencia al registro a eliminar
        if(isset($_GET["idBorrar"])){
            //datosController almcen el id para ser enviado como parametro
            $datosController = $_GET["idBorrar"];
            //Se realiza el llamado al metodo en el modelo encargado de la eliminacion
            $respuesta = Datos::borrarMateriaModel($datosController, "materias");
            
            //verifica el resultado del llamado al metodo anterior
            //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
            if($respuesta == "success"){
                echo '<div class="box-content bg-success text-white">
                    <h4>Se han eliminado los datos exitosamente</h4>
                </div>';
            }
            //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
            else{
                echo '<div class="box-content bg-danger text-white">
                    <h4>No ha sido posible eliminar los datos</h4>
                </div>';
            }
        }

    }

    /******************************************************************************************************************
      *GRUPOS-----------------------------------------------------------------------------------------------------------
      ******************************************************************************************************************/
      
      //Vista de los Grupo
      public function vistaGruposController(){
          //llamada la metodo del modelo para recuperar los datos que seran mostrados
          $respuesta = Datos::vistaGruposModel("grupos");
          //Se llenan las filas de la tabla con los datos recuperados
          foreach($respuesta as $row => $item){
          echo'<tr>
                  <td>'.$item["nombre"].'</td>
                  <td>'.$item["carrera"].'</td>
                  <td>
                      <a href="index.php?action=grupos&ver=1&id='.$item["id_grupo"].'" class="edit" title="Consultar" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                      <a href="index.php?action=grupos&id='.$item["id_grupo"].'" class="edit" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                      <a href="index.php?action=grupos&idBorrar='.$item["id_grupo"].'" class="danger" title="Editar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                  </td>
              </tr>';

          }

      }

        //Consulta de los Grupo para mostrar sus datos
        public function consultarGrupoController(){
          //Se almacena el id selecciono del registro seleccionado 
          $datosController = $_GET["id"];
          //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
          $respuesta = Datos::consultarGrupoModel($datosController, "grupos");
          $respuesta_mg = Datos::consultarGrupoMateriaModel($datosController,"materias");
          $respuesta_materias =  Datos::obtenerMateriasCarreraModel("materias", $respuesta['id_carrera']);
  
  
          $st_materias="";
          for($i=0;$i<sizeof($respuesta_materias);$i++)
            $st_materias=$st_materias."<option value='".$respuesta_materias[$i]['id_materia']."'>".$respuesta_materias[$i]['nombre']." - ".$respuesta_materias[$i]['maestro']."</option>";
  
          ?>
            <div class="box-content card white col-xs-5">
              <h4 class="box-title">Datos del Grupo</h4>
              <!-- /.box-title -->
                <div class="card-content col-xs">
                  <div class="row small-spacing">
                    <b>Nombre:</b>&nbsp;<?php echo $respuesta['nombre'];?><br>
                    <b>Carrera:</b>&nbsp;<?php echo $respuesta['carrera'];?><br><br>
                  </div>
                </div>
            </div>

            <div class="col-xs-1"></div>
            
            <div class="box-content card white col-xs-6">
              <h4 class="box-title">Dar de alta materia</h4>
              <!-- /.box-title -->
                <div class="card-content col-xs">
                  <div class="row small-spacing">
                  <form method="post" action="index.php?action=grupos&ver=1&id=<?php echo $_GET['id'];?>">
                    <input type="hidden" name="id_grupoAlta" value="<?php echo $_GET['id'];?>">
                    <div class="form-group has-inverse col-xs-8">
                      <select class="form-control select2_1" name="id_materiaGrupo">
                        <?php echo $st_materias; ?>
                      </select>
                    </div>
  
                    <div  class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Aceptar</button>
                    </div>
  
                    </form>
                  </div>
                </div>
            </div>
  
            <div class="box-content col-xs-12">
                <h4 class="box-title">Materias pertenecientes al grupo</h4>
                <!-- /.box-title -->    
              
                <table  id="example" class="table table-striped table-bordered display" style="width:100%;" >
                    <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>Nombre</th>
                          <th>Acciones</th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach($respuesta_mg as $row => $item){
                          echo'<tr>
                                  <td>'.$item["nombre"].'</td>
                                  <td>
                                      <a href="index.php?action=grupos&ver=1&id='.$_GET["id"].'&idBaja='.$item["id_materia"].'" class="danger" title="Dar de baja" data-toggle="tooltip"><i class="fa fa-trash"></i></a>  
                                  </td>
                              </tr>';
                        }
                        ?>
                    </tbody>
                </table>
              </div>
          <?php
        }

      ///Registro de una materia en un grupo//////////////////////////////////////////////////////////////////////////////////
      public function altaGrupoMateriaController(){
        //Valida que los campos hayan sido llenados
        if(isset($_POST["id_grupoAlta"])){
            //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
            $datosController = array("id_materia"=>$_POST['id_materiaGrupo'],
                                    "id_grupo"=>$_POST["id_grupoAlta"]
                                    );

            //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
            $respuesta = Datos::altaMateriaGrupoModel($datosController, "grupo_materia");

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


     ////Baja de un materia en una grupo////////////////////////////////////////////////////////////////////////
     public function bajaGrupoMateriaController(){
      //Valida que los campos hayan sido llenados
      if(isset($_GET["idBaja"])){
          //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
          $datosController =array("materia"=>$_GET['idBaja'],
                                  "grupo"=>$_GET["id"]
                                  );

          //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
          $respuesta = Datos::bajaGrupoMateriaModel($datosController, "grupo_materia");

          //Verifica si la insercion ha sido exitosa
          //en caso de ser exitosa mostrara un mensaje que indica el exito de la accion
          if($respuesta == "success"){
              echo '<div class="box-content bg-success text-white">
                  <h4>Se han eliminado los datos exitosamente</h4>
              </div>';
          }
          //En caso de que haya fallado la insercion se motrara un mensaje indicando el fallo
          else{
              echo '<div class="box-content bg-danger text-white">
                  <h4>No ha sido posible eliminar los datos</h4>
              </div>';
          }

      }

    }


       //Metodo para mostrar el formulario de registro de Grupo ///////////////////////////////////////////////////////
       public function registrarGrupoController(){
        $respuesta_carreras = Datos::obtenerCarrerasModel("carrera");
    
        $st_carreras="";
        for($i=0;$i<sizeof($respuesta_carreras);$i++)
          $st_carreras=$st_carreras."<option value='".$respuesta_carreras[$i]['id']."'>".$respuesta_carreras[$i]['nombre']."</option>";

          ?>
          <div class="col-xs-3"></div>
          <div class="box-content card white col-xs-6">
          <h4 class="box-title">Datos de Grupo</h4>
          <!-- /.box-title -->
          
            <div class="card-content col-xs">
              <div class="row small-spacing">
                <form method="post" action="index.php?action=grupos">
                  <div class="form-group has-inverse col-xs-12">
                    <label >Nombre</label>
                    <div class="form-with-icon">
                      <input type="text" class="form-control" placeholder="Ingrese nombre de materia..." name="nombreGrupo" required>
                      <i class="fa fa-users item-icon item-icon-right"></i>
                    </div>
                  </div>
                
                  <div class="form-group has-inverse col-xs-12">
                    <label>Carrera</label>
                    <select class="form-control select2_1" name="id_carrera">
                      <?php echo $st_carreras; ?>
                    </select>
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

      ///Registro de Grupo ////////////////////////////////////////////////////////////////////////////////////////////////
      public function insertarGrupoController(){
        //Valida que los campos hayan sido llenados
        if(isset($_POST["nombreGrupo"])){
            //los datos que seran insertados en la base de datos se almacenan en una array que sera enviado como parametro al metodo que realiza la insercion
            $datosController = array("nombre"=>$_POST['nombreGrupo'],
                                    "carrera"=>$_POST["id_carrera"]
                                    );

            //Llamada al metodo del modelo realiazar la insercion, envia como parametro el array con los datos a insertar y el nombre de la tabla en la cual seran insertados los datos
            $respuesta = Datos::registroGrupoModel($datosController, "grupos");

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

      //Metodo para mostrar el formulario de edicion de Grupo ///////////////////////////////////////////////////////
      public function editarGrupoController(){
        //Se almacena el id selecciono del registro seleccionado 
        $datosController = $_GET["id"];
        //Se hace un llamado al metodo del modelo que hace una consulta para traer los registros con ese id
        $respuesta = Datos::editarGrupoModel($datosController, "grupos");
        $respuesta_carreras = Datos::obtenerCarrerasModel("carrera");
    
        $st_carreras="";
        $cs="";
        for($i=0;$i<sizeof($respuesta_carreras);$i++){
          if($respuesta_carreras[$i]['id'] == $respuesta['id_carrera']){
            $cs = "selected";
          }else{ $cs = '';}
          $st_carreras=$st_carreras."<option value='".$respuesta_carreras[$i]['id']."' ".$cs." >".$respuesta_carreras[$i]['nombre']."</option>";}

          ?>
          <div class="col-xs-3"></div>
          <div class="box-content card white col-xs-6">
          <h4 class="box-title">Datos de Grupo</h4>
          <!-- /.box-title -->
          

            <div class="card-content col-xs">
              <div class="row small-spacing">
                <form method="post" action="index.php?action=grupos">
                  <div class="form-group has-inverse col-xs-12">

                  <input type="hidden" class="form-control" name="id_grupoEditar" required value="<?php echo $respuesta['id_grupo'] ?>">


                    <label >Nombre</label>
                    <div class="form-with-icon">
                      <input type="text" class="form-control" placeholder="Ingrese nombre de materia..." name="nombreGrupoEditar" required value="<?php echo $respuesta['nombre'] ?>">
                      <i class="fa fa-users item-icon item-icon-right"></i>
                    </div>
                  </div>
                
                  <div class="form-group has-inverse col-xs-12">
                    <label>Carrera</label>
                    <select class="form-control select2_1" name="id_carreraEditar">
                      <?php echo $st_carreras; ?>
                    </select>
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


      //Actualizar Grupo
        //Una vez se han cambiado los datos, en los campos y se da clic en aceptar se recarga la pagina para que la llamada al metodo de actalizacion se realice
        public function actualizarGrupoController(){
          //Para realizar la actualizacio  es necesario que se encuentre en el POST el campo con el nombre que hace referencia a EDITAR
          if(isset($_POST["id_grupoEditar"])){
              //Se crea un array con los datos que se reciben del post (de los campos que se llenan), el cual sera enviado al metodo de actualizar para modificar los registros de la base de datos
              $datosController = array("nombre"=>$_POST['nombreGrupoEditar'],
                                      "carrera"=>$_POST["id_carreraEditar"],
                                      "id"=>$_POST['id_grupoEditar']
                                    );
              //Se hace el llamado al metodo actualizar y se le envian dos parametros: el array con los datos y el nombre de la tabla en la que se hace la modificacion
              $respuesta = Datos::actualizarGrupoModel($datosController, "grupos");
              
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

        //Eliminar Grupo/////////////////////////////////////////////////////////////////////////////////////////////////////
        public function borrarGrupoController(){
          //recupera el id del enlace, este sera usado para hacer referencia al registro a eliminar
          if(isset($_GET["idBorrar"])){
              //datosController almcen el id para ser enviado como parametro
              $datosController = $_GET["idBorrar"];
              //Se realiza el llamado al metodo en el modelo encargado de la eliminacion
              $respuesta = Datos::borrarGrupoModel($datosController, "grupos");
              
              //verifica el resultado del llamado al metodo anterior
              //Si ha sido exitoso mostrara un mensaje indicando el exito de la operacion
              if($respuesta == "success"){
                  echo '<div class="box-content bg-success text-white">
                      <h4>Se han eliminado los datos exitosamente</h4>
                  </div>';
              }
              //En caso de no ser exitoso se muestra un mensaje indicando el fallo del metodo
              else{
                  echo '<div class="box-content bg-danger text-white">
                      <h4>No ha sido posible eliminar los datos</h4>
                  </div>';
              }
          }
  
      }


       /******************************************************************************************************************
      *TUTORIAS-----------------------------------------------------------------------------------------------------------
      ******************************************************************************************************************/
     

      #REGISTRO TUTORIAS
      #------------------------------------
      #Genera la interfaz que muestra en una tabla todos los registros almacenados
      public function vistaTutoriasController(){
        if($_COOKIE['nivel']==1)
          $respuesta = Datos::vistaTutoriasModel("sesion_tutoria");
        else
          $respuesta = Datos::vistaTutoriasNivelModel("sesion_tutoria",$_SESSION["num_empleado"]);		
        foreach($respuesta as $row => $item){
        echo'<tr>
            <td>'.$item["id"].'</td>
            <td>'.$item["fecha"].'</td>
            <td>'.$item["hora"].'</td>
            <td>'.$item["tema"].'</td>
            <td>'.$item["tipo"].'</td>
            <td><a href="index.php?action=editar_tutoria&id='.$item["id"].'"><button class="small warning">Editar</button></a></td>
            <td><a href="index.php?action=tutorias&idBorrar='.$item["id"].'"><button class="small alert">Borrar</button></a></td>
          </tr>';
        }
      }

      #BORRAR TUTORIAS
      #------------------------------------
      #Permite el eliminado de las tutorais llamando el modelo
      public function borrarTutoriaController(){

        if(isset($_GET["idBorrar"])){
          $datosController = $_GET["idBorrar"];
          $respuesta = Datos::borrarAlumnosTutoriaModel($datosController, "sesion_alumnos");
          $respuesta = Datos::borrarTutoriaModel($datosController, "sesion_tutoria");
          
          if($respuesta == "success"){
            header("location:index.php?action=tutorias");
          }
        }
      }
  
      #REGISTRAR TUTORIAS
      #------------------------------------
      #Permite el registro de una tutoria en la base de datos
      public function registroTutoriaController(){	  
        if(isset($_POST["fecha"])){
          $datosController = array(
                          "hora"=>$_POST["hora"],
                          "fecha"=>$_POST["fecha"],
                          "tema"=>$_POST["tema"],
                          "tipo"=>$_POST["tipo"],
                          "num_maestro"=>$_POST["num_maestro"]
                      );

          $respuesta = Datos::registroTutoriaModel($datosController, "sesion_tutoria");
          
          if(isset($_POST['hid'])){
            $data = $_POST['hid'];

            $id_sesion = Datos::ObtenerLastTutoria("sesion_tutoria");

            $respuesta = Datos::registroAlumnosTutoriaModel($data, $id_sesion[0], "sesion_alumnos");
            }
            
          if($respuesta == "success"){
            header("location:index.php?action=tutorias&");
          }
          else{
            header("location:index.php");
          }
        
        }
        
      }
  
      #REGISTRO BASE DE TUTORIAS
      #------------------------------------
      #Genera la interfaz base para el registro de las tutorias
      public function registroBaseTutoriaController(){
        if($_COOKIE['nivel']==1){
          $respuesta_alumnos = Datos::obtenerAlumnosModel("alumnos");}
        else{
          $respuesta_alumnos = Datos::obtenerAlumnosNivelModel("alumnos",$_SESSION['num_empleado']);}
          
        $st_alumnos="";
        for($i=0;$i<sizeof($respuesta_alumnos);$i++)
          $st_alumnos=$st_alumnos."<option value='".$respuesta_alumnos[$i]['matricula']."'>".$respuesta_alumnos[$i]['nombre']."</option>";

          
        echo'
          <input type="hidden" id="hid" name="hid"></input>
          <table>
            <tr>
              <td>
                <h4>Detalles en la tutoria</h4>
                <input type="hidden" name="num_maestro" value="'.$_SESSION['num_empleado'].'" required>
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" required>
                <label for="hora">Hora:</label>
                <input type="time" name="hora" required>
                <label for="tipo">Tipo:</label>
                <select name="tipo" required>
                  <option value="Grupal">Grupal</option>
                  <option value="Individual">Individual</option>
                </select>
                <label for="Tema">Tema:</label>
                <input type="text" name="tema" required>
                <button class="small success" onclick="sendData();" type="submit">Registrar</button>
                
              </td>
              <td>
                <h4>Alumnos en la tutoria</h4>
                <table>
                  <tr>
                    <td>
                    <label for="alumno">Nombre del Alumno:</label>
                    <select name="alumno" class="js-example-basic-multiple" id="alumno">
                      '.$st_alumnos.'
                    </select>
                    <br><br>
                  </td>
                  <td>
                    <button type="button" class="small success" onclick="addAlumno()">Agregar Alumno</button>
                  </td>
                </tr>
                <table>
                <table id="alumnos"></table>
              </td>
            </tr>
          </table>';

        echo'<script>
            $(document).ready(function() {
              $(".js-example-basic-multiple").select2();
            });

            var alumnos=[];
            var send_alumnos=[];
            var tab = document.getElementById("alumnos");

            function updateTable(){
              tab.innerHTML="<tr><th>Matricula</th><th>Nombre</th><th>¿Eliminar?</th><tr>";
              for(var i=0;i<alumnos.length;i++){
                tab.innerHTML=tab.innerHTML+"<tr><td>"+alumnos[i][0]+"</td><td>"+alumnos[i][1]+"</td><td><button class=\'alert\' type=\'button\' onclick=\'deleteAlumno("+i+");\'>Eliminar</button></td><tr>";
              }
            }

            function addAlumno(){
              
              var select = document.getElementById("alumno");
              var flag=false;
              for(var i=0;i<alumnos.length;i++){
                if(alumnos[i][0]==select.options[select.selectedIndex].value && alumnos[i][1]==select.options[select.selectedIndex].text){
                  flag=true;
                  break;
                }
              }

              if(!flag){
                alumnos.push([select.options[select.selectedIndex].value,select.options[select.selectedIndex].text]);
                send_alumnos.push([select.options[select.selectedIndex].value]);
                updateTable();						
              }else{
                alert("Alumno ya Agregado");
              }
            }

            function deleteAlumno(index){
              alumnos.splice(index, 1);
              send_alumnos.splice(index, 1);
              updateTable();
            }

            function sendData(){
              var hid = document.getElementById("hid");
              hid.value=send_alumnos;
            }

          </script>';
      }

      #EDICION DE TUTORIAS
      #------------------------------------
      #Se encarga de controlar la edicion de una tutoria
      public function editarTutoriaController(){

        $datosController = $_GET["id"];
        $respuesta = Datos::editarTutoriaModel($datosController, "sesion_tutoria");
        
        $respuesta_alumnos = Datos::obtenerAlumnosModel("alumnos");
        $respuesta_alumnosTutoria = Datos::obtenerAlumnosTutoriaModel($datosController,"sesion_alumnos");

        $st_alumnos="";
        for($i=0;$i<sizeof($respuesta_alumnos);$i++)
          $st_alumnos=$st_alumnos."<option value='".$respuesta_alumnos[$i]['matricula']."'>".$respuesta_alumnos[$i]['nombre']."</option>";

        echo'
          <input type="hidden" id="hid" name="hid"></input>
          <table>
            <tr>
              <td>
                <h4>Detalles en la tutoria</h4>
                <input type="hidden" value="'.$respuesta["num_maestro"].'" name="num_maestro">
                <label for="fecha">Fecha:</label>
                <input type="date" value="'.$respuesta["fecha"].'" name="fecha" required>
                <label for="hora">Hora:</label>
                <input type="time" value="'.$respuesta["hora"].'" name="hora" required>
                <label for="tipo">Tipo:</label>
                <select id="tipos" name="tipo" required>
                  <option value="Grupal">Grupal</option>
                  <option value="Individual">Individual</option>
                </select>
                <label for="tema">Tema:</label>
                <input type="text" value="'.$respuesta["tema"].'" name="tema" required>
                <button class="small success" onclick="sendData();" type="submit">Actualizar</button>
              <td>
                <h4>Alumnos en la tutoria</h4>
                <table>
                  <tr>
                    <td>
                    <label for="alumno">Nombre del Alumno:</label>
                    <select name="alumno" class="js-example-basic-multiple" id="alumno">
                      '.$st_alumnos.'
                    </select>
                    <br><br>
                  </td>
                  <td>
                    <button type="button" class="small success" onclick="addAlumno()">Agregar Alumno</button>
                  </td>
                </tr>
                <table>
                <table id="alumnos"></table>
              </td>
            </tr>
          </table>';

        echo'
        <script>
          $("#tipos").val("'.$respuesta["tipo"].'");
          $(document).ready(function() {
            $(".js-example-basic-multiple").select2();
            fillTable();
          });

          var alumnos=[];
          var send_alumnos=[];
          var tab = document.getElementById("alumnos");


          function fillTable(){
            var resp_at = '.json_encode($respuesta_alumnosTutoria).';
            alumnos=resp_at;
            for(var i=0;i<alumnos.length;i++){
              send_alumnos[i]=alumnos[i][0];
            }
            updateTable();
          }

          function updateTable(){
            tab.innerHTML="<tr><th>Matricula</th><th>Nombre</th><th>¿Eliminar?</th><tr>";
            for(var i=0;i<alumnos.length;i++){
              tab.innerHTML=tab.innerHTML+"<tr><td>"+alumnos[i][0]+"</td><td>"+alumnos[i][1]+"</td><td><button class=\'alert\' type=\'button\' onclick=\'deleteAlumno("+i+");\'>Eliminar</button></td><tr>";
            }
          }

          function addAlumno(){
            
            var select = document.getElementById("alumno");
            var flag=false;
            for(var i=0;i<alumnos.length;i++){
              if(alumnos[i][0]==select.options[select.selectedIndex].value && alumnos[i][1]==select.options[select.selectedIndex].text){
                flag=true;
                break;
              }
            }

            if(!flag){
              alumnos.push([select.options[select.selectedIndex].value,select.options[select.selectedIndex].text]);
              send_alumnos.push([select.options[select.selectedIndex].value]);
              updateTable();						
            }else{
              alert("Alumno ya Agregado");
            }
          }

          function deleteAlumno(index){
            alumnos.splice(index, 1);
            send_alumnos.splice(index, 1);
            updateTable();
          }

          function sendData(){
            var hid = document.getElementById("hid");
            hid.value=send_alumnos;
          }
        </script>';


      }

      #ACTUALIZAR TUTORIAS
      #------------------------------------
      #Permite la actualizacion de la tutoria, al registrarlo en lab base de datos, realiza una eliminacion
      #completa de los alumnos para volver a realizar su insercion
      public function actualizarTutoriaController(){
        if(isset($_POST["hora"])){
          $datosController = array( "id"=>$_GET["id"],
                            "fecha"=>$_POST["fecha"],
                                  "hora"=>$_POST["hora"],
                                  "tipo"=>$_POST["tipo"],
                                  "tema"=>$_POST["tema"]);

          $respuesta = Datos::actualizarTutoriaModel($datosController, "sesion_tutoria");

          $respuesta = Datos::borrarAlumnosTutoriaModel($_GET["id"], "sesion_alumnos");
          
          $data = $_POST['hid'];

          $respuesta = Datos::registroAlumnosTutoriaModel($data, $_GET["id"], "sesion_alumnos");
            
          

          if($respuesta == "success"){
            header("location:index.php?action=cambio_tutoria");
          }
          else{
            echo "error";
          }
        }
      }


  }
?>