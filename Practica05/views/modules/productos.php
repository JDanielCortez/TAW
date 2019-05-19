<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>


<div>
<div>
    <h1>PRODUCTOS</h1>
</div>
<div>
    <a href="index.php?action=productos&agregar=0"><button>Agregar</button></a>
</div>

<table border="1">
    
    <thead>
        
        <tr>
            <th>Producto</th>
            <th>Talla</th>
            <th>Precio</th>
            <th></th>
            <th></th>

        </tr>

    </thead>

    <tbody>
        
        <?php

        $vistaProducto = new MvcController();
        $vistaProducto -> vistaProductosController();
        $vistaProducto -> borrarProductoController();

        ?>

    </tbody>

</table>
</div>
<div>
    <?php
        if(isset($_GET["agregar"])){

            if($_GET["agregar"] == "0"){?>
            <h1>Registrar Producto</h1>
                <form method="post">
                <?php
                    $vistaProducto -> registroProductoController();
                ?>
                </form><?php
            
            }
            $vistaProducto -> insertarProductoController();
        }

        if(isset($_GET['id'])){
            ?>
            <h1>Editar Producto</h1>
            <form method="post"> <?php
                $vistaProducto -> editarProductoController();
            ?>
            </form><?php
        }
        $vistaProducto -> actualizarProductoController();
    ?>
</div>
<?php

if(isset($_GET["crea"])){

	if($_GET["crea"] == "ok"){

		echo "Registro Exitoso";
	
	}
}

if(isset($_GET["cambio"])){

	if($_GET["cambio"] == "ok"){

		echo "Cambio Exitoso";
	
    }
}

if(isset($_GET["borra"])){

	if($_GET["borra"] == "ok"){

		echo "Eliminación Exitosa";
	
    }
}

?>