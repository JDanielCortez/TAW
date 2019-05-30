<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=p07","root","danielcortez98");
		return $link;

	}

}

?>