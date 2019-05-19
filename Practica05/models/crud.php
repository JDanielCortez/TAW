<?php
    require_once "conexion.php";

    class Datos extends Conexion{
       
        //Inicio de Sesion
        public function ingresoUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("SELECT usuario, contrasena FROM $tabla WHERE usuario = :usuario");	

            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);

            $stmt->execute();
    
            #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetch();
    
            $stmt->close();
        }

        /**CRUD Usuarios---------------------------------------------------------------------- */
        //Vista de Usuario
        public function vistaUsuariosModel($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT id, usuario, contrasena, correo FROM $tabla");	
            $stmt->execute();
    
            #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetchAll();
    
            $stmt->close();
    
        }
    
    

        //Registro de Usuario
        public function registroUsuarioModel($datosModel, $tabla){
    
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, contrasena, correo) VALUES (:usuario,:contrasena,:correo)");	
    
        
    
            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":contrasena", md5($datosModel["password"]), PDO::PARAM_STR);
            $stmt->bindParam(":correo", $datosModel["email"], PDO::PARAM_STR);
    
            if($stmt->execute()){
    
                return "success";
    
            }
    
            else{
    
                return "error";
    
            }
    
            $stmt->close();
    
        }

        #EDITAR USUARIO
	#-------------------------------------

	public function editarUsuarioModel($datosModel, $tabla){

        $stmt = Conexion::conectar()->prepare("SELECT id, usuario, contrasena, correo FROM $tabla WHERE id = :id");
        
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#ACTUALIZAR USUARIO
	#-------------------------------------

	public function actualizarUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, contrasena = :contrasena, correo = :correo WHERE id = :id");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":contrasena", md5($datosModel["password"]), PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}


        //Eliminar usuario
        public function borrarUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
    
            if($stmt->execute()){
    
                return "success";
    
            }
    
            else{
    
                return "error";
    
            }
    
            $stmt->close();
    
        }




        /**MODELO PRODUCTOS --------------------------------------------------------------------------*/

        //Vista de Productos
        public function vistaProductosModel($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT id, nombre, talla, precio_unitario FROM $tabla");	
            $stmt->execute();
    
            #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetchAll();
    
            $stmt->close();
    
        }


        public function registroProductosModel($datosModel, $tabla){
    
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, talla, precio_unitario) VALUES (:nombre,:talla,:precio)");	
    
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":talla", $datosModel["talla"], PDO::PARAM_STR);
            $stmt->bindParam(":precio", $datosModel["precio_unitario"], PDO::PARAM_STR);
    
            if($stmt->execute()){
                return "success";
            }
            else{
                return "error";
            }
    
            $stmt->close();
    
        }

        //Registro de Producto
        public function registroProductoModel($datosModel, $tabla){
    
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, talla, precio_unitario) VALUES (:nombre,:talla,:precio)");	
    
        
    
            $stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":talla", $datosModel["talla"], PDO::PARAM_STR);
            $stmt->bindParam(":precio", $datosModel["precio"], PDO::PARAM_STR);
    
            if($stmt->execute()){
    
                return "success";
    
            }
    
            else{
    
                return "error";
    
            }
    
            $stmt->close();
    
        }

        #EDITAR USUARIO
	#-------------------------------------

	public function editarProductoModel($datosModel, $tabla){

        $stmt = Conexion::conectar()->prepare("SELECT id, nombre, talla, precio_unitario FROM $tabla WHERE id = :id");
        
		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);	
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

	}

	#ACTUALIZAR USUARIO
	#-------------------------------------

	public function actualizarProductoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, talla = :talla, precio_unitario = :precio WHERE id = :id");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":talla", $datosModel["talla"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datosModel["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "success";

		}

		else{

			return "error";

		}

		$stmt->close();

	}



        //Eliminar Producto
        public function borrarProductoModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
    
            if($stmt->execute()){
    
                return "success";
    
            }
    
            else{
    
                return "error";
    
            }
    
            $stmt->close();
    
        }

        /** MODELO VENTA ------------------------------------------------------------------------------------------------------------------------------*/
        //Registrar Venta
        public function registrarVentaModel($datosModel, $tabla){
    
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (fecha, subtotal, total) VALUES (CURDATE(), '0', '0')");	
    
            $stmt->bindParam(":fecha", $datosModel, PDO::PARAM_STR);    
    
            if($stmt->execute()){
                //$stmt->close();
                $stmt = Conexion::conectar()->prepare("SELECT MAX(id) AS 'id' FROM ventas");	


                if($stmt->execute()){
                    $id = $stmt->fetch();
                    return $id['id'];
                }else{
                    return 'error';
                }
    
                $stmt->close();
            }
            else{
                return "error";
                $stmt->close();
            }
    
        }

        //Vista de Productos
        public function vistaProductoVentaModel($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT id, nombre, talla, precio_unitario FROM $tabla");	
            $stmt->execute();
    
            #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetchAll();
    
            $stmt->close();
    
        }

        //Registro de Producto
        public function registroProductoVentaModel($datosModel, $tabla){
    
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_venta, id_producto, cantidad_producto) VALUES (:venta,:producto,:cantidad)");	
    
        
    
            $stmt->bindParam(":venta", $datosModel["idVenta"], PDO::PARAM_STR);
            $stmt->bindParam(":producto", $datosModel["idProducto"], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad", $datosModel["cantidad"], PDO::PARAM_STR);
    
            if($stmt->execute()){
    
                return "success";
    
            }
    
            else{
    
                return "error";
    
            }
    
            $stmt->close();
    
        }

        //Vista de Productos
        public function vistaProductosVentaModel($idVenta){

            $stmt = Conexion::conectar()->prepare("SELECT productos.nombre, cantidad_producto FROM productos_venta INNER JOIN productos ON productos.id = productos_venta.id_producto WHERE id_venta = $idVenta");	
            $stmt->execute();
    
            #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
            return $stmt->fetchAll();
    
            $stmt->close();
    
        }
    
    }
?>