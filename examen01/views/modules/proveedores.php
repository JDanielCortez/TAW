<div>
    <div>
        <h1>Proveedores</h1>
    </div>
    <div>
        <a href="index.php?action=proveedores&agregar"><button>Nuevo</button></a>
    </div>

    <table >
        
        <thead>
            <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>RFC</th>
                <th>Direccion</th>
                <th>Email</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>   
            <?php
            $proveedor = new MvcController();
            $proveedor -> listaProveedoresController();
            $proveedor -> borrarProveedorController();
            ?>
        </tbody>
    </table>
</div>
<div>
    <?php
        if(isset($_GET["agregar"])){?>
            <h1>Registrar Proveedor</h1>
                <form method="post">
                <?php
                    $proveedor -> registroProveedorController();
                ?>
                </form><?php
            
            $proveedor -> insertarProveedorController();
        }

        if(isset($_GET['id'])){
            ?>
            <h1>Editar Producto</h1>
            <form method="post"> <?php
                $proveedor -> editarProveedorController();
            ?>
            </form><?php
        }
        $proveedor -> actualizarProveedorController();
    ?>
</div>
