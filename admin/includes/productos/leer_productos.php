<?php
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo <<<HTML
        <tr>
            <td>{$row['id_cliente']}</td>
            <td>{$row['nombre_producto']}</td>
            <td>{$row['descripcion']}</td>
            <td>{$row['tipo_torta']}</td>
            <td>{$row['precio']}</td>
            <td>
                <a class="options" href="/admin/vistas/actualizar_cliente.php?id={$row['id_cliente']}"><i class="fa-solid fa-user-pen"></i> Editar</a> |
                <a class="options" href="/admin/vistas/clientes.php?delete=true&id={$row['id_cliente']}"><i class="fa-solid fa-trash"></i> Eliminar</a>
            </td>
        </tr>
HTML;
    }
}