<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=p05","root","danielcortez98");
		return $link;

	}

}

?>