<?php
    //Ttrabajar con poo
    //clase
    //una clase es un modelo que se utiliza para crear objetos que comparten un mismo comportamiento, estado o identidad 
    class Automovil{
        //PROPIEDADES
        //son las caracteristicas que puede tener un objeto
        public $marca;
        public $modelo;

        //METODOS
        //Es el algoritmo asoscioado a un obheto que indica la capacdad de lo que este puede hacer, la unica diferencia entre metodo y funcion es que llamamos METODO a las funciones de una clase en POO mientras que llamamos funciones a los algoritmos de la programacion estructurada 
        public function mostrar(){
            echo "<p>Hola soy un $this->marca, modelo $this->modelo</p>";
        }
    }

    //OBJETOS
    //Una entidad provista de metodos o mensajes a los cuales responde 
    $a = new Automovil();
    $a -> marca = "Toyota";
    $a -> modelo = "Corola";
    $a -> mostrar();

    $b = new Automovil();
    $b -> marca = "Nissan";
    $b -> modelo = "Tsuru";
    $b -> mostrar();

    //Principios de la POO que se cumplen en este ejemplo 
    //1. Abstraccion: Nuevos tipos de datos, el que se quiera se crea.
    //2. Encapsulamiento: Organiza el codigo en grupos logicos.
    //3. Ocultamiento: Oculta detalles de implementacion y poner solo lo que sea necesario apara el resto del sistema
?>