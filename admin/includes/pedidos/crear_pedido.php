<?php

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $monto_total = $_POST['monto_total'];
    $metodo_pago = $_POST['metodo_pago'];
    $estado = $_POST['estado'];
    $direccion_envio = $_POST['direccion_envio'];
    $contacto = $_POST['contacto'];
    $delivery = isset($_POST['delivery']) ? 1 : 0; // 1 si está marcado, 0 si no

// Prepare the SQL statement
    $sql = "INSERT INTO pedido (id_cliente, monto_total, metodo_pago, estado, direccion_envio, contacto, delivery) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

// Bind the parameters
    $stmt->bind_param('idsssss', $id_cliente, $monto_total, $metodo_pago, $estado, $direccion_envio, $contacto, $delivery);

    if ($stmt->execute()) {
        $mensaje = "Cliente creado con éxito";
    } else {
        $mensaje = "Error al crear cliente: " . $conn->error;
    }

    $stmt->close();
}