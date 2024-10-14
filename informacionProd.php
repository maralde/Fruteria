<?php 

require_once('./configure/configure.php');

if(isset($_GET['IdProd'])){
    $idProd = $_GET['IdProd'];

    $sql = "SELECT p.Nombre_prod AS nombre, tip.Nombre_tipo AS tipo, c.Nombre_cat AS categoria, tem.Nombre_temp AS temporada, p.Descripcion AS descripcion FROM producto AS p INNER JOIN tipo AS tip ON p.Id_tipo = tip.Id_tipo INNER JOIN categorias AS c ON p.Id_categoria = c.Id_categoria INNER JOIN temporada AS tem ON p.Id_temporada = tem.Id_temporada WHERE p.Id_producto = '$idProd'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $Nombre = $row["nombre"];
        $Tipo = $row["tipo"];
        $Categoria = $row["categoria"];
        $Temporada = $row["temporada"];
        $Descripcion = $row["descripcion"];
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ç, initial-scale=1.0">
    <title>Informacion</title>
        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        />
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        .btn-blue {
            background-color: lightblue;
        }

        .btn-green:hover {
            background-color: #218838;
            color: white;
        }
    </style>
</head>
<body>
    <?php echo $nav; ?>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="width: 400px; border-radius: 10px;">
        <!-- Card Header -->
        <div class="card-header bg-success text-white text-center" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <h4 class="mb-0">
                <?php echo $Nombre; ?>
            </h4>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label font-weight-bold">Tipo:</label>
                <p class="text-muted"><?php echo $Tipo; ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label font-weight-bold">Categoría:</label>
                <p class="text-muted"><?php echo $Categoria; ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label font-weight-bold">Temporada:</label>
                <p class="text-muted"><?php echo $Temporada; ?></p>
            </div>
            <div class="mb-3">
                <label class="form-label font-weight-bold">Descripción:</label>
                <p class="text-muted"><?php echo $Descripcion; ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>