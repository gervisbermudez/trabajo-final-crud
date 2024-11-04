<?php
include '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Cliente WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "UPDATE Cliente SET nombre = ?, email = ?, telefono = ?, direccion = ? WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $email, $telefono, $direccion, $id);

    if ($stmt->execute()) {
        $mensaje = "Cliente actualizado con éxito";
    } else {
        $mensaje = "Error al actualizar el cliente: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Actualizar Cliente</h2>

        <!-- Mostrar mensaje de éxito o error -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info text-center">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario para actualizar cliente -->
        <form method="POST" action="">
            <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $cliente['nombre']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="<?php echo $cliente['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo $cliente['telefono']; ?>">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <textarea class="form-control" name="direccion"><?php echo $cliente['direccion']; ?></textarea>
            </div>

            <div class="text-right">
                <input type="submit" class="btn btn-primary" value="Actualizar Cliente">
                <a href="clientes.php" class="btn btn-secondary">Volver a la Lista</a>
            </div>
        </form>
    </div>

    <!-- Opcionalmente, puedes incluir Bootstrap JS para funcionalidades como responsive design -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
