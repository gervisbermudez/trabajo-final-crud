<?php
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row['id_cliente'] . "</td>
        <td>" . $row['nombre'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['telefono'] . "</td>
        <td>" . $row['direccion'] . "</td>
        <td>
        <a href='actualizar_cliente.php?id=" . $row['id_cliente'] . "'>Editar</a> |
        <a href='/admin/vistas/clientes.php?delete=true&id=" . $row['id_cliente'] . "'>Eliminar</a>
        </td>
        </tr>";
    }
}