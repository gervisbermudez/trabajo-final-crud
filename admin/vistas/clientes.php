<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">ABM de Clientes</h2>

        <!-- Botón para redirigir a crear cliente -->
        <div class="text-right mb-3">
            <a href="crear_cliente.php" class="btn btn-primary">Agregar Cliente</a>
        </div>

        <!-- Tabla estática de clientes -->
        <table class="table table-striped mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'leer_cliente.php'; ?>
            </tbody>
        </table>
    </div>

    <!-- Opcionalmente, puedes incluir Bootstrap JS si quieres funcionalidades como el responsive design -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
