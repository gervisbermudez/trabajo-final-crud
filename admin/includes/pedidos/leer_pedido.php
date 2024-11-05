<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Realiza un JOIN para obtener información del cliente junto con el pedido
    $sql = "SELECT pedido.*, clientes.*
            FROM pedido
            JOIN clientes ON pedido.id_cliente = clientes.id_cliente
            WHERE pedido.id_pedido = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pedido = $result->fetch_assoc();

    // Obtener productos asociados al pedido
    $sqlProductos = "SELECT detalle_producto.*, producto.*
                     FROM detalle_producto
                     JOIN producto ON detalle_producto.id_producto = producto.id_producto
                     WHERE detalle_producto.id_pedido = ?";

    $stmtProductos = $conn->prepare($sqlProductos);
    $stmtProductos->bind_param("i", $id);
    $stmtProductos->execute();
    $resultProductos = $stmtProductos->get_result();
    $productos = $resultProductos->fetch_all(MYSQLI_ASSOC);

}