<?php

$delete_message = "";

if (isset($_GET['id']) && $delete) {
    $id = $_GET['id'];

    $sql = "DELETE FROM pedido WHERE id_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "i" para integer

    if ($stmt->execute()) {
        $delete_message = "Pedido eliminado con éxito";
    } else {
        $delete_message = "Error al eliminar el pedido: " . $conn->error;
    }

    $stmt->close();
}