<?php
// Verifica si el administrador ha iniciado sesión, aquí puedes agregar tu lógica de sesión
session_start();

// Si no hay sesión de administrador activa, redirige a una página de login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: /admin/login.php');
    exit;
}

$title = "Wonderlan | Clientes";

include '../includes/config.php';
include '../includes/pedidos/crear_pedido.php';

// Obtener lista de clientes
$sqlClientes = "SELECT * FROM Cliente";
$resultClientes = $conn->query($sqlClientes);

// Obtener lista de productos
$sqlProductos = "SELECT * FROM Producto";
$resultProductos = $conn->query($sqlProductos);
?>

<!DOCTYPE html>
<html lang="en">
<?php
include "../includes/head.php";
?>

<body class="sb-nav-fixed">
    <?php include "../includes/nav.php";?>
    <div id="layoutSidenav">
        <?php include "../includes/sidemenu.php";?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pedidos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Administrar Pedidos</li>
                    </ol>
                    <?php if (isset($mensaje)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?=$mensaje?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-users"></i>
                            Agregar Pedido
                        </div>
                        <div class="card-body">
                            <!-- Formulario para crear un cliente -->
                            <form method="POST" action="" class="p-2">
                                <div class="form-group mb-3">
                                    <label for="id_cliente">Cliente</label>
                                    <select class="form-control" name="id_cliente" id="id_cliente">
                                        <option>Seleccione</option>
                                        <?php
                                        if ($resultClientes && $resultClientes->num_rows > 0) {
                                            while ($row = $resultClientes->fetch_assoc()) {
                                                echo "<option value='" . $row["id_cliente"] . "'>" . $row["nombre"] . " " . $row["apellido"] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <!-- Selección de productos y cantidades -->
                                <div id="productos-container">
                                    <div class="form-group mb-3 producto-item d-flex align-items-end">
                                        <div class="flex-grow-1 me-2">
                                            <label for="producto">Producto</label>
                                            <select class="form-control" name="productos[]" required>
                                                <option value="">Seleccione un producto</option>
                                                <?php
                                                    foreach ($resultProductos as $producto) {
                                                        echo "<option value='" . $producto["id_producto"] . "'>" . $producto["nombre_producto"] . " (" . $producto["tipo_torta"] . ")" . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div style="width: 120px;">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="number" name="cantidades[]" class="form-control" min="1" required>
                                        </div>
                                        <button type="button" class="btn btn-danger remove-producto ms-2">Eliminar</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mb-3" id="agregar-producto">Agregar otro producto</button>

                                <div class="form-group mb-3">
                                    <label for="metodo_pago">Metodo de Pago:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="metodo_pago" value="efectivo" id="metodo_pago1">
                                        <label class="form-check-label" for="metodo_pago1">Efectivo</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="metodo_pago" value="tarjeta" id="metodo_pago2">
                                        <label class="form-check-label" for="metodo_pago2">Tarjeta</label>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="estado">Estado:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" value="pendiente" id="estado1">
                                        <label class="form-check-label" for="estado1">Pendiente</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" value="completado" id="estado2">
                                        <label class="form-check-label" for="estado2">Completado</label>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="direccion_envio">Dirección:</label>
                                    <textarea class="form-control" name="direccion_envio" id="direccion_envio"></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="contacto">Contacto:</label>
                                    <input type="text" class="form-control" name="contacto" id="contacto">
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked name="delivery">
                                    <label class="form-check-label" for="flexCheckChecked">Delivery</label>
                                </div>

                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" id="crear_pedido" class="btn btn-primary">Crear Pedido</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="pedidos.php" class="btn btn-secondary">Volver a la Lista</a>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Wonderlan 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <?php include "../includes/scripts.php";?>

    <script>
        document.getElementById('agregar-producto').addEventListener('click', function() {
            let productoContainer = document.createElement('div');
            productoContainer.classList.add('form-group', 'mb-3', 'producto-item', 'd-flex', 'align-items-end');

            productoContainer.innerHTML = `
                <div class="flex-grow-1 me-2">
                    <label for="producto">Producto</label>
                    <select class="form-control" name="productos[]" required>
                        <option value="">Seleccione un producto</option>
                        <?php
                        foreach ($resultProductos as $producto) {
                            echo "<option value='" . $producto["id_producto"] . "'>" . $producto["nombre_producto"] . " (" . $producto["tipo_torta"] . ")" . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div style="width: 120px;">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidades[]" class="form-control" min="1" required>
                </div>
                <button type="button" class="btn btn-danger ms-2 remove-producto">Eliminar</button>
            `;

            document.getElementById('productos-container').appendChild(productoContainer);
        });

        // Evento para eliminar un producto
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-producto')) {
                e.target.parentElement.remove();
            }
        });

    </script>

</body>
</html>
