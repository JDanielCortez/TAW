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
    }
?>