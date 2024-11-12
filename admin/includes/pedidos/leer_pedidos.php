<?php

$sql = "SELECT * FROM pedido";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo <<<HTML
        <tr>
            <td>{$row['id_pedido']}</td>
            <td>{$row['estado']}</td>
            <td>{$row['fecha_pedido']}</td>
            <td>{$row['direccion_envio']}</td>
            <td>{$row['monto_total']}</td>
            <td>
                <div class="btn-group">
                <a href="pedido_detalle.php?id={$row['id_pedido']}" class="btn btn-primary ">Detalles del Pedido</a> <!-- Reemplaza con la ruta correspondiente -->
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/admin/vistas/actualizar_pedido.php?id={$row['id_pedido']}">Editar</a></li>
                    <li><a class="dropdown-item" href="/admin/vistas/pedidos.php?delete=true&id={$row['id_pedido']}">Eliminar</a></li>
                </ul>
                </div>
            </td>
        </tr>
HTML;
    }
}