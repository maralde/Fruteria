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

$sql = "SELECT * FROM producto";
$result = $conn->query($sql);


$selectProducto = "<select name='producto' id='nombreFr' class='form-select'>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $selectProducto .= "<option value='" . $row['Id_producto'] . "'>" . $row['Nombre_prod'] . "</option>";
    }
}
$selectProducto .= "</select>";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-header bg-green text-dark text-center">
                <h4 class="mb-0">Historial</h4>
            </div>
            <div class="card-body">
                <form action="insertHistorial.php" method="post">

                    <div class="mb-3">
                        <label for="producto" class="form-label">Tipo</label>
                        <?php echo $selectProducto; ?>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad comprada</label>
                        <input type="number" id="cantidad" class="form-control" placeholder="Introduce la cantidad"
                            name="cantidad" required/>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio del producto</label>
                        <input type="number" id="precio" step="0.01" class="form-control"
                            placeholder="Introduce el precio" name="precio" required />
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-green text-dark">Enviar</button></br></br>
                        <button type="button" class="btn btn-blue text-dark" id="btnCarrito">Añadir al carrito</button>
                    </div>
                </form>
                <div id="resultadoCarrito"></div>
            </div>
            <div id="listaCarrito"></div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {

        function calculaResultado(c, p) {
            return c*p;
        }

        var carrito = [];
        var precio = 0;
        var cantidad = 0;
        var nombreProd = "";

        function mostrarCarrito(){
            var listaCarrito = $('#listaCarrito');
            listaCarrito.empty();

            carrito.foreach(function(item) {
                listaCarrito.append('<li>' + item.nombre + ': ' + item.total + '€</li>');
            });

            var totalCarrito = carrito.reduce(function(total, item) {
                return total + item.total;
            }, 0);

            $('#resultadoCarrito').html('El precio total del carrito es de ' + totalCarrito + '€');
        }
        nombreProd = $("#nombreFr option:selected").text();
        $("#nombreFr").change(function () {
            $('#cantidad').val(0);
            $('#precio').val(0);
            nombreProd = $("#nombreFr option:selected").text();
            console.log(nombreProd);
        });

        $('#cantidad, #precio').change(function(){
            precio = $("#precio").val();
            cantidad = $("#cantidad").val();
            var ressultado =calculaResultado(cantidad, precio);
            mostrarCarrito();
            console.log(precio, cantidad);
        });

        $("#btnCarrito").click(function () {

            if(cantidad > 0 && precio > 0){
                var resultado = calculaResultado(cantidad, precio);
                carrito.push({ nombre: nombreProd, total: resultado});
                mostrarCarrito();
            } else {
                alert('asegurate de no cagarla')
            }
        });
    });
</script>

</html>