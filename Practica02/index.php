<html>
<body>
    

<?php
    //incluir la clase
    include "persona.php";
    include "conexion.php";

    //Clase Alumno la cual crea el formulario, valida y registra
    class Formulario{

        //Prpopiedades 
        //Objeto de la clase persona 
        public $persona;

        //guardan los errores en caso de que se haya ingresado o no un dato no esperado
        public $edadErr="";
        public $alturaErr="";
        public $pesoErr="";

    
        public function iniciar(){
            $this->persona  = new Persona();
            echo $this->persona->edad;
        }
        

        //Valida los datos ingresados en los campos de texto por parte del usuario
        public function validar(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //Verifica que no este vacio
                if (empty($_POST["edad"])) {
                    $this->edadErr = "Edad is required";
                } else {
                    $this->persona->edad = $this->test_input($_POST["edad"]);
                    // solo numeros
                    if (!preg_match("/^[0-9 ]*$/",$this->persona->edad)) {
                        $this->edadErr = "Only numbers allowed";
                    }
                }
                //Verifica que no este vacio
                if (empty($_POST["altura"])) {
                    $this->alturaErr = "Altura is required";
                } else {
                    $this->persona->altura = $this->test_input($_POST["altura"]);
                    // solo numeros
                    if (!preg_match("/^[0-9 ]*$/",$this->persona->altura)) {
                       // $this->alturaErr = "Only numbers allowed";
                    }
                }

                //Verifica que no este vacio
                if (empty($_POST["peso"])) {
                    $this->pesoErr = "Peso is required";
                } else {
                    $this->persona->peso = $this->test_input($_POST["peso"]);
                    // solo numeros
                    if (!preg_match("/^[0-9 ]*$/",$this->persona->peso)) {
                        $this->pesoErr = "Only numbers allowed";
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
        <h2>Calculo de IMC</h2>
        <p><span class="error">* required field.</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Edad: <input type="text" name="edad" value="<?php echo $this->persona->edad;?>">
            <span class="error">* <?php echo $this->edadErr;?></span>
            <br><br>
            Altura: <input type="text" name="altura" value="<?php echo $this->persona->altura;?>">
            <span class="error">* <?php echo $this->alturaErr;?></span>
            <br><br>
            Peso: <input type="text" name="peso" value="<?php echo $this->persona->peso;?>">
            <span class="error">* <?php echo $this->pesoErr;?></span>
            <br><br>
            <input type="submit" name="submit" value="Calcular" >
        </form><?php
        }

        //metodo para almacenar los datos que el usuario ha ingresado a los campos de texto, en la base de datos
        public function registrar(){
            //objeto de conexion a la base de datos
            $conexion = new Conexion();
            $this->persona->imc();
            //verifica que esten vacios los errores y que los datos esten vacios
            if(($this->edadErr == "" && $this->alturaErr == "" && $this->pesoErr == "" ) && ($this->persona->edad != "" && $this->persona->altura != "" && $this->persona->peso != "" && $this->persona->imc != "" )){
                //conecta a la base de datos
                $conexion->conectar();
                ////ejecuta la insercion de los datos
                //echo "holaaa";
                if($conexion->insertarPersona($this->persona->edad, $this->persona->altura, $this->persona->peso, $this->persona->imc)){
                    //indica que los datos se han insertado en caso de haer sido asi
                    echo "Datos sobre IMC de la persona insertados exitosamente<br>";
                    echo "Datos ingresados <br>";
                    echo "<br> Edad: ".$this->persona->edad;
                    echo "<br> Altura: ".$this->persona->altura;
                    echo "<br> Peso: ".$this->persona->peso;
                    echo "<br> IMC: ".$this->persona->imc;
                }
                //cierra la conexion a la base de datos
                $conexion->cerrarConexion();
            }else{
                echo "Faltan campos";
            }
        }
    }

   /*
    //Se crea un objeto de la clase alumno
    $formAlumno = new Alumno();
     //determina si se han ingresaos los datos, 
    $formAlumno -> validar();
    //genera los campos de  texto
    $formAlumno -> vista();
    //almacena datos en la base de datos
    $formAlumno -> registrar();*/
    $form = new Formulario();
    $form->iniciar();
    $form->validar();
    $form->vista();
    $form->registrar();

?>


<ul>
    
</ul>
    <?php//CODIGO ORIGILA DEL EJEMPLO-----------------------------------------------------
   
?>
</body>
</html>