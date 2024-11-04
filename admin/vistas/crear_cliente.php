<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO Cliente (nombre, email, telefono, direccion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $direccion); // "ssss" string, string, string, string

    if ($stmt->execute()) {
        $mensaje = "Cliente creado con éxito";
    } else {
        $mensaje = "Error al crear cliente: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Cliente</h2>

        <!-- Mostrar mensaje de éxito o error -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para crear un cliente -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" id="telefono">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <textarea class="form-control" name="direccion" id="direccion"></textarea>
            </div>

            <div class="text-right">
                <input type="submit" class="btn btn-primary" value="Crear Cliente">
                <a href="clientes.php" class="btn btn-secondary">Volver a la Lista</a>
            </div>
        </form>
    </div>

    <!-- Opcionalmente, puedes incluir Bootstrap JS para funcionalidades como responsive design -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
