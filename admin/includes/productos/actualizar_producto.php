<?php
$mensaje = "";
$update = isset($_GET['update']);

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
        $mensaje = "Producto actualizado con éxito";
    } else {
        $mensaje = "Error al actualizar el producto: " . $conn->error;
    }

    $stmt->close();
}