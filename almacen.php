<?php
require_once('./configure/configure.php');

$sql='SELECT h.Id_producto AS Id, p.Nombre_prod AS nombre, SUM(h.Cantidad_compra)AS cantidad, AVG(h.Precio_compra) AS precio, (Sum(h.Cantidad_compra) * AVG(h.Precio_compra)) AS precioTotal FROM historial AS h INNER JOIN producto AS p ON h.Id_producto = p.Id_producto GROUP BY h.Id_producto, p.Id_producto';

$result = $conn->query($sql);
$tabla = "";
if($result -> num_rows > 0){
    $tabla = "<table class='table table-bordered'>
    <thead>
        <tr>
            <th> ID </th>
            <th> Nombre </th>
            <th> Cantidad KG </th>
            <th> Precio Medio € </th>
            <th> Precio total € </th>
        </tr>
    </thead>
    <tbody>";
    while($row = $result -> fetch_assoc()){
        $tabla .= "<tr>
        <td>".$row["Id"]."</td>
        <td>".$row["nombre"]."</td>
        <td>".$row["cantidad"]."</td>
        <td>".round($row["precio"],2)."</td>
        <td>".round($row["precioTotal"],2)."</td>
        </tr>";
    }
    $tabla .="</tbody></table>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Cambiar colores a verde */
        .bg-green {
            background-color: #28a745;
            /* Verde Bootstrap */
        }

        .text-green {
            color: #28a745;
            /* Verde Bootstrap */
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #218838;
            color: white;
        }
    </style>
</head>
<body>
    <?php echo $nav; ?>
    <div class="container mt-5">

    <?php echo $tabla; ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>