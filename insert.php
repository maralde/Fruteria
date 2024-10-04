<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "Marcos";
$password = "DAW2425";
$dbname = "fruteriapepi";
 
$conn = new mysqli($servername, $username, $password, $dbname);
 
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
 
}
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Obtener los datos del formulario
    $Producto = $_POST['producto'];
    $Temporada = $_POST['temporada'];
    $Tipo = $_POST['tipo'];
    $Categoria = 1;

    //Preparar la consulta SQL
    $sql = "INSERT INTO producto (Nombre_prod, Id_temporada, Id_tipo, Id_categoria)
                        VALUES (?,?,?,?)";
    
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("siii", $Producto, $Temporada, $Tipo, $Categoria);

        //Ejecutar la consulta
        if ($stmt->execute()){
            echo "<h2> Información almacenada con éxito</h2></br>";
            echo "<p>Producto: ".$Producto."</p></br>";
            echo "<p>Temporada producto: ".$Temporada."</p></br>";
            echo "<p>Tipo Producto: ".$Tipo."</p></br>";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        //Cerrar la declaracion
        $stmt->close();
    } else {
        echo "Error al perparar la consulta: " . $conn->error;
    }

}

$conn ->close();