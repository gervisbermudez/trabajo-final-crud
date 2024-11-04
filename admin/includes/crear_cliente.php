<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "INSERT INTO clientes (nombre, apellido, email, telefono, direccion) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $nombre, $apellido, $email, $telefono, $direccion); // string, string, string, string, string

    if ($stmt->execute()) {
        $mensaje = "Cliente creado con éxito";
    } else {
        $mensaje = "Error al crear cliente: " . $conn->error;
    }

    $stmt->close();
}
