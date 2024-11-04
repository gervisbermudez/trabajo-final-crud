<?php
include '../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Cliente WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Cliente eliminado con éxito";
    } else {
        echo "Error al eliminar el cliente: " . $conn->error;
    }

    $stmt->close();
}
?>