
<?php
    //Definnir clase principl
    class Persona{
        //Propiedades de la pesona:
        public $edad = "";
        public $altura = "";
        public $peso = "";
        public $imc = "";

        //Obtener valores
        //getters
        //Edad:
        public function getEdad(){
            return $this->edad;
        }

        //Peso:
        public function getPeso(){
            return $this->peso;
        }

        //Altura
        public function getAltura(){
            return $this->altura;
        }

        //calculos
        //setters
        //Edad:
        public function setEdad($value){
            $this->edad = $value;
        }

        //Peso
        public function setPeso($value){
            $this->peso = $value;
        }

        //Altura:
        public function setALtura($value){
            $this->altura = $value;
        }

        //calcular el IMC accediendo a las propiedades
        public function imc(){
            $this->imc = $this->peso / ($this->altura * $this->altura );
            return $this->imc;
;       }

        //calcular el IMC accediendo a los metodos
        public function imc2(){
            $this->imc = $this->getPeso() / ($this->getAltura() * $this->getAltura() );
            return $this->imc;
;        }
    }
?>