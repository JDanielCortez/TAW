<html>
    <title>Formulario en PHP7</title>

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
        public function insertarAlumno($matricula, $nombre, $carrera, $email, $telefono){
            //sentencia SQL para insertar datos de maestro a la base de datos
            $sql = "INSERT INTO alumnos (matricula, nombre, carrera, email, telefono) VALUES ('$matricula','$nombre','$carrera','$email','$telefono')";
            //Ejecuta la sentencia de insercion y regresa 1 en caso de ser exitosa la insercion
            return mysqli_query( $this->conn, $sql ) or die ( "No ha sido posible realizar la insercion");
        }

        //Metodo para cerrar la conexion a la base de datos
        public function cerrarConexion(){
            //cierra la conexion a la base de datos
            mysqli_close($this->conn);
        }

    }

    //Clase Alumno la cual crea el formulario, valida y registra
    class Alumno{

        //Prpopiedades de alumno
        public $matricula="";
        public $nombre="";
        public $carrera="";
        public $email="";
        public $telefono="";

        //guardan los errores en caso de que se haya ingresao o no un dato no esperado
        public $matriculaErr="";
        public $nombreErr="";
        public $carreraErr="";
        public $emailErr="";
        public $telefonoErr="";

    
        //Valida los datos ingresados en los campos de texto por parte del usuario
        public function validar(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //Verifica que no este vacio
                if (empty($_POST["matricula"])) {
                    $this->matriculaErr = "Matricula is required";
                } else {
                    $this->matricula = $this->test_input($_POST["matricula"]);
                    // solo numeros
                    if (!preg_match("/^[0-9 ]*$/",$this->matricula)) {
                        $this->matriculaErr = "Only numbers allowed";
                    }
                }
                //verifica que no este vacio
                if (empty($_POST["name"])) {
                    $this->nombreErr = "Name is required";
                } else {
                    $this->nombre = $this->test_input($_POST["name"]);
                    // solo letras y espacios
                    if (!preg_match("/^[a-zA-Z ]*$/",$this->nombre)) {
                        $this->nombreErr = "Only letters and white space allowed";
                    }
                }
                //verifica que no este vacio
                if (empty($_POST["carrera"])) {
                    $this->carreraErr = "Carrera is required";
                } else {
                    $this->carrera = $this->test_input($_POST["carrera"]);
                    // solo letras y espacios
                    if (!preg_match("/^[a-zA-Z ]*$/",$this->carrera)) {
                        $this->carreraErr = "Only letters and white space allowed";
                    }
                }
                //verifica que no este vacio
                if (empty($_POST["email"])) {
                    $this->emailErr = "Email is required";
                } else {
                    $this->email = $this->test_input($_POST["email"]);
                    // verifica que sea una direccion de correo
                    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                        $this->emailErr = "Invalid email format";
                    }
                }
                //verifica que no este vacio
                if (empty($_POST["telefono"])) {
                    $this->telefonoErr = "Matricula is required";
                } else {
                    $this->telefono = $this->test_input($_POST["telefono"]);
                    // solo numeros
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

        //Genera los campos de texto del formulario en el cual se ingresan los datos del alumno
        public function vista(){?>
        <h2>PHP Form Validation Example</h2>
        <p><span class="error">* required field.</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Matricula: <input type="text" name="matricula" value="<?php echo $this->matricula;?>">
            <span class="error">* <?php echo $this->matriculaErr;?></span>
            <br><br>
            Nombre: <input type="text" name="name" value="<?php echo $this->nombre;?>">
            <span class="error">* <?php echo $this->nombreErr;?></span>
            <br><br>
            Carrera: <input type="text" name="carrera" value="<?php echo $this->carrera;?>">
            <span class="error">* <?php echo $this->carreraErr;?></span>
            <br><br>
            E-mail: <input type="text" name="email" value="<?php echo $this->email;?>">
            <span class="error">* <?php echo $this->emailErr;?></span>
            <br><br>
            Telefono: <input type="phone" name="telefono" value="<?php echo $this->telefono;?>">
            <span class="error">* <?php echo $this->telefonoErr;?></span>
            <br><br>
            <input type="submit" name="submit" value="Registrar" >
        </form><?php
        }

        //metodo para almacenar los datos que el usuario ha ingresado a los campos de texto, en la base de datos
        public function registrar(){
            //objeto de conexion a la base de datos
            $conexion = new Conexion();
            //verifica que esten vacios los errores y que los datos esten vacios
            if(($this->matriculaErr == "" && $this->nombreErr == "" && $this->carreraErr == "" && $this->emailErr == "" && $this->telefonoErr=="") && ($this->matricula != "" && $this->nombre != "" && $this->carrera != "" && $this->email != "" && $this->telefono != "") ){
                //conecta a la base de datos
                $conexion->conectar();
                ////ejecuta la insercion de los datos
                if($conexion->insertarAlumno($this->matricula, $this->nombre, $this->carrera, $this->email, $this->telefono)){
                    //indica que los datos se han insertado en caso de haer sido asi
                    echo "Datos de alumno insertados exitosamente";
                    echo "<br>";
                    echo "Datos ingresados <br>";
                    echo "$this->matricula <br>"; 
                    echo "$this->nombre <br>"; 
                    echo "$this->carrera <br>";
                    echo "$this->email <br>"; 
                    echo "$this->telefono <br>"; 
                }
                //cierra la conexion a la base de datos
                $conexion->cerrarConexion();
            }
        }
    }

   
    //Se crea un objeto de la clase alumno
    $formAlumno = new Alumno();
     //determina si se han ingresaos los datos, 
    $formAlumno -> validar();
    //genera los campos de  texto
    $formAlumno -> vista();
    //almacena datos en la base de datos
    $formAlumno -> registrar();
?>


<ul>
    <li><a href="#">Volver al Inicio</a></li>
</ul>
</body>
</html>