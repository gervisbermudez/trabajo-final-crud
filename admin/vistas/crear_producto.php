<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $tipo_torta = $_POST['tipo_torta']; // 'entera', 'mediana', 'porción'
    $precio = $_POST['precio'];
    $disponible = isset($_POST['disponible']) ? 1 : 0; // Checkbox para disponibilidad

    $sql = "INSERT INTO Producto (nombre_producto, descripcion, tipo_torta, precio, disponible) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $nombre_producto, $descripcion, $tipo_torta, $precio, $disponible); // "sssdi" string, string, string, decimal, integer

    if ($stmt->execute()) {
        echo "Producto creado con éxito";
    } else {
        echo "Error al crear producto: " . $conn->error;
    }

    $stmt->close();
}
?>

<!-- Formulario HTML para crear un producto -->
<form method="POST" action="">
    <label for="nombre_producto">Nombre del Producto:</label>
    <input type="text" name="nombre_producto" required><br>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea><br>

    <label for="tipo_torta">Tipo de Torta:</label>
    <select name="tipo_torta" required>
        <option value="entera">Entera</option>
        <option value="mediana">Mediana</option>
        <option value="porción">Porción</option>
    </select><br>

    <label for="precio">Precio:</label>
    <input type="number" step="0.01" name="precio" required><br>

    <label for="disponible">Disponible:</label>
    <input type="checkbox" name="disponible" value="1"><br>

    <input type="submit" value="Crear Producto">
</form>