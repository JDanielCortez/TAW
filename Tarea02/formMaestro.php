<html>
    <title>Formulario de alumno</title>

    <body>

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

        //Metodo para insertar datos de maestro a la base de datos
        public function insertarMaestro($noEmpleado, $nombre, $carrera, $telefono){
            //sentencia SQL para insertar datos de maestro a la base de datos
            $sql = "INSERT INTO maestros (no_empleado, nombre, carrera, telefono) VALUES ('$noEmpleado','$nombre','$carrera','$telefono')";
            //Ejecuta la sentencia de insercion y regresa 1 en caso de ser exitosa la insercion
            return mysqli_query( $this->conn, $sql ) or die ( "No ha sido posible realizar la isnercion");
        }

        //Metodo para cerrar la conexion a la base de datos
        public function cerrarConexion(){
            //cierra la conexion a la base de datos
            mysqli_close($this->conn);
        }

    }

    //Clase Maestro la cual crea el formulario, valida y registra
    class Maestro{

        //Prpopiedades de maestro
        public $noEmpleado="";
        public $nombre="";
        public $carrera="";
        public $telefono="";

        //guardan los errores en caso de que se haya ingresao o no un dato no esperado
        public $noEmpleadoErr="";
        public $nombreErr="";
        public $carreraErr="";
        public $telefonoErr="";

    
        //Valida los datos ingresados en los campos de texto por parte del usuario
        public function validar(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //Verifica que no este vacio
                if (empty($_POST["matricula"])) {
                    $this->noEmpleadoErr = "No Empleado is required";
                } else {
                    $this->noEmpleado = $this->test_input($_POST["matricula"]);
                    //verifica que solo sean numeros los que se han ingresado
                    if (!preg_match("/^[0-9 ]*$/",$this->noEmpleado)) {
                        $this->noEmpleadoErr = "Only numbers allowed";
                    }
                }
                // verifica que  no este vacio el nombre
                if (empty($_POST["name"])) {
                    $this->nombreErr = "Name is required";
                } else {
                    $this->nombre = $this->test_input($_POST["name"]);
                    // solo letras y espacios
                    if (!preg_match("/^[a-zA-Z ]*$/",$this->nombre)) {
                        $this->nombreErr = "Only letters and white space allowed";
                    }
                }
                //Verifica que el campo de carrera no este vacio
                if (empty($_POST["carrera"])) {
                    $this->carreraErr = "Carrera is required";
                } else {
                    $this->carrera = $this->test_input($_POST["carrera"]);
                    // Verifica que solo contenga letras y espacios
                    if (!preg_match("/^[a-zA-Z ]*$/",$this->carrera)) {
                        $this->carreraErr = "Only letters and white space allowed";
                    }
                }
                //verifica que el campo de telefono no ete vacio
                if (empty($_POST["telefono"])) {
                    $this->telefonoErr = "Matricula is required";
                } else {
                    $this->telefono = $this->test_input($_POST["telefono"]);
                    // verifica que solo sean numericos
                    if (!preg_match("/^[0-9 ]*$/",$this->telefono)) {
                        $this->telefonoErr = "Only numbers allowed";
                    }
                }
            }
        }

        public function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Genera los campos de texto del formulario en el cual se ingresan los datos del maestro
        public function vista(){?>
        <h2>PHP Form Validation Example</h2>
        <p><span class="error">* required field.</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            No Empleado: <input type="text" name="matricula" value="<?php echo $this->noEmpleado;?>">
            <span class="error">* <?php echo $this->noEmpleadoErr;?></span>
            <br><br>
            Nombre: <input type="text" name="name" value="<?php echo $this->nombre;?>">
            <span class="error">* <?php echo $this->nombreErr;?></span>
            <br><br>
            Carrera: <input type="text" name="carrera" value="<?php echo $this->carrera;?>">
            <span class="error">* <?php echo $this->carreraErr;?></span>
            <br><br>
            Telefono: <input type="phone" name="telefono" value="<?php echo $this->telefono;?>">
            <span class="error">* <?php echo $this->telefonoErr;?></span>
            <br><br>
            <input type="submit" name="submit" value="Registrar" >
        </form><?php
        }

        //metodo para almacenar los datos que el usuario ha ingresado a los campos de texto, en la base de datos
        public function registrar(){
            //Crea un objeto de la clace conexion
            $conexion = new Conexion();
            //valida que no haya errores y que los campos no este vacios
            if((empty($this->noEmpleadoErr) && empty($this->nombreErr) && empty($this->carreraErr) && empty($this->emailErr) && empty($this->telefonoErr)) && ($this->noEmpleado != "" && $this->nombre != "" && $this->carrera != "" && $this->email != "" && $this->telefono != "")){
                //conectar a la base de datos
                $conexion->conectar();
                //ejecuta la insercion de los datos
                if($conexion->insertarMaestro($this->noEmpleado, $this->nombre, $this->carrera, $this->telefono)){
                    //indica que los datos se han insertado en caso de haer sido asi
                    echo "Datos de maestro insertados exitosamente";
                    //cierra la conexion a la base de datos
                    $conexion->cerrarConexion();
                    //muestra datos insertados
                    echo "<br>";
                    echo "Datos ingresados <br>";
                    echo "$this->noEmpleado <br>"; 
                    echo "$this->nombre <br>"; 
                    echo "$this->carrera <br>"; 
                    echo "$this->telefono <br>"; 
                }
                
            }
        }
    }

   
    //Se crea un objeto de la clase maestro
    $formMaestro = new Maestro();
    //determina si se han ingresaos los datos, 
    $formMaestro -> validar();
    //genera los campos de  texto
    $formMaestro -> vista();
    //almacena datos en la base de datos
    $formMaestro -> registrar();
?>


<ul>
    <li><a href="#">Volver al Inicio</a></li>
</ul>
</body>
</html>