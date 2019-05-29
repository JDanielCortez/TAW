<?php
    //Clase de conexion a la base de datos
    class Conexion{
        //usuario de la base de datos
        public $usuario="root";
        //contraseña de la base de datos
        public $pass="";
        //direccion del servidor de base de datos
        public $servidor="localhost";
        //Nombre de la base de datos
        public $bd="TAW";
        //variable de conexion
        private $conn;

        //Metodo para conectar a la base de datos
        public function conectar(){
            $this->conn = mysqli_connect( $this->servidor, $this->usuario, $this->pass, $this->bd ) or die ("No ha sido posible conectar al servidor");
        }

        //Metodo para insertar datos de la persona a la base de datos
        public function insertarPersona($edad, $altura, $peso, $imc){
            //sentencia SQL para insertar datos de maestro a la base de datos
            $sql = "INSERT INTO persona (edad, altura, peso, imc) VALUES ('$edad','$altura','$peso','$imc')";
            //Ejecuta la sentencia de insercion y regresa 1 en caso de ser exitosa la insercion
            return mysqli_query( $this->conn, $sql ) or die ( "No ha sido posible realizar la insercion");
        }

        //Metodo para cerrar la conexion a la base de datos
        public function cerrarConexion(){
            //cierra la conexion a la base de datos
            mysqli_close($this->conn);
        }

    }
?>