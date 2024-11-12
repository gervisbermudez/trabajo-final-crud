<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // El nombre del servidor o IP
$db = 'tienda_online'; // Nombre de la base de datos
//TODO reemplazar por el usuario y contraseña que sean
$user = 'root'; // Usuario de la base de datos 
$pass = ''; // Contraseña de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $db);

// Comprobar si hay errores en la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$sql = "SELECT * FROM cliente";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $metodo_pago = $_POST['metodo_pago'];
    $estado = 1;
    $direccion_envio = $_POST['direccion_envio'];
    $contacto = $_POST['contacto'];
    $delivery = isset($_POST['delivery']) ? 1 : 0; // 1 si está marcado, 0 si no
    $productos = $_POST['productos'];
    $cantidades = $_POST['cantidades'];

    // Calcular el monto total
    $monto_total = 0;

    // Insertar el pedido
    $sql = "INSERT INTO pedido (id_cliente, monto_total, metodo_pago, estado, direccion_envio, contacto, delivery) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('idsssss', $id_cliente, $monto_total, $metodo_pago, $estado, $direccion_envio, $contacto, $delivery);

    if ($stmt->execute()) {
        // Obtener el ID del pedido recién insertado
        $id_pedido = $stmt->insert_id;

        // Insertar productos en DetallePedido y calcular monto total
        $sqldetalle = "INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)";
        $dstmt = $conn->prepare($sqldetalle);

        // Recorrer los productos y calcular el monto total
        foreach ($productos as $index => $id_producto) {
            $cantidad = $cantidades[$index];
            $precio_unitario = obtener_precio_producto($id_producto, $conn);

            // Sumar al monto total
            $monto_total += $precio_unitario * $cantidad;

            // Insertar detalle de pedido
            $dstmt->bind_param('iiid', $id_pedido, $id_producto, $cantidad, $precio_unitario);
            $dstmt->execute();
        }

        // Actualizar el monto total en el pedido
        $update_sql = "UPDATE pedido SET monto_total = ? WHERE id_pedido = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param('di', $monto_total, $id_pedido);
        $update_stmt->execute();
        
        $mensaje = "Pedido creado con éxito";
    } else {
        $mensaje = "Error al crear pedido: " . $conn->error;
    }

    $stmt->close();
    $dstmt->close();
}

function obtener_precio_producto($id_producto, $conn) {
    // Obtener el precio del producto desde la base de datos
    $sql = "SELECT precio FROM Producto WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_producto);
    $stmt->execute();
    $stmt->bind_result($precio_unitario);
    $stmt->fetch();
    $stmt->close();

    return $precio_unitario;
}
?>
