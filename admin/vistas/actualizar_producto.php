<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Producto WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_producto'];
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $tipo_torta = $_POST['tipo_torta'];
    $precio = $_POST['precio'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $sql = "UPDATE Producto SET nombre_producto = ?, descripcion = ?, tipo_torta = ?, precio = ?, disponible = ? WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdii", $nombre_producto, $descripcion, $tipo_torta, $precio, $disponible, $id);

    if ($stmt->execute()) {
        echo "Producto actualizado con éxito";
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }

    $stmt->close();
}
?>

<!-- Formulario HTML para actualizar el producto -->
<form method="POST" action="">
    <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">

    <label for="nombre_producto">Nombre del Producto:</label>
    <input type="text" name="nombre_producto" value="<?php echo $producto['nombre_producto']; ?>" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required><?php echo $producto['descripcion']; ?></textarea><br>

    <label for="tipo_torta">Tipo de Torta:</label>
    <select name="tipo_torta" required>
        <option value="entera" <?php echo ($producto['tipo_torta'] == 'entera') ? 'selected' : ''; ?>>Entera</option>
        <option value="mediana" <?php echo ($producto['tipo_torta'] == 'mediana') ? 'selected' : ''; ?>>Mediana</option>
        <option value="porción" <?php echo ($producto['tipo_torta'] == 'porción') ? 'selected' : ''; ?>>Porción</option>
    </select><br>

    <label for="precio">Precio:</label>
    <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required><br>

    <label for="disponible">Disponible:</label>
    <input type="checkbox" name="disponible" value="1" <?php echo ($producto['disponible']) ? 'checked' : ''; ?>><br>

    <input type="submit" value="Actualizar Producto">
</form>