<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>


<div>
<div>
    <h1>USUARIOS</h1>
</div>
<div>
    <a href="index.php?action=registrarUsuario"><button>Agregar</button></a>
</div>

<table border="1">
    
    <thead>
        
        <tr>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Email</th>
            <th></th>
            <th></th>

        </tr>

    </thead>

    <tbody>
        
        <?php

        $vistaUsuario = new MvcController();
        $vistaUsuario -> vistaUsuariosController();
        $vistaUsuario -> borrarUsuarioController();

        ?>

    </tbody>

</table>
</div>
<div>
    <?php
        if(isset($_GET['id'])){
            ?>
            <h1>Editar Usuario</h1>
            <form method="post"> <?php
            $vistaUsuario -> editarUsuarioController();
            ?>
            </form><?php
        }
        $vistaUsuario -> actualizarUsuarioController();
    ?>
</div>
<?php

if(isset($_GET["cambio"])){

	if($_GET["cambio"] == "1"){

		echo "Cambio Exitoso";
	
	}

}

?>