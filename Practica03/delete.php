<?php
    include "database.php";
    $cliente = new Database();

    $id = $_GET['id'];

    $res = $cliente->delete($id);
    $eliminado="";
    if($res){
        $eliminado=1;
    }else{
        $eliminado=0;
    }
    header("location: index.php?e=$eliminado");

?>