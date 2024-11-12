<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Realiza un JOIN para obtener información del cliente junto con el pedido
    $sql = "SELECT pedido.*, cliente.*
            FROM pedido
            JOIN cliente ON pedido.id_cliente = cliente.id_cliente
            WHERE pedido.id_pedido = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pedido = $result->fetch_assoc();

    // Obtener productos asociados al pedido
    $sqlProductos = "SELECT Detalle_Pedido.*, producto.*
                     FROM Detalle_Pedido
                     JOIN producto ON Detalle_Pedido.id_producto = producto.id_producto
                     WHERE Detalle_Pedido.id_pedido = ?";

    $stmtProductos = $conn->prepare($sqlProductos);
    $stmtProductos->bind_param("i", $id);
    $stmtProductos->execute();
    $resultProductos = $stmtProductos->get_result();
    $productos = $resultProductos->fetch_all(MYSQLI_ASSOC);

}