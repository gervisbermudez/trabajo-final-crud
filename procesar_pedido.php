<?php
// Obtener los productos y las cantidades del carrito
$productNames = $_POST['product_names'] ?? [];
$quantities = $_POST['quantities'] ?? [];
$prices = $_POST['precios'] ?? [];

// Si no hay productos, redirigir a la página anterior
if (empty($productNames) || empty($quantities)) {
    header("Location: index.php");
    exit();
}

// Calcular los subtotales y el total
$subtotals = [];
$total = 0;
for ($i = 0; $i < count($productNames); $i++) {
    $productName = $productNames[$i];
    $quantity = $quantities[$i];
    $price = $prices[$i] ?? 0;
    
    $subtotal = $quantity * $price;
    $subtotals[] = ['name' => $productName, 'quantity' => $quantity, 'price' => $price, 'subtotal' => $subtotal];

    $total += $subtotal;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Pedido</title>
    <!-- Incluye el CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Resumen de tu pedido</h1>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subtotals as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="font-weight-bold">
                <td colspan="3" class="text-right">Total</td>
                <td>$<?php echo number_format($total, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <form action="crear_pedido.php" method="POST" class="mt-4">
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">

        <div class="form-group">
            <label for="direccion_envio">Dirección:</label>
            <textarea class="form-control" name="direccion_envio" id="direccion_envio" required></textarea>
        </div>

        <div class="form-group">
            <label for="contacto">Contacto:</label>
            <input type="text" class="form-control" name="contacto" id="contacto" required>
        </div>

        <div class="form-group">
            <label for="metodo_pago">Método de Pago:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="metodo_pago" value="efectivo" id="metodo_pago1" required>
                <label class="form-check-label" for="metodo_pago1">Efectivo</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="metodo_pago" value="tarjeta" id="metodo_pago2" required>
                <label class="form-check-label" for="metodo_pago2">Tarjeta</label>
            </div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="delivery" checked>
            <label class="form-check-label" for="flexCheckChecked">¿Delivery?</label>
        </div>

        <!-- Productos y Cantidades -->
        <?php foreach ($subtotals as $index => $item): ?>
            <input type="hidden" name="productos[]" value="<?php echo $index; ?>"> <!-- Índice o id del producto -->
            <input type="hidden" name="cantidades[]" value="<?php echo $item['quantity']; ?>"> <!-- Cantidad del producto -->
        <?php endforeach; ?>

        <button type="submit" class="btn btn-primary btn-block">Confirmar Pedido</button>
    </form>
</div>

<!-- Incluye el JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
