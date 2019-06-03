<?php
    //Inluye archivo de conexion a la base de datos
    include "conexion.php";

    class Datos extends Conexion{
        //Inicio de sesion recibe datos de inicio de sesion (nombre de usuario y contraseña) en un array y el nombre de la tabla que tiene los registros de los usuarioss
        public function ingresoUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("SELECT email, password, num_empleado, nivel FROM $tabla WHERE email = :email");	
            $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch();
            $stmt->close();
        }



        /******************************************************************************************************************** 
        *CONSULTAR CARRERAS ----------------------------------------------------------------------------------------------
        ******************************************************************************************************************/
        public function obtenerCarrerasModel($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla");
            $stmt->execute();

            return $stmt->fetchAll();
        }
        
        /******************************************************************************************************************
        *CONSULTAR TUTORES ----------------------------------------------------------------------------------------------
        ******************************************************************************************************************/
        public function obtenerTutoresModel($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT num_empleado, nombre FROM $tabla");
            $stmt->execute();

            return $stmt->fetchAll();
        }


         /******************************************************************************************************************
        *OBTENER ALUMNOS POR CARRERA -------------------------------------------------------------------------------------------
        ******************************************************************************************************************/
        public function obtenerAlumnosCarreraModel($tabla, $id){
            $stmt = Conexion::conectar()->prepare("SELECT matricula, nombre FROM $tabla WHERE id_carrera = :id_carrera");
            $stmt->bindParam(":id_carrera", $id, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll();
        }

        /******************************************************************************************************************
        *OBTENER MATERIAS POR CARRERA -------------------------------------------------------------------------------------
        ******************************************************************************************************************/
        public function obtenerMateriasCarreraModel($tabla, $id){
            $stmt = Conexion::conectar()->prepare("SELECT m.id_materia, m.nombre, p.nombre as 'maestro' FROM $tabla m INNER JOIN maestros p ON m.num_empleado = p.num_empleado WHERE m.id_carrera = :id_carrera");
            $stmt->bindParam(":id_carrera", $id, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll();
        }

        /******************************************************************************************************************
         *ALUMNOS-----------------------------------------------------------------------------------------------------------
        ******************************************************************************************************************/
      

         //Vista de Alumnos - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaAlumnosModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("SELECT a.matricula as matricula, a.nombre as nombre, c.nombre as carrera, m.nombre as tutor from $tabla as a inner join carrera as c on c.id=a.id_carrera INNER JOIN maestros as m on m.num_empleado=a.id_tutor");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }
      
       //Registro de Alumno -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroAlumnoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula, nombre, id_carrera, id_tutor) VALUES (:id, :nombre, :carrera, :tutor)");	
    
            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":id", $datosModel["matricula"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);
            $stmt->bindParam(":tutor", $datosModel["tutor"], PDO::PARAM_STR);
    
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
           $stmt = Conexion::conectar()->prepare("SELECT matricula, nombre, id_carrera, id_tutor  FROM $tabla WHERE matricula = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }
      
      //Actualizar Alumno - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarAlumnoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                    nombre = :nombre, 
                                                    id_carrera = :carrera,
                                                    id_tutor = :tutor  
                                                    WHERE matricula = :id");

            //Parametros de la consulta
            $stmt->bindParam(":id", $datosModel["matricula"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);
            $stmt->bindParam(":tutor", $datosModel["tutor"], PDO::PARAM_STR);

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

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE matricula = :id");
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
      

         //Vista de Maestros - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaMaestrosModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT m.num_empleado, m.nombre, m.email, m.nivel, c.nombre as 'carrera' FROM $tabla m INNER JOIN carrera c ON m.id_carrera = c.id");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }
      
      //Registro de Maestro -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroMaestroModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (num_empleado, nombre, email, password, id_carrera, nivel) VALUES (:numero, :nombre, :email, :password, :carrera, :nivel)");	
    
            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":numero", $datosModel["numero"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);
            $stmt->bindParam(":nivel", $datosModel["nivel"], PDO::PARAM_INT);
    
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
           $stmt = Conexion::conectar()->prepare("SELECT num_empleado, nombre, email, nivel, id_carrera as carrera, password FROM $tabla WHERE num_empleado = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }
      
      //Actualizar Maestro - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarMaestroModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre,
                                                                    email = :email,
                                                                    password = :password,
                                                                    id_carrera = :carrera,
                                                                    nivel = :nivel
                                                                    WHERE num_empleado = :numero");

            //Parametros de la consulta
            $stmt->bindParam(":numero", $datosModel["numero"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);
            $stmt->bindParam(":nivel", $datosModel["nivel"], PDO::PARAM_INT);

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


      
      //Eliminar Maestro
        public function borrarMaestroModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE num_empleado = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);
    
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
         *MATERIAS -------------------------------------------------------------------------------------------------------
        ******************************************************************************************************************/
        
        //Vista de Materias - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaMateriasModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT m.id_materia, m.nombre, c.nombre as 'carrera', p.nombre as 'maestro' FROM $tabla m INNER JOIN carrera c ON m.id_carrera = c.id INNER JOIN maestros p ON m.num_empleado = p.num_empleado");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }

        //Csonulta de Materia - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe  como parametro el nombre de la tabla de la cual traera los registros
        public function consultarMateriaModel($datosModel, $tabla){
        //Se realiza la conexion y se prepara la consulta 
            $stmt = Conexion::conectar()->prepare("SELECT m.id_materia, m.nombre, m.id_carrera, c.nombre as 'carrera', p.nombre as 'maestro' FROM $tabla m INNER JOIN carrera c ON m.id_carrera = c.id INNER JOIN maestros p ON m.num_empleado = p.num_empleado WHERE id_materia = :id");	

            //Parametros de la consulta
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	

            //Ejecuta la consulta
            $stmt->execute();

            #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetch();

            $stmt->close();

        }

        //Vista de los alumnos inscritos a una materia en especifico - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function consultarMateriaInscritosModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT ma.id_materia, ma.matricula_alumno, a.nombre FROM $tabla m INNER JOIN materia_alumno ma ON m.id_materia = ma.id_materia INNER JOIN alumnos a ON ma.matricula_alumno = a.matricula WHERE m.id_materia = :id;");
           
            //Parametros de la consulta
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	
           
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }

        //DAR DE ALTA A UN ALUMNO EN UNA MATERIA -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function altaMateriaAlumnoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (matricula_alumno, id_materia) VALUES (:matricula, :id_materia)");	
    
            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":matricula", $datosModel["matricula"], PDO::PARAM_STR);
            $stmt->bindParam(":id_materia", $datosModel["id_materia"], PDO::PARAM_INT);
    
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

        //DAR DE BAJA ALUMNO DE UNA MATERIA
        public function bajaMateriaAlumnoModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_materia = :id_materia AND matricula_alumno = :matricula");
            $stmt->bindParam(":id_materia",$datosModel['materia'], PDO::PARAM_INT);
            $stmt->bindParam(":matricula", $datosModel['matricula'], PDO::PARAM_STR);
    
            if($stmt->execute()){
                return "success";
            }
            else{
                return "error";
            }
            //En caso de fallar regresa el mensaje de error
            $stmt->close();
    
        }

       //Registro de Maetria -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el nombre de la tabla
        public function registroMateriaModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, id_carrera, num_empleado) VALUES (:nombre, :carrera, :numero)");	

            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":numero", $datosModel["maestro"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);

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

        //Editar Materia - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
        public function editarMateriaModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de busquda
           $stmt = Conexion::conectar()->prepare("SELECT id_materia, nombre, id_carrera, num_empleado FROM $tabla WHERE id_materia = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }

        //Actualizar Materia - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarMateriaModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre,
                                                                    id_carrera = :carrera,
                                                                    num_empleado = :numero
                                                                    WHERE id_materia = :id");

            //Parametros de la consulta
            $stmt->bindParam(":numero", $datosModel["maestro"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);
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

         //Eliminar Materia
         public function borrarMateriaModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_materia = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);
    
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
         *GRUPOS -------------------------------------------------------------------------------------------------------
        ******************************************************************************************************************/
       
        //Vista de GRUPOS - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
        public function vistaGruposModel($tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT g.id_grupo, g.nombre, c.nombre as 'carrera' FROM grupos g INNER JOIN carrera c ON g.id_carrera = c.id");	
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }


       //Csonulta de Grupo - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe  como parametro el nombre de la tabla de la cual traera los registros
       public function consultarGrupoModel($datosModel, $tabla){
        //Se realiza la conexion y se prepara la consulta 
            $stmt = Conexion::conectar()->prepare("SELECT g.id_grupo, g.nombre, c.nombre as 'carrera', g.id_carrera FROM grupos g INNER JOIN carrera c ON g.id_carrera = c.id");	

            //Parametros de la consulta
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);	

            //Ejecuta la consulta
            $stmt->execute();

            #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetch();

            $stmt->close();

        }

         //Vista de los materias pertenecientes a un grupo en especifico - Metodo que realiza la consulta para recuperar los datos almacenados en la base de datos, recibe como parametro el nombre de la tabla de la cual traera los registros
         public function consultarGrupoMateriaModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
           $stmt = Conexion::conectar()->prepare("SELECT m.id_materia, m.nombre FROM $tabla m INNER JOIN grupo_materia mg ON m.id_materia = mg.id_materia INNER JOIN grupos g ON g.id_grupo = :id");
           
            //Parametros de la consulta
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
           
           //Ejecuta la consulta
           $stmt->execute();
   
           #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
           return $stmt->fetchAll();
   
           $stmt->close();
   
       }

        //DAR DE ALTA UNA MATERIA EN UN GRUPO- 
        public function altaMateriaGrupoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_materia, id_grupo) VALUES (:id_materia, :id_grupo)");	

            //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
            $stmt->bindParam(":id_materia", $datosModel["id_materia"], PDO::PARAM_INT);
            $stmt->bindParam(":id_grupo", $datosModel["id_grupo"], PDO::PARAM_INT);

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

        //DAR DE BAJA MATERIA DE UNA GRUPO
        public function bajaGrupoMateriaModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_materia = :id_materia AND id_grupo = :id_grupo");
            $stmt->bindParam(":id_materia",$datosModel['materia'], PDO::PARAM_INT);
            $stmt->bindParam(":id_grupo", $datosModel['grupo'], PDO::PARAM_INT);
    
            if($stmt->execute()){
                return "success";
            }
            else{
                return "error";
            }
            //En caso de fallar regresa el mensaje de error
            $stmt->close();
    
        }

    //Registro de Grupo -  Metodo para la creacion de un usario del sistema, recibe como parametros un array de datos y el  nombre de la tabla
    public function registroGrupoModel($datosModel, $tabla){
        //Se realiza la conexion y se prepara la consulta de insercion
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, id_carrera) VALUES (:nombre, :carrera)");	

        //Se definen los valores de los parametros indicados en la sentencia y que indican los datos que se insertaran
        $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);

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

    //Editar Grupo - Metodo para realizar una consulta a partir de un id ($datosModel), y regresar los datos de ese registro en especifico, y el nombre de la tabla, en si lo que hace es una busqueda
        public function editarGrupoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de busquda
           $stmt = Conexion::conectar()->prepare("SELECT id_grupo, nombre, id_carrera FROM $tabla WHERE id_grupo = :id");
           
           //Parametros de la consulta
           $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	

           //Se ejecuta la consulta
           $stmt->execute();
   
           // se regresa el resultado de la consulta
           return $stmt->fetch();
   
           $stmt->close();
   
       }

        //Actualizar Grupo - Metodo para cambiar los datos de un registro existente, recibe como parametros un array con los datos que se almacenaran y el nombre de la tabla
        public function actualizarGrupoModel($datosModel, $tabla){
            //Se realiza la conexion y se prepara la consulta de insercion
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre,
                                                                    id_carrera = :carrera
                                                                    WHERE id_grupo = :id");

            //Parametros de la consulta
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":carrera", $datosModel["carrera"], PDO::PARAM_INT);
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

        //Eliminar Grupo
        public function borrarGrupoModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_grupo = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_STR);
    
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