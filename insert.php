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
    $Descripcion = $_POST['descripcion'];
    $archivo = $_FILES['archivo']['name'];

    if(isset($archivo) && $archivo != ""){
        //Datos necesarios
        $type = $_FILES['archivo']['type'];
        $size = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        //Comprobamos que sea correcto ciertas cosas
        if(!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) &&($size < 2000000))){
            echo '<div><br>Error. La extensión o el tamaño de los archivos es incorrecto.</br>
            - Se permiten archivos .gif, .jpg, .png y de 200kb como máximo.</b></div>';
        } else {
            //Imagen correcta
            if(move_uploaded_file($temp, 'images/'.$archivo)){
                //cambiamos los permisos
                chmod('images/'.$archivo,0777);
                $tiempo = time();
                $imagenGuardarBBDD = 'images/'.$archivo;
            }
        }
    }

    //Preparar la consulta SQL
    $sql = "INSERT INTO producto (Nombre_prod, Id_temporada, Id_tipo, Id_categoria, Descripcion, Imagen)
                        VALUES (?,?,?,?,?,?)";
    
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("siiiss", $Producto, $Temporada, $Tipo, $Categoria, $Descripcion, $imagenGuardarBBDD);

        //Ejecutar la consulta
        if ($stmt->execute()){
            echo "<h2> Información almacenada con éxito</h2></br>";
            echo "<p>Producto: ".$Producto."</p></br>";
            echo "<p>Temporada producto: ".$Temporada."</p></br>";
            echo "<p>Tipo Producto: ".$Tipo."</p></br>";
            echo "<p>Descripcion: ".$Descripcion."</p></bt>";
            echo "<img src='./".$imagenGuardarBBDD."'>";
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