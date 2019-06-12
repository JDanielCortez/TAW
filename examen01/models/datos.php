<?php
    require_once "conexion.php";

    class Datos extends Conexion{
       
        /**
         * CRUD PROVEEDORES
         */

        //listado de proveedores
        public function listaProveedoresModel(){

            $bd = Conexion::conectar()->prepare("SELECT * FROM proveedores");	
            $bd->execute();

            return $bd->fetchAll();

            $bd->close();

        }


        //Borrar proveedor
        public function borrarProveedorModel($datosModel){

            $bd = Conexion::conectar()->prepare("DELETE FROM proveedores WHERE clave = :clave");
            $bd->bindParam("clave", $datosModel, PDO::PARAM_INT);
    
            if($bd->execute()){
                return "success";
            }else{
                return "error";
            }
            $bd->close();
        }

        //Insertar Proveedor
        public function registroProveedorModel($datosModel){
            $bd = Conexion::conectar()->prepare("INSERT INTO proveedores (nombre, rfc, direccion, email) VALUES (:nombre,:rfc,:direccion,:email)");	
    
            $bd->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $bd->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
            $bd->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
            $bd->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
    
            if($bd->execute()){
                return "success";
            }else{
                return "error";
            }
            $bd->close();
    
        }

       
        //Editar Proveedor

        public function editarProveedorModel($datosModel){

            $bd = Conexion::conectar()->prepare("SELECT * FROM proveedores WHERE clave = :clave");
            
            $bd->bindParam(":clave", $datosModel, PDO::PARAM_INT);	
            $bd->execute();

            return $bd->fetch();

            $bd->close();

        }

        //Actualizar proveedor

        public function actualizarProveedorModel($datosModel){

            $bd = Conexion::conectar()->prepare("UPDATE proveedores SET nombre = :nombre, rfc = :rfc, direccion = :direccion, email= :email WHERE clave = :clave");

            $bd->bindParam(":clave", $datosModel["clave"], PDO::PARAM_INT);            
            $bd->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $bd->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
            $bd->bindParam(":direccion", $datosModel["direccion"], PDO::PARAM_STR);
            $bd->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

            if($bd->execute()){
                return "success";
            }else{
                return "error";
            }
            $bd->close();

        }

        /**
         * CRUD CONTACTOS
         */

        //listado de contactos
        public function listaContactosModel(){

            $bd = Conexion::conectar()->prepare("SELECT * FROM contacto");	
            $bd->execute();

            return $bd->fetchAll();

            $bd->close();

        }

        //Borrar contacto
        public function borrarContactoModel($datosModel){

            $bd = Conexion::conectar()->prepare("DELETE FROM contacto WHERE clave = :clave");
            $bd->bindParam("clave", $datosModel, PDO::PARAM_INT);
    
            if($bd->execute()){
                return "success";
            }else{
                return "error";
            }
            $bd->close();
        }

        //Insertar Contacto
        public function registroContactoModel($datosModel){
            $bd = Conexion::conectar()->prepare("INSERT INTO contacto (nombre, apellidos, email, tel) VALUES (:nombre,:apellidos,:email,:tel)");	
    
            $bd->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $bd->bindParam(":apellidos", $datosModel["apellidos"], PDO::PARAM_STR);
            $bd->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $bd->bindParam(":tel", $datosModel["telefono"], PDO::PARAM_STR);
    
            if($bd->execute()){
                return "success";
            }else{
                return "error";
            }
            $bd->close();
    
        }

       
        //Editar Contacto

        public function editarContactoModel($datosModel){

            $bd = Conexion::conectar()->prepare("SELECT * FROM contacto WHERE clave = :clave");
            
            $bd->bindParam(":clave", $datosModel, PDO::PARAM_INT);	
            $bd->execute();

            return $bd->fetch();

            $bd->close();

        }



        public function actualizarContactoModel($datosModel){

            $bd = Conexion::conectar()->prepare("UPDATE contacto SET nombre = :nombre, apellidos = :apellidos, email = :email, tel= :tel WHERE clave = :clave");

            $bd->bindParam(":clave", $datosModel["clave"], PDO::PARAM_INT);            
            $bd->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $bd->bindParam(":apellidos", $datosModel["apellidos"], PDO::PARAM_STR);
            $bd->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $bd->bindParam(":tel", $datosModel["telefono"], PDO::PARAM_STR);

            if($bd->execute()){
                return "success";
            }else{
                return "error";
            }
            $bd->close();

        }
        
    
    }
?>