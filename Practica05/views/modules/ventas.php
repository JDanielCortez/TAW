<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>


<div>
    <h1>VENTAS</h1>
</div>
<div>
    <?php 
    if(!isset($_GET['registrar']) ){
        ?>
        <a href="index.php?action=ventas&registrar=0"><button>Agregar Venta</button></a>
        <?php
        if(!isset($_GET['reportes'])){
            ?>
            <a href="index.php?action=ventas&reportes=0"><button>Reportes</button></a>
            <?php
        }
    }

    $vistaVenta = new MvcController();
    if(isset($_GET['registrar'])){
        if(isset($_GET['crea']) and $_GET['crea']=="ok"){   
        ?>
        <table border="1">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $vistaVenta -> vistaProductosVentaController();
            ?>
        </tbody>
       
        </table>
        <?php
        }
        ?>
        <div>
            <form method="post">
            <?php
            $vistaVenta -> vistaProductoVentaController();
            $vistaVenta -> insertoProductoVentaController();
            ?>
            </form>
        </div>
        <form post="">
            <a href="index.php?action=ventas&finalizar=<?php echo $_GET['idVenta'] ?>"><button>Agregar Venta</button></a>
        </form>
        <?php
        if(isset($_GET['finalizar'])){
            //$vistaVenta -> actualizarProductoVentaController();
        }
        //$vistaVenta -> vistaVentaController();
    }
    ?>
</div>