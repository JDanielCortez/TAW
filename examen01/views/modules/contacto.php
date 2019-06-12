<div>
    <div>
        <h1>Contacto</h1>
    </div>
    <div>
        <a href="index.php?action=contacto&agregar"><button>Nuevo</button></a>
    </div>

    <table >
        
        <thead>
            <tr>
                <th>Clave</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>E-mail</th>
                <th>Telefono</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>   
            <?php
            $contacto = new MvcController();
            $contacto -> listaContactosController();
            $contacto -> borrarContactoController();
            ?>
        </tbody>
    </table>
</div>
<div>
    <?php
        if(isset($_GET["agregar"])){?>
            <h1>Registrar Contacto</h1>
                <form method="post">
                <?php
                    $contacto -> registroContactoController();
                ?>
                </form><?php
            $contacto -> insertarContactoController();
        }

        if(isset($_GET['id'])){
            ?>
            <h1>Editar Contacto</h1>
            <form method="post"> <?php
                $contacto -> editarContactoController();
            ?>
            </form><?php
        }
        $contacto -> actualizarContactoController();
    ?>
</div>
