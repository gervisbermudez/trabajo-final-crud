<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>

<div class="container">
    <h1>Bienvenido al Panel de Administración</h1>

    <p>Utilice los siguientes enlaces para gestionar las diferentes secciones de la tienda:</p>

    
</div>
<div class="container mt-5">
        <h2 class="text-center">Pedidos</h2>

        <!-- Botón para redirigir a crear pedido -->
        <div class="text-right mb-3">
            <a href="crear_pedido.php" class="btn btn-primary">Agregar Pedido</a>
        </div>

        <!-- Tabla estática de pedidos -->
        <table class="table table-striped mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Take away o delivery?</th>
                    <th>Dirección</th>
                    <th>Estado del pedido</th>
                    <th>Precio</th>
                    <th>Contacto</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'leer_pedido.php'; ?>
            </tbody>
        </table>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>