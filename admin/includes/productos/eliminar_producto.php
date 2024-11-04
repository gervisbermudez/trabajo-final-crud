<?php
$delete_message = "";
$delete = $_GET && $_GET['delete'];

// Eliminar cliente
if (isset($_GET['id']) && $delete) {

    $id = $_GET['id'];

    // Verificar si el cliente existe
    $check_sql = "SELECT id_cliente FROM clientes WHERE id_cliente = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // El cliente existe, proceder a eliminar
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $delete_message = "Cliente eliminado con éxito";
        } else {
            $delete_message = "Error al eliminar el cliente: " . $conn->error;
        }
        $stmt->close();
    }

    $check_stmt->close();
}