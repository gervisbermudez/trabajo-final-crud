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
$title = "Wonderland | Pedidos";

include '../includes/config.php';
include '../includes/pedidos/eliminar_pedido.php';

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
                    <?php if ($delete_message): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?=$delete_message?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif?>
                    <!-- Botón para redirigir a crear pedido -->
                    <div class="text-right mb-3">
                        <a href="crear_pedido.php" class="btn btn-primary">Agregar Pedido <i
                                class="fa-solid fa-cart-plus"></i></a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Ultimos Clientes
                        </div>
                        <div class="card-body">
                            <!-- Tabla estática de clientes -->
                            <table class="table table-striped" id="datatablesSimple">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Dirección</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include '../includes/pedidos/leer_pedidos.php';?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../includes/footer.php';?>
        </div>
    </div>
    <?php include "../includes/scripts.php";?>
</body>

</html>