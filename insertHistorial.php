<?php
require_once('./configure/configure.php');
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Obtener los datos del formulario
    $Producto = $_POST['producto'];
    $Cantidad = $_POST['cantidad'];
    $Precio = $_POST['precio'];
    $Fecha = date("d-m-Y");
    $NombreProd = "";

    //Preparar la consulta SQL
    $sql = "INSERT INTO historial (Id_producto, Cantidad_compra, Precio_compra, Fecha_compra)
                        VALUES (?,?,?,?)";
    
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("iids", $Producto, $Cantidad, $Precio, $Fecha);

        //Ejecutar la consulta
        if ($stmt->execute()){
            echo "<h2> Información almacenada con éxito</h2></br>";
            echo "<p>Producto: ".$Producto."</p></br>";
            echo "<p>Temporada producto: ".$Cantidad."</p></br>";
            echo "<p>Tipo Producto: ".$Precio."</p></br>";
            echo "<p>Tipo Producto: ".$Fecha."</p></br>";
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