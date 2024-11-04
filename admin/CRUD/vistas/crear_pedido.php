<?php
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $monto_total = $_POST['monto_total'];
    $estado = $_POST['estado']; // 'pendiente' o 'completado'

    $sql = "INSERT INTO Pedido (monto_total, estado) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $monto_total, $estado); // "d" para decimal, "s" para string

    if ($stmt->execute()) {
        echo "Pedido creado con éxito";
    } else {
        echo "Error al crear pedido: " . $conn->error;
    }

    $stmt->close();
}
?>

<!-- Formulario HTML para crear un pedido -->
<form method="POST" action="">
    <label for="monto_total">Monto Total:</label>
    <input type="number" step="0.01" name="monto_total" required><br>

    <label for="estado">Estado:</label>
    <select name="estado" required>
        <option value="pendiente">Pendiente</option>
        <option value="completado">Completado</option>
    </select><br>

    <input type="submit" value="Crear Pedido">
</form>