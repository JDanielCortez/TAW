<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Examen</title>

	<style>
	</style>
</head>
<body>

		<div align="center">

			<nav>
				<ul>
					<li> <a href="index.php?action=proveedores">Proveedores</a> </li>
					<li> <a href="index.php?action=contacto">Contactos</a> </li>
				</ul>
			</nav>


			<?php
				$mvc = new MvcController();
				$mvc -> enlacesPaginasController();
			?>
		</div>

		
</body>
</html>