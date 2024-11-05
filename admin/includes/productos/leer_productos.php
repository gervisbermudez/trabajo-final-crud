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
                <!-- Example split danger button -->
                <div class="btn-group">
                <a href="producto_detalle.php?id={$row['id_producto']}" class="btn btn-primary ">Detalles del Producto</a> <!-- Reemplaza con la ruta correspondiente -->
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/admin/vistas/actualizar_producto.php?id={$row['id_producto']}">Editar</a></li>
                    <li><a class="dropdown-item" href="/admin/vistas/productos.php?delete=true&id={$row['id_producto']}">Eliminar</a></li>
                </ul>
                </div>
            </td>
        </tr>
HTML;
    }
}