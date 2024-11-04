<?php
include '../includes/config.php';

$sql = "SELECT * FROM Producto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo de Torta</th>
                <th>Precio</th>
                <th>Disponible</th>
                <th>Acciones</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id_producto'] . "</td>
                <td>" . $row['nombre_producto'] . "</td>
                <td>" . $row['descripcion'] . "</td>
                <td>" . $row['tipo_torta'] . "</td>
                <td>" . $row['precio'] . "</td>
                <td>" . ($row['disponible'] ? 'Sí' : 'No') . "</td>
                <td>
                    <a href='update_producto.php?id=" . $row['id_producto'] . "'>Editar</a> |
                    <a href='delete_producto.php?id=" . $row['id_producto'] . "'>Eliminar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay productos disponibles.";
}
?>