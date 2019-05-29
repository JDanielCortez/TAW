<?php 
	//Variable de texto
	$palabra = "Alumno de ITI TAW";
	echo "Esto es una vairable de texto: $palabra<br>";
	var_dump($palabra); //imprime las propiedades de una variable
	echo "<br><br>";

	//Variable de arreglo
	$colores = array("rojo","amarillo");
	echo "Esto es una vairable de arrreglo: $colores[1]<br>";
	var_dump($colores);
	echo "<br><br>";

	//Variable de arreglo con propiedades
	$verduras = array("verdura1"=>"lechuga","verdura2"=>"cebolla","verdura3"=>"tomate");
	echo "Esto es una vairable arreglo con propiedades: $verduras[verdura1] <br>";
	var_dump($verduras);
	echo "<br><br>";

	//varibles de tipo objeto
	$frutas = (object)["fruta1"=>"pera","fruta2"=>"sandia"];
	echo "Esto es un variable de tipo objeto: $frutas->fruta1<br>";
	var_dump($frutas);
 ?>