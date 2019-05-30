<?php
	if(!isset($_SESSION['validar'])){
		header("location:index.php?action=login");
		exit();
	
	}