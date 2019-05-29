<?php 
	//funciones sin parametros
	function saludo (){
		echo "Hola soy alumno de ITI";
	}

	saludo();

	//funcion con parametros
	function despedida($adios){
		echo $adios."<br>";
	}

	despedida("Adios me voy! <br>");

	//fucion con retorno
	function retorno($retornar){
		return $retornar;
	}

	echo retorno("Retorno en una funcion");
 ?>