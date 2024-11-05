<?php
// Verifica si el administrador ha iniciado sesión, aquí puedes agregar tu lógica de sesión
session_start();

// Si no hay sesión de administrador activa, redirige a una página de login
// Aquí puedes implementar una página de inicio de sesión y gestionar sesiones de administrador.
// Ejemplo: si no hay sesión activa, redirigiría a "login.php"
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ./login.php');
    exit;
}

// titulo de la pagina
$title = "Wonderland | Pedido";

include '../includes/config.php';
include '../includes/pedidos/leer_pedido.php';

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
                    <h1 class="mt-4">Detalle de Pedido</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Administrar Pedido</li>
                    </ol>
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5">
                            <div class="col-sm-6">
                                <div class="small mb-1">Pedido ID: <?php echo $pedido['id_pedido']; ?></div>
                                <h1 class="display-5 fw-bolder">
                                    <?php echo $pedido['nombre'] . ' ' . $pedido['apellido']; ?></h1>
                                <div class="fs-5 mb-1">
                                    <div><strong>Monto:</strong></div>
                                    <span class="">$ <?php echo $pedido['monto_total']; ?></span>
                                </div>
                                <div class="fs-5 mb-1">
                                    <div><strong>Estado:</strong></div>
                                    <span class=""> <?php echo $pedido['estado']; ?></span>
                                </div>

                                <div class="fs-5 mb-1">
                                    <div><strong>Metodo de Pago:</strong></div>
                                    <span class=""><?php echo $pedido['metodo_pago']; ?></span>
                                </div>
                                <div class="fs-5 mb-1">
                                    <div><strong>Delivery:</strong></div>
                                    <span class=""><?php echo $pedido['direccion_envio']; ?></span>
                                </div>

                                <div class="fs-5 mb-1">
                                    <div><strong>Direccion de Envio:</strong></div>
                                    <span class=""><?php echo $pedido['direccion_envio']; ?></span>
                                </div>

                                <div class="fs-5 mb-1">
                                    <div><strong>Contacto:</strong></div>
                                    <span class=""><?php echo $pedido['contacto']; ?></span>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <h2>Productos del Pedido:</h2>
                                <?php if (!empty($productos)): ?>
                                <div class="list-group mt-3">
                                    <?php foreach ($productos as $producto): ?>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"><?=htmlspecialchars($producto['nombre_producto'])?></h5>
                                            <small>Precio: $<?=number_format($producto['precio'], 2)?></small>
                                        </div>
                                        <p class="mb-1"><?=htmlspecialchars($producto['descripcion'])?></p>
                                        <small>Cantidad: <?=htmlspecialchars($producto['cantidad'])?></small>
                                    </a>
                                    <?php endforeach;?>
                                </div>
                                <?php else: ?>
                                <div class="alert alert-warning" role="alert">
                                    No hay productos asociados a este pedido.
                                </div>
                                <?php endif;?>

                            </div>
                        </div>
                    </div>
                    <div class="text-right mb-2">
                        <a href="pedidos.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>
                            Volver
                            al listado</a>
                    </div>
                </div>
            </main>
            <?php include '../includes/footer.php';?>
        </div>
    </div>
    <?php include "../includes/scripts.php";?>
</body>

</html>