<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM Pedido WHERE id_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // "i" para integer
    
    if ($stmt->execute()) {
        echo "Pedido eliminado con éxito";
    } else {
        echo "Error al eliminar el pedido: " . $conn->error;
    }

    $stmt->close();
}
?>