<?php
    //Inluye archivo de conexion a la base de datos
    include "conexion.php";

    class Datos extends Conexion{
        //Inicio de sesion recibe datos de inicio de sesion (nombre de usuario y contraseña) en un array y el nombre de la tabla que tiene los registros de los usuarioss
        public function ingresoUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("SELECT usuario, contrasena FROM $tabla WHERE usuario = :usuario");	

            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);

            $stmt->execute();
    
            #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetch();
    
            $stmt->close();
        }

      /******************************************************************************************************************
      *ALUMNOS-----------------------------------------------------------------------------------------------------------
      ******************************************************************************************************************/
      

         //Vista de Alumnos - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaAlumnosModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT id, nombre, paterno, materno, correo, telefono FROM $tabla");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }
      
       //Registro de Alumno -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroAlumnoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id, nombre, paterno, materno, correo, telefono) VALUES (:id, :nombre, :paterno, :materno, :correo, :telefono)");	
    
            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":id", $datosModel["matricula"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":paterno", $datosModel["paterno"], PDO::PARAM_STR);
            $stmt->bindParam(":materno", $datosModel["materno"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
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
      
      //Editar Alumno - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
        public function editarAlumnoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de busquda
           $stmt = Conexion::conectar()->prepare("SELECT id, nombre, paterno, materno, correo, telefono FROM $tabla WHERE id = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }
      
      //Actualizar Alumno - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarAlumnoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, paterno = :paterno, materno = :materno, correo = :correo, telefono = :telefono  WHERE id = :id");

            //Parametros de la consulta
            $stmt->bindParam(":id", $datosModel["matricula"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":paterno", $datosModel["paterno"], PDO::PARAM_STR);
            $stmt->bindParam(":materno", $datosModel["materno"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);

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
        public function borrarAlumnoModel($datosModel, $tabla){

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
      
       
      /******************************************************************************************************************
      *MEASTROS-----------------------------------------------------------------------------------------------------------
      ******************************************************************************************************************/
      

         //Vista de Alumnos - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaMaestrosModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT id, nombre, paterno, materno, correo, telefono FROM $tabla");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }
      
      //Registro de Alumno -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroMaestroModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, paterno, materno, correo, telefono) VALUES (:id, :nombre, :paterno, :materno, :correo, :telefono)");	
    
            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":paterno", $datosModel["paterno"], PDO::PARAM_STR);
            $stmt->bindParam(":materno", $datosModel["materno"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
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
      
      
       //Editar Maestro - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
        public function editarMaestroModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de busquda
           $stmt = Conexion::conectar()->prepare("SELECT id, nombre, paterno, materno, correo, telefono FROM $tabla WHERE id = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }
      
      //Actualizar Maestro - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarMaestroModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, paterno = :paterno, materno = :materno, correo = :correo, telefono = :telefono  WHERE id = :id");

            //Parametros de la consulta
            $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":paterno", $datosModel["paterno"], PDO::PARAM_STR);
            $stmt->bindParam(":materno", $datosModel["materno"], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);

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
        public function borrarMaestroModel($datosModel, $tabla){

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