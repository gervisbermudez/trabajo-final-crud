<?php
include '../includes/config.php';

$sql = "SELECT * FROM Cliente";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row['id_cliente'] . "</td>
            <td>" . $row['nombre'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['telefono'] . "</td>
            <td>" . $row['direccion'] . "</td>
            <td>
                <a href='actualizar_cliente.php?id=" . $row['id_cliente'] . "'>Editar</a> |
                <a href='eliminar_cliente.php?id=" . $row['id_cliente'] . "'>Eliminar</a>
            </td>
            </tr>";
}
echo "";
?>