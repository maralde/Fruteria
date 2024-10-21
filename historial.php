<?php
require_once('./configure/configure.php');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$esAdmin = false;
if (session_start() && $_SESSION["Nombre"] == "Pepi") {
    $esAdmin = true;

    $sql = "SELECT * FROM producto";
    $result = $conn->query($sql);


    $selectProducto = "<select name='producto' id='nombreFr' class='form-select'>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $selectProducto .= "<option value='" . $row['Id_producto'] . "'>" . $row['Nombre_prod'] . "</option>";
        }
    }
    $selectProducto .= "</select>";
    //*Si usamos el metodo POST para cerrar sesión sería asi
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnCerrarSesion'])) {
        session_unset();
        session_destroy();

        header("Location: login.php");
        exit();
    }

} else {
    $contenido = "<h1>No eres pepi, ve al <a href='login.php' class='btn btn-danger'>login</a></h1>";
}


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
    <?php if ($esAdmin) {
        echo $nav;
        ?>
    
        <!-- la forma más comun es con el A y con el hiperenlace -->
        <div class="container d-flex justify-content-center align-items-center h-75">
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
                                name="cantidad" required />
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio del producto</label>
                            <input type="number" id="precio" step="0.01" class="form-control"
                                placeholder="Introduce el precio" name="precio" required />
                        </div>

                        <div class="d-grid">
                            <input type="hidden" name="carritoJson" id="carritoJson">
                            <button type="submit" class="btn btn-green text-dark">Enviar</button></br>
                            <button type="button" class="btn btn-blue text-dark" id="btnCarrito">Añadir al carrito</button></br>
                            <button type="button" class="btn text-dark" id="vaciarCarrito">Vaciar Carrito</button>
                        </div>
                    </form>
                    <form method="POST">
                        <div class="d-grid mt-3">
                        <a href="CerrarSesion.php" class="btn btn-danger">Cerrar Sesión</a>

                        </div>
                    </form>
                    <div id="resultadoCarrito"></div>
                </div>
                <div id="listaCarrito"></div>
            </div>
        </div>
    <?php
    } else {
        ?>
        <h1>No eres pepi, ve al <a href='login.php' class='btn btn-danger'>login</a></h1>
    <?php } ?>
</body>
<script>
    $(document).ready(function () {

        function calculaResultado(c, p) {
            return c * p;
        }

        var carrito = [];
        var precio = 0;
        var cantidad = 0;
        var nombreProd = "";

        function mostrarCarrito() {
            var listaCarrito = $('#listaCarrito');
            listaCarrito.empty();

            carrito.forEach(function (item) {
                listaCarrito.append('<li>' + item.nombre + ': ' + item.total + '€</li>');
            });

            let totalCarrito = carrito.reduce(function (total, item) {
                return total + item.total;
            }, 0);

            $('#resultadoCarrito').html('El precio total del carrito es de ' + totalCarrito + '€');
        }
        nombreProd = $("#nombreFr option:selected").text();
        $("#nombreFr").change(function () {
            $('#cantidad').val(0);
            $('#precio').val(0);
            nombreProd = $("#nombreFr option:selected").text();
        });

        $('#cantidad, #precio').change(function () {
            precio = $("#precio").val();
            cantidad = $("#cantidad").val();
            var ressultado = calculaResultado(cantidad, precio);
            mostrarCarrito();
        });

        $("#btnCarrito").click(function () {

            if (cantidad > 0 && precio > 0) {
                var resultado = calculaResultado(cantidad, precio);
            precioAct = $("#precio").val();
            cantidadAct = $("#cantidad").val();
                carrito.push({ nombre: nombreProd, precio: precioAct, cantidad: cantidadAct, total: resultado });
                mostrarCarrito();
            } else {
                alert('asegurate de no cagarla');
            }
        });
        

        $("#vaciarCarrito").click(function(){
            carrito = [];
            mostrarCarrito();
            cantidad = 0;
            precio = 0;
            $('#MuestraResultado').html('');
        });

        $("#carrito").submit(function(e){
            e.preventDefault();
            $('#carritoJson').val(JSON.stringify(carrito));
            this.submit();
        });
    });
</script>

</html>