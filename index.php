<?php
require_once('./configure/configure.php');

$sql = "SELECT * FROM tipo";
$result = $conn->query($sql);
$sql2 = "SELECT * FROM temporada";
$result2 = $conn->query($sql2);

$selectTipo = "<select name='tipo' class='form-select'>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $selectTipo .= "<option value='" . $row['Id_tipo'] . "'>" . $row['Nombre_tipo'] . "</option>";
    }
}
$selectTipo .= "</select>";

$selectTemporada = "<select name='temporada' class='form-select'>";
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $selectTemporada .= "<option value='" . $row['Id_temporada'] . "'>" . $row['Nombre_temp'] . "</option>";
    }
}
$selectTemporada .= "</select>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍎Pepi's Fruit🍏</title>
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
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-header bg-green text-dark text-center">
                <h4 class="mb-0">🍎Pepi's Fruit🍏</h4>
            </div>
            <div class="card-body">
                <form action="insert.php" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="producto" class="form-label">Producto</label>
                        <input type="text" class="form-control" placeholder="Introduce el nombre" name="producto"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <?php echo $selectTipo; ?>
                    </div>

                    <div class="mb-3">
                        <label for="temporada" class="form-label">Temporada</label>
                        <?php echo $selectTemporada; ?>
                    </div>

                    <div class="mb-3">
                        <label for="Descripcion" class="form-label">Descripción</label>
                        <input name="descripcion" id="descripcion" type="text"/>
                    </div>

                    <div class="mb-3">
                        <label for="archivo" class="form-label">Imagen</label>
                        <input name="archivo" id="archivo" type="file"/>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-green text-dark">Enviar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>