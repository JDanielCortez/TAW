<?php
    class MvcController{
        //Llamar a la plantilla

        public function plantilla(){
            include "views/template.php";
        }

        public function enlacesPaginasController(){
            
            if(isset($_GET['action'])){
                $enlacesController = $_GET['action'];
            }else{
                $enlacesController = "index";
            }

            $respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);

            include $respuesta;
        } 

        /**
         * CRUD PROVEEDORES
         */
            
        public function listaProveedoresController(){
            $respuesta = Datos::listaProveedoresModel();
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["clave"].'</td>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["rfc"].'</td>
                    <td>'.$item["direccion"].'</td>
                    <td>'.$item["email"].'</td>
                    <td><a href="index.php?action=proveedores&id='.$item["clave"].'"><button>Editar</button></a></td>
                    <td><a href="index.php?action=proveedores&Borrar='.$item["clave"].'"> <button> Borrar </button></a></td>
                </tr>';

            }
        }

        public function borrarProveedorController(){
            //recupera 
            if(isset($_GET["Borrar"])){
    
                $datosController = $_GET["Borrar"];
                
                $respuesta = Datos::borrarProveedorModel($datosController);
    
                if($respuesta == "success"){
                    header("location:index.php?action=proveedores&exito");
                }else{
                    header("location:index.php?action=proveedores&fallo");
                }
    
            }
    
        }

        public function registroProveedorController(){
    
            echo ' 
            <input type="text" placeholder="Nombre de proveedor" name="nombre" required>
            <br>
            <input type="text" placeholder="RFC" name="rfc" required>
            <br>
            <input type="text" placeholder="Direccion" name="direccion" required>
            <br>
            <input type="email" placeholder="E-mail" name="email" required>
            <br>
            <input type="submit" value="Enviar">';

        }

        public function insertarProveedorController(){

            if(isset($_POST["nombre"])){
    
                $datosController = array( "nombre"=>$_POST["nombre"], 
                                          "rfc"=>$_POST["rfc"],
                                          "direccion"=>$_POST["direccion"],
                                          "email"=>$_POST['email']);
    
                $respuesta = Datos::registroProveedorModel($datosController);
    
                if($respuesta == "success"){
                    header("location:index.php?action=proveedores&exito");
                }else{
                    header("location:index.php?action=proveedores&fallo");
                }
    
            }
    
        }   


         //Editar Proveedor
         public function editarProveedorController(){

            $datosController = $_GET["id"];
            $respuesta = Datos::editarProveedorModel($datosController);
    
            echo ' 
            <input type="hidden" name="clave" value='.$respuesta['clave'].' required>
            <br>
            <input type="text" placeholder="Nombre de proveedor" name="nombreE" value="'.$respuesta['nombre'].'" required>
            <br>
            <input type="text" placeholder="RFC" name="rfcE" value="'.$respuesta['rfc'].'" required>
            <br>
            <input type="text" placeholder="Direccion" name="direccionE" value=" '.$respuesta['direccion'].'" required>
            <br>
            <input type="email" placeholder="E-mail" name="emailE" value="'.$respuesta['email'].'"  required>
            <br>
            <input type="submit" value="Enviar">';
    
        }

        //Actualizar proveedor
        public function actualizarProveedorController(){

            if(isset($_POST["clave"])){
    
                $datosController = array( "clave"=>$_POST['clave'],
                                          "nombre"=>$_POST["nombreE"], 
                                          "rfc"=>$_POST["rfcE"],
                                          "direccion"=>$_POST["direccionE"],
                                          "email"=>$_POST['emailE']);
                
                $respuesta = Datos::actualizarProveedorModel($datosController);
    
                if($respuesta == "success"){
                    header("location:index.php?action=proveedores&exito");
                }else{
                    header("location:index.php?action=proveedores&fallo");
                }
    
            }
        
        }

        /**
         * CRUD CONTACTOS
         */
            
        public function listaContactosController(){
            $respuesta = Datos::listaContactosModel();
            foreach($respuesta as $row => $item){
            echo'<tr>
                    <td>'.$item["clave"].'</td>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["apellidos"].'</td>
                    <td>'.$item["email"].'</td>
                    <td>'.$item["tel"].'</td>
                    <td><a href="index.php?action=contacto&id='.$item["clave"].'"><button>Editar</button></a></td>
                    <td><a href="index.php?action=contacto&Borrar='.$item["clave"].'"> <button> Borrar </button></a></td>
                </tr>';

            }
        }

        public function borrarContactoController(){
            //recupera 
            if(isset($_GET["Borrar"])){
    
                $datosController = $_GET["Borrar"];
                
                $respuesta = Datos::borrarContactoModel($datosController);
    
                if($respuesta == "success"){
    
                    header("location:index.php?action=contacto&exito");
                
                }
    
            }
    
        }

        public function registroContactoController(){
    
            echo ' 
            <input type="text" placeholder="Nombre de contacto" name="nombre" required>
            <br>
            <input type="text" placeholder="Apellidos" name="apellidos" required>
            <br>
            <input type="email" placeholder="E-mail" name="email" required>
            <br>
            <input type="text" placeholder="Telefono" name="telefono" required>
            <br>
            <input type="submit" value="Enviar">';

        }

        public function insertarContactoController(){

            if(isset($_POST["nombre"])){
    
                $datosController = array( "nombre"=>$_POST["nombre"], 
                                          "apellidos"=>$_POST["apellidos"],
                                          "email"=>$_POST["email"],
                                          "telefono"=>$_POST['telefono']);
    
                $respuesta = Datos::registroContactoModel($datosController);
    
                if($respuesta == "success"){
                    header("location:index.php?action=contacto&exito");
                }else{
                    header("location:index.php?action=contacto&fallo");
                }
    
            }
    
        }   


         //Editar contacto
         public function editarContactoController(){

            $datosController = $_GET["id"];
            $respuesta = Datos::editarContactoModel($datosController);
    
            echo ' 
            <input type="hidden" name="clave" value='.$respuesta['clave'].' required>
            <br>
            <input type="text" placeholder="Nombre de contacto" name="nombreE" value="'.$respuesta['nombre'].'" required>
            <br>
            <input type="text" placeholder="Apellidos" name="apellidosE" value="'.$respuesta['apellidos'].'" required>
            <br>
            <input type="email" placeholder="E-mail" name="emailE" value="'.$respuesta['email'].'"  required>
            <br>
            <input type="text" placeholder="Telefono" name="telefonoE" value="'.$respuesta['tel'].'" required>
            <br>
            <input type="submit" value="Enviar">';
    
        }

        //Actualizar proveedor
        public function actualizarContactoController(){

            if(isset($_POST["clave"])){
    
                $datosController = array("clave"=>$_POST['clave'],
                                          "nombre"=>$_POST["nombreE"], 
                                          "apellidos"=>$_POST["apellidosE"],
                                          "email"=>$_POST["emailE"],
                                          "telefono"=>$_POST['telefonoE']);
                
                $respuesta = Datos::actualizarContactoModel($datosController);
    
                if($respuesta == "success"){
                    header("location:index.php?action=contacto&exito");
                }else{
                    header("location:index.php?action=contacto&fallo");
                }
    
            }
        
        }

    }
?>