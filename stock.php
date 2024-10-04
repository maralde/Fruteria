<?php
require_once('./configure/configure.php');

$SqlProductos = "SELECT * FROM producto";
$resultProducto = $conn->query($SqlProductos);

$selectProducto = "<select name='producto' class='form-select'>";
if ($resultProducto->num_rows > 0) {
    while ($rowProd = $resultProducto->fetch_assoc()) {
        $selectProducto .= "<option value='" . $rowProd['Id_producto'] . "'>" . $rowProd['Nombre_prod'] . "</option>";
    }
}
$selectProducto .= "</select>";

$cantidad = "0";
$costeTotal = "0";
$media = "0";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Id_Producto = $_POST['producto'];
    $sql = "SELECT COUNT(h.Id_producto) AS ResultadosTotales, (SUM(h.Cantidad_compra*h.Precio_compra)/SUM(h.Cantidad_compra)) AS media_precio_compra, SUM(h.Cantidad_compra) AS cantidad, SUM(h.Cantidad_compra*h.Precio_compra) AS costeTotal, p.Nombre_prod AS producto FROM historial AS h, producto AS p WHERE h.Id_producto=" . $Id_Producto . " AND h.Id_producto=p.Id_producto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $nombreProd = $row['producto'];
        if ($row['cantidad'] == 0 || $row['costeTotal'] == 0) {
            echo "error hay un campo vacio ";
        } else {
        $cantidad = $row['cantidad'];
        $costeTotal = round($row['costeTotal'], 2);
        $media = round($row['media_precio_compra'], 2);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
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
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-header bg-green text-dark text-center">
                <h4 class="mb-0">Historial</h4>
            </div>
            <div class="card-body">
                <form action="stock.php" method="post">
                    <div class="mb-3">
                        <label for="producto" class="form-label">Tipo</label>
                        <?php echo $selectProducto; ?>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-green text-dark">Enviar</button>
                    </div>
                </form>
                <div>
                    <h3>Precio por kilo de: </h3>
                    <p> <?php echo $nombreProd ?></p>
                    <p> Cantidad total <?php echo $cantidad ?>kg</p>
                    <p> Coste total <?php echo $costeTotal ?>€</p>
                    <p> El kilo se vende a <?php echo $media ?>€</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>