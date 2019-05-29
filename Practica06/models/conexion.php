<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=p06-Hotel","root","danielcortez98");
		return $link;

	}

}

?>