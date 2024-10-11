<?php
include_once('./configure/configure.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Email = $_POST['email'];
    $Password = $_POST['pass'];

    $Pass = md5($Password);

    $sql = "SELECT Nombre FROM usuario WHERE Email='$Email' AND Password='$Pass'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

        session_start(); //*Iniciamos la sesion

        $row = $result->fetch_assoc(); //*Sacamos los datos de la tabla

        $_SESSION["Nombre"] = $row["Nombre"]; //*Obtenemos el nombre del usuario de la tabla

        header("Location: historial.php");

    }

}