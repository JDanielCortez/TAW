<?php
    //Inluye archivo de conexion a la base de datos
    include "conexion.php";

    class Datos extends Conexion{
        //Inicio de sesion recibe datos de inicio de sesion (nombre de usuario y contraseña) en un array y el nombre de la tabla que tiene los registros de los usuarioss
        public function ingresoUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("SELECT usuario, contrasena, nombre, t.tipo as 'tipoUsuario' FROM $tabla INNER JOIN tipos_usuarios t ON id_tipo_usuario = t.id WHERE usuario = :usuario");	

            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);

            $stmt->execute();
    
            #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetch();
    
            $stmt->close();
        }

        /**USUARIOS---------------------------------------USUARIOS------------------------------USUARIOS------------------USUARIOS---------------------------------------USUARIOS------------------------------USUARIOS----------------
         * 
         * 
         */

         //Vista de Usuarios - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaUsuariosModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT u.id, t.tipo, u.usuario, u.nombre, u.correo, u.contrasena FROM $tabla u INNER JOIN tipos_usuarios t on u.id_tipo_usuario = t.id");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }

        //Registro de Usuario -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroUsuarioModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_tipo_usuario, usuario, nombre, correo, contrasena) VALUES (:id, :usuario, :nombre, :correo, :contrasena)");	
    
            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":id", $datosModel["tipo"], PDO::PARAM_INT);
            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $datosModel["contrasena"], PDO::PARAM_STR);
    
            //Ejecuta la sentencia y verifica su estado tras ser ejecutada
            //En caso de ser exitosa regresa el mensaje success
            if($stmt->execute()){
                return "success";
            }
            //En caso de fallar regresa el mensaje de error
            else{
                return "error";
            }

            $stmt->close();
    
        }

        //Editar Usuario - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
        public function editarUsuarioModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de busquda
           $stmt = Conexion::conectar()->prepare("SELECT id, id_tipo_usuario, usuario, nombre, correo, contrasena FROM $tabla WHERE id = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }

        #ACTUALIZAR Usuario - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarUsuarioModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_tipo_usuario = :tipo, usuario = :usuario, correo = :correo, nombre = :nombre, contrasena = :contrasena  WHERE id = :id");

            //Parametros de la consulta
            $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_INT);
            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", $datosModel["contrasena"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

             //Ejecuta la sentencia y verifica su estado tras ser ejecutada
            //En caso de ser exitosa regresa el mensaje success
            if($stmt->execute()){
                return "success";
            }

            else{
                return "error";
            }
            $stmt->close();
        }

        //Eliminar Usuario
        public function borrarUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
    
            if($stmt->execute()){
                return "success";
            }
            else{
                return "error";
            }
            //En caso de fallar regresa el mensaje de error
            $stmt->close();
    
        }

        /**CLIENTES----------------------------------------------CLIENTES----------------------------CLIENTES------------CLIENTES----------------------------------------------CLIENTES---------------------------------CLIENTES----------CLIENTES--------------------------------------------CLIENTES---------------------------------CLIENTES
         * 
         * 
         */
        //Vista de clientes - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaClientesModel($tabla){
             //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("SELECT c.id, c.nombre, t.tipo as tipo, c.email, c.telefono FROM $tabla c INNER JOIN tipos_cliente t on c.id_tipo_cliente = t.id");	
            //Ejecuta la consulta
            $stmt->execute();
    
            #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetchAll();
    
            $stmt->close();
    
        }

        //Registro de Cliente -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroClienteModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_tipo_cliente, nombre, email, telefono) VALUES (:id,:nombre,:email,:telefono)");	
    
            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":id", $datosModel["tipo"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datosModel["correo"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
    
            //Ejecuta la sentencia y verifica su estado tras ser ejecutada
            //En caso de ser exitosa regresa el mensaje success
            if($stmt->execute()){
                return "success";
            }
            //En caso de fallar regresa el mensaje de error
            else{
                return "error";
            }

            $stmt->close();
    
        }

        //Editar cliente - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
        public function editarClienteModel($datosModel, $tabla){
             //Se realiza la conexion y se prepara la consulta de busquda
            $stmt = Conexion::conectar()->prepare("SELECT id, nombre, telefono, id_tipo_cliente, email FROM $tabla WHERE id = :id");
            
            //Parametros de la consulta
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	

            //Se ejecuta la consulta
            $stmt->execute();
    
            // se regresa el resultado de la consulta
            return $stmt->fetch();
    
            $stmt->close();
    
        }

        #ACTUALIZAR Cliente - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarClienteModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, id_tipo_cliente = :tipo, email = :email, telefono = :telefono  WHERE id = :id");

            //Parametros de la consulta
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_INT);
            $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

             //Ejecuta la sentencia y verifica su estado tras ser ejecutada
            //En caso de ser exitosa regresa el mensaje success
            if($stmt->execute()){
                return "success";
            }

            else{
                return "error";
            }
            $stmt->close();
        }

        //Eliminar cliente
        public function borrarClienteModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
    
            if($stmt->execute()){
                return "success";
            }
            else{
                return "error";
            }
            //En caso de fallar regresa el mensaje de error
            $stmt->close();
    
        }


        /**HABITACIONES-----------------------------HABITACIONES--------------------------------HABITACIONES-----------------------HABITACIONES--------------------------------HABITACIONES----------------------------------HABITACIONES------------------------------------HABITACIONES-----------------------------------HABITACIONES-----------
         * 
         * 
         */
        //Vista de Habitaciones - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaHabitacionesModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT h.id, t.tipo, t.costo FROM $tabla h INNER JOIN tipos_habitacion t on h.id_tipo_habitacion = t.id");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }


       //Ver Habitacion - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
       public function verHabitacionModel($datosModel, $tabla){
        //Se realiza la conexion y se prepara la consulta de busquda
       $stmt = Conexion::conectar()->prepare("SELECT h.id, t.tipo, t.costo, h.imagen FROM $tabla h INNER JOIN tipos_habitacion t on h.id_tipo_habitacion = t.id WHERE h.id = :id");
       
       //Parametros de la consulta
       $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	

       //Se ejecuta la consulta
       $stmt->execute();

       // se regresa el resultado de la consulta
       return $stmt->fetch();

       $stmt->close();

   }

       //Registro de Habitacion -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroHabitacionModel($datosModel, $tabla){
            //nombre de la imagen
            $imgFile = $_FILES['archivo']['name'];
            //ubicacion temporal
            $tmp_dir = $_FILES['archivo']['tmp_name'];
            //tamaño de la imagen
            $imgSize = $_FILES['archivo']['size'];
            $err = "";
            if(empty($imgFile)){
                $err = "No se ha seleccionado una imagen.";
            }else{
                //Carpeta donde se guardara la imagen
                $directorio = "img/";
                //Obtiene la extencion de la imagen
                $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
                //array en el cual se almacenan las extensiones de imagenes permitidas
                $ext = array('jpeg', 'jpg', 'png', 'gif');
                //Verfica que el tipo de imagen sea permitido y que la imagen pese menos a 5MB
                if(in_array($imgExt, $ext) && $imgSize < 5000000){
                    move_uploaded_file($tmp_dir,$directorio.$imgFile);
                }else{
                    $err = "Imagen no permitida o demasiado grande";
                }
            }

            if(empty($err)){
                //Se realiza la conexion y se prepara la consulta de insercion
                $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_tipo_habitacion, imagen) VALUES (:id, :imagen)");	

                //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
                $stmt->bindParam(":id", $datosModel["tipo"], PDO::PARAM_INT);
                $stmt->bindParam(":imagen", $imgFile, PDO::PARAM_STR);
                $mensaje = "";
                //Ejecuta la sentencia y verifica su estado tras ser ejecutada
                //En caso de ser exitosa procede a guardar la imagen en el servidor
                if($stmt->execute()){
                    return "success";
                }
                //En caso de fallar regresa el mensaje de error
                else{
                    return "error";
                }
                $stmt->close();
            }else{
                return $err;
            }

        }

        //Editar Habitacion - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
        public function editarHabitacionModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de busquda
           $stmt = Conexion::conectar()->prepare("SELECT id, id_tipo_habitacion, imagen FROM $tabla WHERE id = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }

       #ACTUALIZAR Cliente - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
       public function actualizarHabitacionModel($datosModel, $tabla){

            //nombre de la imagen
            $imgFile = $_FILES['archivo']['name'];
            //ubicacion temporal
            $tmp_dir = $_FILES['archivo']['tmp_name'];
            //tamaño de la imagen
            $imgSize = $_FILES['archivo']['size'];
            $err = "";

            //Si no se ha ingresado una imagen, se actualiza solamente el tipo de habitacion
            if(empty($imgFile)){
                    //Se realiza la conexion y se prepara la consulta de insercion
                    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_tipo_habitacion = :tipo WHERE id = :id");

                    //Parametros de la consulta
                    $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_INT);
                    $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

                    //Ejecuta la sentencia y verifica su estado tras ser ejecutada
                    //En caso de ser exitosa regresa el mensaje success
                    if($stmt->execute()){
                        return "success";
                    }
                    else{
                        return "error";
                    }
                    $stmt->close();
            }
            //En caso de que se seleccione una imagen, se actualiza tanto el tipo de habitacion y la imagen con la nueva direccion de la imagen
            else{
            //Carpeta donde se guardara la imagen
            $directorio = "img/";
            //Obtiene la extencion de la imagen
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
            //array en el cual se almacenan las extensiones de imagenes permitidas
            $ext = array('jpeg', 'jpg', 'png', 'gif');
            //Verfica que el tipo de imagen sea permitido y que la imagen pese menos a 5MB
            if(in_array($imgExt, $ext) && $imgSize < 5000000){
                move_uploaded_file($tmp_dir,$directorio.$imgFile);
            }else{
                $err = "Imagen no permitida o demasiado grande";
            }
            if(empty($err))
                //Se realiza la conexion y se prepara la consulta de insercion
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_tipo_habitacion = :tipo, imagen = :imagen WHERE id = :id");

                //Parametros de la consulta
                $stmt->bindParam(":tipo", $datosModel["tipo"], PDO::PARAM_INT);
                $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
                $stmt->bindParam(":imagen", $imgFile, PDO::PARAM_STR);

                //Ejecuta la sentencia y verifica su estado tras ser ejecutada
                //En caso de ser exitosa regresa el mensaje success
                if($stmt->execute()){
                    return "success";
                }
                else{
                    return "error";
                }
                $stmt->close();
            }
        }

        //Eliminar Habitacion
        public function borrarHabitacionModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
    
            if($stmt->execute()){
                return "success";
            }
            else{
                return "error";
            }
            //En caso de fallar regresa el mensaje de error
            $stmt->close();
    
        }

         /**RESERVACIONES----------------------------------------------RESERVACIONES----------------------------RESERVACIONES------------RESERVACIONES----------------------------------------------RESERVACIONES---------------------------------RESERVACIONES----------RESERVACIONES--------------------------------------------RESERVACIONES---------------------------------RESERVACIONES
         *RESERVACIONES
         * 
         */
        //Vista de clientes - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaReservacionesModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT r.id as numero, r.id_habitacion as habitacion, c.nombre as cliente, r.fecha_entrada as fecha, r.numero_noches as noches FROM $tabla r INNER JOIN clientes c on r.id_cliente = c.id");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }
      
      //Registro de Usuario -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroreservacionModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_habitacion, id_cliente, fecha_entrada, numero_noches) VALUES (:id_habitacion, :id_cliente, :fecha, :numero)");	
    
            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":id_habitacion", $datosModel["habitacion"], PDO::PARAM_INT);
            $stmt->bindParam(":id_cliente", $datosModel["cliente"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
            $stmt->bindParam(":numero", $datosModel["numero"], PDO::PARAM_STR);
    
            //Ejecuta la sentencia y verifica su estado tras ser ejecutada
            //En caso de ser exitosa regresa el mensaje success
            if($stmt->execute()){
                return "success";
            }
            //En caso de fallar regresa el mensaje de error
            else{
                return "error";
            }

            $stmt->close();
    
        }

      //Editar Reservacion - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
        public function editarReservacionModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de busquda
           $stmt = Conexion::conectar()->prepare("SELECT id, id_habitacion, id_cliente, fecha_entrada, numero_noches FROM $tabla WHERE id = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }
      
      #ACTUALIZAR Cliente - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarReservacionModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_habitacion = :habitacion, id_cliente = :cliente, numero_noches = :noches, fecha_entrada = :fecha  WHERE id = :id");

            //Parametros de la consulta
            $stmt->bindParam(":habitacion", $datosModel["habitacion"], PDO::PARAM_STR);
            $stmt->bindParam(":cliente", $datosModel["cliente"], PDO::PARAM_INT);
            $stmt->bindParam(":noches", $datosModel["noches"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

             //Ejecuta la sentencia y verifica su estado tras ser ejecutada
            //En caso de ser exitosa regresa el mensaje success
            if($stmt->execute()){
                return "success";
            }

            else{
                return "error";
            }
            $stmt->close();
        }

        //Eliminar Reservacion
        public function borrarReservacionModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
    
            if($stmt->execute()){
                return "success";
            }
            else{
                return "error";
            }
            //En caso de fallar regresa el mensaje de error
            $stmt->close();
    
        }
    }
?>