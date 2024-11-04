<?php

$sql = "SELECT * FROM Pedido";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id_pedido'] . "</td>
                <td>" . $row['id_pedido'] . "</td>
                <td>" . $row['fecha_pedido'] . "</td>
                <td>" . $row['monto_total'] . "</td>
                <td>" . $row['estado'] . "</td>
                <td>" . $row['estado'] . "</td>
                <td>
                    <a href='update_pedido.php?id=" . $row['id_pedido'] . "'>Editar</a> |
                    <a href='delete_pedido.php?id=" . $row['id_pedido'] . "'>Eliminar</a>
                </td>
              </tr>";
    }
} else {
    echo "No hay pedidos disponibles";
}