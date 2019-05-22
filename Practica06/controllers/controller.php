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
                    //Tipo de usuario correspondiente al usuario, sirve para determinar lo que se le muestra al usurio de acuerdo a su nivel de acceso en este caso Administrador y Recepcionistata (1 y 2) son los niveles de usuarios
                    $_SESSION["tipoUsuario"] = $respuesta["tipoUsuario"];
                    //Nombre de la persona a la que le pertenece el usuario
                    $_SESSION["nombre"] = $respuesta["nombre"];
                    //redireciona a la pagina de productos
                    header("location:index.php?action=habitaciones");
    
                }
                //en caso de datos incorrectos
                else{
                    //regresa al inicio
                    header("location:index.php?action=login&res=fallo");
    
                }
    
            }	
        }
    }
?>