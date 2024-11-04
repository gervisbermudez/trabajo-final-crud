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

$title = "Wonderland | Clientes";

include '../includes/config.php';
include "../includes/eliminar_cliente.php";

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
                    <h1 class="mt-4">Clientes</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Administrar Clientes</li>
                    </ol>
                    <?php if (isset($delete_message) && $delete_message): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?=$delete_message?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif?>
                    <div class="text-right mb-3">
                        <a href="crear_cliente.php" class="btn btn-primary btn-sm">Agregar Cliente <i
                                class="fa-solid fa-plus"></i></a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-users"></i>
                            Listado de Clientes
                        </div>
                        <div class="card-body">
                            <!-- Tabla estática de clientes -->
                            <table id="datatablesSimple">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include '../includes/leer_cliente.php';?>
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