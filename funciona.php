<?php
include_once('./configure/configure.php');
session_start(); //*Iniciamos la sesion

$Nombre = $_SESSION["Nombre"];

$Hola = "Bienvenida ".$Nombre;

echo $Hola;