<?php
include '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Pedido WHERE id_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "i" para integer
    $stmt->execute();
    $result = $stmt->get_result();
    $pedido = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_pedido'];
    $monto_total = $_POST['monto_total'];
    $estado = $_POST['estado'];

    $sql = "UPDATE Pedido SET monto_total = ?, estado = ? WHERE id_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dsi", $monto_total, $estado, $id); // "d" para decimal, "s" para string, "i" para integer

    if ($stmt->execute()) {
        echo "Pedido actualizado con éxito";
    } else {
        echo "Error al actualizar el pedido: " . $conn->error;
    }

    $stmt->close();
}
?>

<!-- Formulario HTML para actualizar el pedido -->
<form method="POST" action="">
    <input type="hidden" name="id_pedido" value="<?php echo $pedido['id_pedido']; ?>">

    <label for="monto_total">Monto Total:</label>
    <input type="number" step="0.01" name="monto_total" value="<?php echo $pedido['monto_total']; ?>" required><br>

    <label for="estado">Estado:</label>
    <select name="estado" required>
        <option value="pendiente" <?php echo ($pedido['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
        <option value="completado" <?php echo ($pedido['estado'] == 'completado') ? 'selected' : ''; ?>>Completado</option>
    </select><br>

    <input type="submit" value="Actualizar Pedido">
</form>

<!-- Botón para volver atrás -->
<div class="text-right mb-2">
                        <a href="pedidos.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>
                            Volver
                            al listado</a>
                    </div>