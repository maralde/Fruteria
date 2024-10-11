<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login</title>
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
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-header bg-green text-dark text-center">
                <h4 class="mb-4">Iniciar sesión</h4>
            </div>
            <div class="card-body">
                <form action="enviarDatos.php" method="post">

                    <div class="mb-3">
                        <label for="mail" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control"
                            placeholder="Introduce el correo" required />
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" id="pass" name="pass" class="form-control"
                            placeholder="Introduce la contraseña" required />
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-green text-dark">Inicia sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>