<?php
    class Database{

        //Propiedades de la clase Database.

        //Propiedades para la conexion a la base de datos
        private $dsn = 'mysql:dbname=taw;host=localhost'; //Origen de la base de datos
        private $user = "root"; //Nombre de la base de datos a la que se conecta
        private $pass = ""; //Contraseña de la base de datos

        //Propiedad usada para la conexion y sentencias sql
        private $pdo;

        //El constructor de la clase realiza la conexion a la base de datos
        public function __construct(){
            try {
                //Realiza la conexion a la base de datos, mediante un objeto PDO
                $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
                //echo "Conectado";
            } catch ( PDOException $e) {
                //En caso de error en la conexion muestra mensaje de error.
                echo 'Error al conectarnos: ' . $e->getMessage();
            }
        }

        //Metodo para contar los regstros existentes en una tabla determinada, este metodo recibe como parametro el nombre de la tabla de la cual contara los registros que contiene
        public function contarRegistros($tabla){
            //Sentencia sql para contar los registros en la tabla
            $sql = "SELECT count(*) AS 'total' FROM $tabla";

            //Ejecuta sentencia y toma los valores que regresa y los guarda en un array asociativo
            $sentencia = $this->pdo->query($sql)->fetch();
            
            //Regresa los registros obtenidos tras la consulta en la columna total
            return $sentencia['total'];
        }

        //Metodo para contar la cantidad de usuarios con un determinado estado (Activo o Inactivo), este metodo recibe como parametro el estado del usuario
        public function contarEstadoUsuario($estado){
            //Sentencia sql para contar los registros con un determinado estado en la tabla
            $sql = "SELECT count(*) as 'total' FROM user INNER JOIN status ON user.Status_id = status.Id WHERE Name='$estado'";

            //Ejecuta sentencia y toma los valores que regresa y los guarda en un array asociativo
            $sentencia = $this->pdo->query($sql)->fetch();
            
            //Regresa los registros obtenidos tras la consulta en la columna total
            return $sentencia['total'];
        }

        //Este metodo realiza la consulta a la base de datos para recuperar los datos cotenidos en la tabla de usuarios (user)
        public function consultarUsuarios(){
            //Sentencia sql para recuperar los registros de la tabla user con un inner join a las tablas de status y user_type para mostrar los datos de status del usuario y el tipo, los cuales son llaves foraneas en la tabla user
            $sql = "SELECT user.Id as 'Id', Email, Pssw, status.Name as 'status', user_type.Name as 'name' 
                FROM user 
                    INNER JOIN status ON user.Status_id = status.Id 
                    INNER JOIN user_type ON user.User_type_id = user_type.Id";

            //Ejecuta sentencia y toma los valores que recupera y los guarda en un array asociativo
            $sentencia = $this->pdo->query($sql);
            
            //Regresa el array asociatio con los registros recuperados
            return $sentencia;
        }

        //Este metodo realiza la consulta a la base de datos para recuperar los datos cotenidos en la tabla de user_log, la cual registra los accesos
        public function consultarLoggins(){
            //Sentencia sql para recuperar los registros de la tabla user_log
            $sql = "SELECT * FROM user_log";

            //Ejecuta sentencia y toma los valores que recupera y los guarda en un array asociativo
            $sentencia = $this->pdo->query($sql);
            
            //Regresa el array asociatio con los registros recuperados
            return $sentencia;
        }

        //Este metodo realiza la consulta a la base de datos para recuperar los datos cotenidos en la tabla de user_type, la cual registra los tipos de usuarios con los que se cuenta
        public function consultarTiposUsuario(){
            //Sentencia sql para recuperar los registros de la tabla user_type
            $sql = "SELECT * FROM user_type";

            //Ejecuta sentencia y toma los valores que recupera y los guarda en un array asociativo
            $sentencia = $this->pdo->query($sql);
            
            //Regresa el array asociatio con los registros recuperados
            return $sentencia;
        }

        //Este metodo realiza la consulta a la base de datos para recuperar los datos cotenidos en la tabla de status, la cual los status que puede tener una cuanta de usuario ej. Activo, Inactivo
        public function consultarStatus(){
            //Sentencia sql para recuperar los registros de la tabla status
            $sql = "SELECT * FROM status";

            //Ejecuta sentencia y toma los valores que recupera y los guarda en un array asociativo
            $sentencia = $this->pdo->query($sql);
            
            //Regresa el array asociatio con los registros recuperados
            return $sentencia;
        }

        //Metodo para realizar una consulta a la tabla de futbolistas en la base de datos
        public function readFutbolistas(){
            //Setencia sql que selecciona todas las filas de la tabla futbolistas
            $sql = "SELECT * FROM futbolistas";
            //Ejecuta la sentencia
            $sentencia = $this->pdo->query($sql);
            //Regresa los registos recuperados por la sentencia en forma de array asociativo
            return $sentencia;
        }

        //Medo para registrar un futbolista en la base de datos, los parametros que recibe son los datos del futbolista tales como: numero del torso que lleva en la camiseta, nombre completo, la pocision en la que juega, la carrera que cursa, y su correo electronico
        public function createFutbolista($numero, $nombre, $posicion, $carrera, $email){
            //Sentenci sql para la incercion en todos los campos de la tabla
            $sql = "INSERT INTO futbolistas (id, nombre, posicion, carrera, email) VALUES ('$numero', '$nombre', '$posicion', '$carrera', '$email')";
            //se ejecuta la sentencia
            $sentencia = $this->pdo->query($sql);
            //Se regresa el resultado
            return $sentencia;
        }

        //Metodo para realizar consulta y que devuelva un unico registro a partir el numeo del jugador en este caso el id, es usado para llenar los campos de texto al momento de realizar una actualizacion de los datos del jugador
        public function singleRecordFutbolista($id){
            //Sentencia con consulta sql a la tabla realizando una busqueda a partir del id
            $sql = "SELECT * FROM futbolistas WHERE id='$id'";
            //Se ejecuta la sencencia
            $sentencia = $this->pdo->query($sql);
            // se regresa el resultado en un array
            return $sentencia->fetch();
        }

        //Metodo para actualizar los datos del jugador, recibe como parametro los nuevos dadot de el jugador los cuales son: el numero del jugador, nombre completo, la poscicion en la que juega, la carrera a la que pertenece, su correo electronico, y el numero que actualmente usa en la camiseta
        public function updateFutbolista($numero, $nombre, $posicion, $carrera, $email, $numActual){
            //Sentencia sql que actualiza los datos de todos los campos, al ser el id modificable y no autincrementable se reciben el nuevo numero del jugador, asi como el actual, esto para hacer la actualizacion del registro correcto (los id siguen siendo llaves foraneas y por lo tanto son registros unicos)
            $sql = "UPDATE futbolistas SET 
                id ='$numero',
                nombre ='$nombre',
                posicion = '$posicion',
                carrera= '$carrera',
                email = '$email'
                WHERE id='$numActual'";
            //Se ejecuta sentencia
            $sentencia = $this->pdo->query($sql);
            //Regresa el resultado
            return $sentencia;
        }

        //Metodo para realizar la eliminacion de un registro en la tabla d futbolistas a prtir del id del jugador
        public function deleteFutbolista($id){
            //Sentencia sql para eliminar a un determinado jugador a partir de su id
            $sql = "DELETE FROM futbolistas WHERE id='$id'";
            //Se ejecuta la sentencia
            $sentencia = $this->pdo->query($sql);
            //Seregresa el resultado
            return $sentencia;
        }

        /**Re realizan las mismas operaciones para los bsquetbolistas solo cambian las tablas ************************************************
         * ***********************************************************************************************************************************
         * ***********************************************************************************************************************************
        */

         //Metodo para realizar una consulta a la tabla de futbolistas en la base de datos
         public function readBasquetbolistas(){
            //Setencia sql que selecciona todas las filas de la tabla futbolistas
            $sql = "SELECT * FROM basquetbolistas";
            //Ejecuta la sentencia
            $sentencia = $this->pdo->query($sql);
            //Regresa los registos recuperados por la sentencia en forma de array asociativo
            return $sentencia;
        }

        //Medo para registrar un futbolista en la base de datos, los parametros que recibe son los datos del basquetbolista tales como: numero del torso que lleva en la camiseta, nombre completo, la pocision en la que juega, la carrera que cursa, y su correo electronico
        public function createBasquetbolista($numero, $nombre, $posicion, $carrera, $email){
            //Sentenci sql para la incercion en todos los campos de la tabla
            $sql = "INSERT INTO basquetbolistas (id, nombre, posicion, carrera, email) VALUES ('$numero', '$nombre', '$posicion', '$carrera', '$email')";
            //se ejecuta la sentencia
            $sentencia = $this->pdo->query($sql);
            //Se regresa el resultado
            return $sentencia;
        }

        //Metodo para realizar consulta y que devuelva un unico registro a partir el numeo del jugador en este caso el id, es usado para llenar los campos de texto al momento de realizar una actualizacion de los datos del jugador
        public function singleRecordBasquetbolista($id){
            //Sentencia con consulta sql a la tabla realizando una busqueda a partir del id
            $sql = "SELECT * FROM basquetbolistas WHERE id='$id'";
            //Se ejecuta la sencencia
            $sentencia = $this->pdo->query($sql);
            // se regresa el resultado en un array
            return $sentencia->fetch();
        }

        //Metodo para actualizar los datos del jugador, recibe como parametro los nuevos dadot de el jugador los cuales son: el numero del jugador, nombre completo, la poscicion en la que juega, la carrera a la que pertenece, su correo electronico, y el numero que actualmente usa en la camiseta
        public function updateBasquetbolista($numero, $nombre, $posicion, $carrera, $email, $numActual){
            //Sentencia sql que actualiza los datos de todos los campos, al ser el id modificable y no autincrementable se reciben el nuevo numero del jugador, asi como el actual, esto para hacer la actualizacion del registro correcto (los id siguen siendo llaves foraneas y por lo tanto son registros unicos)
            $sql = "UPDATE basquetbolistas SET 
                id ='$numero',
                nombre ='$nombre',
                posicion = '$posicion',
                carrera= '$carrera',
                email = '$email'
                WHERE id='$numActual'";
            //Se ejecuta sentencia
            $sentencia = $this->pdo->query($sql);
            //Regresa el resultado
            return $sentencia;
        }

        //Metodo para realizar la eliminacion de un registro en la tabla d futbolistas a prtir del id del jugador
        public function deleteBasquetbolista($id){
            //Sentencia sql para eliminar a un determinado jugador a partir de su id
            $sql = "DELETE FROM basquetbolistas WHERE id='$id'";
            //Se ejecuta la sentencia
            $sentencia = $this->pdo->query($sql);
            //Seregresa el resultado
            return $sentencia;
        }
    }
?>