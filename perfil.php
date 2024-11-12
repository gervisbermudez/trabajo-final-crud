<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$host = 'localhost';
$database = 'tienda_online';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del cliente
$id_cliente = $_SESSION['id_cliente'];
$sql_cliente = "SELECT nombre, apellido, email, telefono, direccion FROM cliente WHERE id_cliente = ?";
$stmt_cliente = $conn->prepare($sql_cliente);
$stmt_cliente->bind_param("i", $id_cliente);
$stmt_cliente->execute();
$result_cliente = $stmt_cliente->get_result();
$cliente = $result_cliente->fetch_assoc();

// Obtener los pedidos pendientes del cliente
$sql_pedidos = "SELECT id_pedido, fecha_pedido, monto_total, estado FROM pedido WHERE id_cliente = ? AND estado = 'pendiente' ORDER BY fecha_pedido DESC";
$stmt_pedidos = $conn->prepare($sql_pedidos);
$stmt_pedidos->bind_param("i", $id_cliente);
$stmt_pedidos->execute();
$result_pedidos = $stmt_pedidos->get_result();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>

    <link rel="stylesheet" href="/public/css/style.css">
    <link href="/public/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body>

    <?php include 'includes/navbar.php';?>

    <div class="container mt-4">

        <h2>Mi Perfil</h2>

        <!-- Datos del Cliente -->
        <div class="card mb-4">
            <div class="card-header">Datos Personales</div>
            <div class="card-body">
                <p><strong>Nombre:</strong>
                    <?php echo htmlspecialchars($cliente['nombre'] . ' ' . $cliente['apellido']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($cliente['email']); ?></p>
                <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($cliente['telefono']); ?></p>
                <p><strong>Dirección:</strong> <?php echo htmlspecialchars($cliente['direccion']); ?></p>
            </div>
        </div>

        <!-- Listado de Pedidos Pendientes -->
        <h3>Pedidos Pendientes</h3>
        <?php if ($result_pedidos->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Fecha</th>
                    <th>Monto Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($pedido = $result_pedidos->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $pedido['id_pedido']; ?></td>
                    <td><?php echo $pedido['fecha_pedido']; ?></td>
                    <td>$<?php echo number_format($pedido['monto_total'], 2); ?></td>
                    <td><?php echo ucfirst($pedido['estado']); ?></td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="alert alert-info">No tienes pedidos pendientes.</div>
        <?php endif;?>

        <a href="index.php" class="mt-3">Volver al Inicio</a>
    </div>
    </div>

    <script src="/public/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/public/vendors/jquery-3.7.1.min.js"></script>
    <script src="/public/js/scripts.js"></script>
</body>

</html>

<?php
$stmt_cliente->close();
$stmt_pedidos->close();
$conn->close();
?>