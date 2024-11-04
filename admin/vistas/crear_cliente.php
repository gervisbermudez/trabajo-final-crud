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

$title = "Wonderlan | Clientes";

include '../includes/config.php';
include '../includes/crear_cliente.php';

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
                    <?php if (isset($mensaje)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?=$mensaje?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-users"></i>
                            Agregar Cliente
                        </div>
                        <div class="card-body">
                            <!-- Formulario para crear un cliente -->
                            <form method="POST" action="" class="p-2">
                                <div class="form-group mb-3">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="apellido">Apellido:</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="text" class="form-control" name="telefono" id="telefono">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="direccion">Dirección:</label>
                                    <textarea class="form-control" name="direccion" id="direccion"></textarea>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Crear Cliente <i
                                                class="fa-solid fa-check"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-right mb-2">
                        <a href="clientes.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Volver
                            al listado</a>
                    </div>
                </div>
            </main>
            <?php include "../includes/footer.php";?>
        </div>
    </div>
    <?php include "../includes/scripts.php";?>
</body>

</html>