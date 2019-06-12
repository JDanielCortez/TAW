<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=examen01","root","danielcortez98");
		return $link;

	}

}

?>