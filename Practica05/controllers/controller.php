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

        //Inicio de sesion---------------------------------------------------------
        public function ingresoUsuarioController(){
            //Verifica que los campos para el inicio de sesion hyan sido llenados
            if(isset($_POST["nombreUsuario"])){
    
                //contienene los valores que seran usados en la consulta SELECT para obneter los datos del usuariosados por el usuario
                $datosController = array( "usuario"=>$_POST["nombreUsuario"], 
                                          "password"=>md5($_POST["passwordIngreso"]));
    
                //llamada al metodo del controlador que pide al modelo hacer la consulta
                $respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

                //A partir de los valores retorntados en la llamada anterior se comparan para validar los datos
                if($respuesta["usuario"] == $_POST["nombreUsuario"] && $respuesta["contrasena"] == md5($_POST["contrasena"])){
                    //Inicia sesion
                    session_start();
    
                    $_SESSION["validar"] = true;
                    //redireciona a la pagina de productos
                    header("location:index.php?action=productos");
    
                }
                //en caso de datos incorrectos
                else{
                    //regresa al inicio
                    header("location:index.php?action=fallo");
    
                }
    
            }	
    
        }

        //Registro de usuario
        public function registroUsuarioController(){
            //Valida que los campos hayan sido llenados
            if(isset($_POST["usuarioRegistro"])){
                //Datos que seran insertados en la base de datos para la dracion de un usuario
                $datosController = array( "usuario"=>$_POST["usuarioRegistro"], 
                                          "password"=>$_POST["passwordRegistro"],
                                          "email"=>$_POST["emailRegistro"]);
    
                //Llamada al metodo del controlador que pide al modelo realiazar la insercion
                $respuesta = Datos::registroUsuarioModel($datosController, "usuarios");
    
                //Verifica si la insercion ha sido exitosa
                if($respuesta == "success"){
                    //En caso de que se haya realizado con una sesion iniciada, lo regresa a la tabla de registros
                    if(isset($_SESSION['validar']) and $_SESSION['validar']){
                        header("location:index.php?action=usuarios&crea=ok");
                    }
                    //En caso constrario lo regresa al index para que inicie sesion
                    else{
                        header("location:index.php?action=ok");
                    }
                }
                //Fallo la insercion y redirecciona al index
                else{
                    header("location:index.php?action=registrarUsuario&error=0k");
                }
    
            }
    
        }

        

        //Vista de los usuarios, mustra la tabla con los registros de los usuarios
        public function vistaUsuariosController(){
            //llamada la metodo del modelo para recuperar los datos
            $respuesta = Datos::vistaUsuariosModel("usuarios");
            //Se llenann las filas de la tabla
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["usuario"].'</td>
                    <td>'.$item["contrasena"].'</td>
                    <td>'.$item["correo"].'</td>
                    <td><a href="index.php?action=usuarios&id='.$item["id"].'"><button>Editar</button></a></td>
                    <td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
                </tr>';
    
            }
    
        }


        //Editar Usuario
        public function editarUsuarioController(){
            //id del usuario a modificar
            $datosController = $_GET["id"];
            //llamada al metodo del modelo para realizar una consulta y recuperar los datos de acuerdo al id anterior
            $respuesta = Datos::editarUsuarioModel($datosController, "usuarios");
            //Los inputs del usuario se llenan con los datos del usuario seleccionado
                echo ' <input type="hidden" value="'.$respuesta["id"].'" name="idEditar">
                
                 <input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" placeholder="Usuario" required>

                 <input type="password" value="" name="passwordEditar" placeholder="Contraseña" required>
    
                    
                 <input type="email" value="'.$respuesta["correo"].'" name="emailEditar" placeholder="Email" required>
    
                 <input type="submit" value="Actualizar">';
    
        }

        //Actualizar usuario, actualiza los datos de un usuario a a partir del id
        public function actualizarUsuarioController(){

            //verifica los datos de los campos para editar
            if(isset($_POST["usuarioEditar"])){
    
                //datos que se insertaran al momento de actualziar
                $datosController = array( "id"=>$_POST["idEditar"],
                                          "usuario"=>$_POST["usuarioEditar"],
                                          "password"=>$_POST["passwordEditar"],
                                          "email"=>$_POST["emailEditar"]);
                
                //Llamada al metodo de actulizar e el modelo para, cambiar los datos existentes del usuario 
                $respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");
    
                //Verifica el resultado de la llamada al metodo
                if($respuesta == "success"){
                    
                    header("location:index.php?action=usuarios&cambio=1");
    
                }
    
                else{
    
                    echo "error";
    
                }
    
            }
        
        }

        //Eliminar Usuario
        public function borrarUsuarioController(){
            //recupera 
            if(isset($_GET["idBorrar"])){
    
                $datosController = $_GET["idBorrar"];
                
                $respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");
    
                if($respuesta == "success"){
    
                    header("location:index.php?action=usuarios");
                
                }
    
            }
    
        }

        /**PRODUCTOS CONTROLLER----------------------------------------------------------------------------------- */
        //Vista de los productos
        public function vistaProductosController(){

            $respuesta = Datos::vistaProductosModel("productos");
    
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["talla"].'</td>
                    <td>'.$item["precio_unitario"].'</td>
                    <td><a href="index.php?action=productos&id='.$item["id"].'"><button>Editar</button></a></td>
                    <td><a href="index.php?action=productos&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
                </tr>';
    
            }
    
        }

        //Vista de formulario para registear producta
        public function registroProductoController(){
    
                echo ' 
                <input type="text" placeholder="Nombre de Producto" name="nombre" required>

                <input type="text" placeholder="Talla" name="talla" required>
    
                <input type="text" placeholder="Precio" name="precio" required>
    
                <input type="submit" value="Enviar">';
    
        }

        //Insertar de producto
        public function insertarProductoController(){

            if(isset($_POST["nombre"])){
    
                $datosController = array( "nombre"=>$_POST["nombre"], 
                                          "talla"=>$_POST["talla"],
                                          "precio"=>$_POST["precio"]);
    
                $respuesta = Datos::registroProductoModel($datosController, "productos");
    
                if($respuesta == "success"){
                    header("location:index.php?action=productos&crea=ok");
                }
                else{
                    header("location:index.php?action=productos&error=0k");
                }
    
            }
    
        }   
    
        //Eliminar Producto
        public function borrarProductoController(){

            if(isset($_GET["idBorrar"])){
    
                $datosController = $_GET["idBorrar"];
                
                $respuesta = Datos::borrarProductoModel($datosController, "productos");
    
                if($respuesta == "success"){
    
                    header("location:index.php?action=productos&borra=ok");
                
                }
    
            }
    
        }


        //Editar Producto
        public function editarProductoController(){

            $datosController = $_GET["id"];
            $respuesta = Datos::editarProductoModel($datosController, "productos");
    
                echo ' 
                <input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

                <input type="text" placeholder="Nombre de Producto" name="nombreEditar"  value="'.$respuesta["nombre"].'" required>

                <input type="text" placeholder="Talla" name="tallaEditar" value="'.$respuesta["talla"].'"  required>
    
                <input type="text" placeholder="Precio" name="precioEditar"  value="'.$respuesta["precio_unitario"].'" required>
    
                <input type="submit" value="Enviar">';
    
        }

        //Actualizar usuario
        public function actualizarProductoController(){

            if(isset($_POST["nombreEditar"])){
    
                $datosController = array( "id"=>$_POST["idEditar"],
                                          "nombre"=>$_POST["nombreEditar"],
                                          "talla"=>$_POST["tallaEditar"],
                                          "precio"=>$_POST["precioEditar"]);
                
                $respuesta = Datos::actualizarProductoModel($datosController, "productos");
    
                if($respuesta == "success"){
    
                    header("location:index.php?action=productos&cambio=ok");
    
                }
    
                else{
    
                    echo "error";
    
                }
    
            }
        
        }

        /**VENTAS CONTROLLER------------------------------------------------------------------------------------------------------------ */
        //Vista de los productos
        public function vistaProductoVEntaController(){
            if(!isset($_GET['idVenta'])){
                $datosController = "CURDATE()";
                $respuesta = Datos::registrarVentaModel($datosController, "ventas");
                if(respuesta != 'error'){
                    header('Location: index.php?action=ventas&registrar=0&idVenta='.$respuesta);
                }else{
                    header('Location: index.php?action=ventas&registrar=0');
                }
            }else{

            $respuesta = Datos::vistaProductoVentaModel("productos");
            echo '<select name="producto">'; 

            foreach($respuesta as $row => $item){
            echo'
                <option value='.$item["id"].'>'.$item["nombre"].' '.$item["talla"].'</option>
                ';
            }

            echo'
                </select>
                <input type="text" placeholder="Cantidad" name="cantidad" required>
                <input type="hidden" name="idVenta" value='.$_GET['idVenta'].'>
                <input type="submit" value="Enviar">
            ';
            }
        }

        //Insertar de producto
        public function insertoProductoVentaController(){

            if(isset($_POST["cantidad"])){
    
                $datosController = array( "idVenta"=>$_POST["idVenta"], 
                                          "idProducto"=>$_POST["producto"],
                                          "cantidad"=>$_POST["cantidad"]);
    
                $respuesta = Datos::registroProductoVentaModel($datosController, "productos_venta");
    
                if($respuesta == "success"){
                    header('location:index.php?action=ventas&registrar=0&idVenta='.$_GET['idVenta'].'&crea=ok');
                }
                else{
                    header('location:index.php?action=ventas&registrar=0&idVenta='.$_GET['idVenta'].'&error=ok');
                }
    
            }
    
        } 

        //Vista de los productos
        public function vistaProductosVentaController(){

            $respuesta = Datos::vistaProductosVentaModel($_GET['idVenta']);
    
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["cantidad_producto"].'</td>
                </tr>';
    
            }
        }  
    }
?>