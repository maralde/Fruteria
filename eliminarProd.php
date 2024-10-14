<?php 

require_once('./configure/configure.php');

if(isset($_GET['IdProd'])){
    $idProd = $_GET['IdProd'];

    $sql = "DELETE FROM historial WHERE Id_producto='$idProd'";

    $conn -> query($sql);

    $conn -> close();

    header("Location: almacen.php");
}