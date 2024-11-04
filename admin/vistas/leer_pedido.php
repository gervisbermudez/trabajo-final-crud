<?php
include '../includes/config.php';

$sql = "SELECT * FROM Pedido";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID Pedido</th>
                <th>Fecha</th>
                <th>Monto Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id_pedido'] . "</td>
                <td>" . $row['fecha_pedido'] . "</td>
                <td>" . $row['monto_total'] . "</td>
                <td>" . $row['estado'] . "</td>
                <td>
                    <a href='update_pedido.php?id=" . $row['id_pedido'] . "'>Editar</a> |
                    <a href='delete_pedido.php?id=" . $row['id_pedido'] . "'>Eliminar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay pedidos disponibles";
}
?>