<?php
 session_unset();  
 session_destroy(); //*Elimina los datos de la sesión

 header("Location: login.php"); //*Te lleva a la pagina login
 exit();