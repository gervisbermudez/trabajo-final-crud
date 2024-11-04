<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $tipo_torta = $_POST['tipo_torta']; // 'entera', 'mediana', 'porción'
    $precio = $_POST['precio'];
    $disponible = isset($_POST['disponible']) ? 1 : 0; // Checkbox para disponibilidad

    $sql = "INSERT INTO producto (nombre_producto, descripcion, tipo_torta, precio, disponible) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $nombre_producto, $descripcion, $tipo_torta, $precio, $disponible); // "sssdi" string, string, string, decimal, integer

    if ($stmt->execute()) {
        $mensaje = "Producto creado con éxito";
    } else {
        $mensaje = "Error al crear producto: " . $conn->error;
    }

    $stmt->close();
}