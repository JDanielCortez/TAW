<?php
    //clase para conectarnos a la base de datos
    class Database{
        private $con;
        private $dbhost = "localhost";
        private $dbuser = "root";
        private $dbpass = "";
        private $dbname = "tuto_poo";

        public function __construct(){
            $this->connect_bd();
        }

        //metodo de conexion a la bd
        public function connect_bd(){
            $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
            if(mysqli_connect_error()){
                die ("Conexión a la base de datos fallida" . mysqli_connect_error());
            }
        }

        public function sanitize($var){
            $return = mysqli_real_escape_string($this->con, $var);
            return $return;
        }

        public function create($nombres, $apellidos, $telefono, $direccion, $correo_electronico){
            $sql = "INSERT INTO clientes (nombres, apellidos, telefono, direccion, correo_electronico)
                VALUES ('$nombres', '$apellidos', '$telefono', '$direccion', '$correo_electronico')";
            $res = mysqli_query($this->con, $sql);
            if ($res) {
                return true;
            } else {
                return false;
            }
        }

        public function read(){
            $sql = "SELECT * FROM clientes";
            $res = mysqli_query($this->con, $sql);
            return $res;
        }

        public function single_record($id){
            $sql = "SELECT * FROM clientes WHERE id = '$id'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);
            return $return;
        }

        public function update($nombres, $apellidos, $telefono, $direccion, $correo_electronico, $id){
            $sql = "UPDATE clientes SET nombres='$nombres', apellidos='$apellidos', telefono='$telefono', direccion='$direccion', correo_electronico='$correo_electronico' WHERE id='$id'";
            $res = mysqli_query($this->con, $sql);
            if ($res) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($id){
            $sql = "DELETE FROM clientes WHERE id='$id'";
            $res = mysqli_query($this->con, $sql);
            if ($res) {
                return $res;
            } else {
                return $res;
            }
        }

        //Metodo para validar los datos ingresados por el usuario, para inciar sesion, el cual recibe el nombre de usuario, y la contraseña
        public function validar($usuario, $password){
            //consulta a la base de datos, se busca el nombre de usuario ingresado por el usuario
            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
            //Ejecuta consulta
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res);

            //Valida que el nombre de usuario y la contraseña sean los correctos
            if($return->usuario == $usuario &&  $return->contrasena== $password){
                //Regresa el nombre de usuario
                return $return->usuario; 
            }else{
                //Regresa incorrecto en caso de que el usuario y la contraseña no concuerden
                return "incorrecto";
            }
        }
    }
?>