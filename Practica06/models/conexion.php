<?php

class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=p06-hotel","root","danielcortez98");
		return $link;

	}

}

?>