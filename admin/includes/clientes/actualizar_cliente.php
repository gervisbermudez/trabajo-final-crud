<?php
$mensaje = "";
$update = isset($_GET['update']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $update) {
    $id = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "UPDATE cliente SET nombre = ?, apellido = ?, email = ?, telefono = ?, direccion = ? WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $email, $telefono, $direccion, $id);

    if ($stmt->execute()) {
        $mensaje = "Cliente actualizado con éxito";
    } else {
        $mensaje = "Error al actualizar el cliente: " . $conn->error;
    }

    $stmt->close();
}