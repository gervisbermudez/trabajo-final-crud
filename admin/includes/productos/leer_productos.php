<?php
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $disponible = $row['disponible'] === "1" ? "Sí" : "No";

        echo <<<HTML
        <tr>
            <td>{$row['id_producto']}</td>
            <td>{$row['nombre_producto']}</td>
            <td>{$row['descripcion']}</td>
            <td>{$row['tipo_torta']}</td>
            <td>{$row['precio']}</td>
            <td>{$disponible}</td>
            <td>
                <a class="options" href="/admin/vistas/actualizar_producto.php?id={$row['id_producto']}"><i class="fa-solid fa-user-pen"></i> Editar</a> |
                <a class="options" href="/admin/vistas/productos.php?delete=true&id={$row['id_producto']}"><i class="fa-solid fa-trash"></i> Eliminar</a>
            </td>
        </tr>
HTML;
    }
}