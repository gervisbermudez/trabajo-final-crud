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
$title = "Wonderland | Productos";

include '../includes/config.php';
include '../includes/productos/leer_producto.php';

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
                    <h1 class="mt-4">Detalle de Producto</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Administrar Productos</li>
                    </ol>
                    <div class="text-right mb-3">
                        <a href="/admin/vistas/actualizar_producto.php?id=<?php echo $producto['id_producto']; ?>"
                            class="btn btn-primary btn-sm">Editar Producto <i class="fa-solid fa-pencil"></i></a>
                    </div>
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
                            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                                    src="<?php echo $producto['imagen']; ?>" alt="..."></div>
                            <div class="col-md-6">
                                <div class="small mb-1">ID: <?php echo $producto['id_producto']; ?></div>
                                <h1 class="display-5 fw-bolder"><?php echo $producto['nombre_producto']; ?></h1>
                                <div class="fs-5 mb-5">
                                    Precio:
                                    <span class="">$ <?php echo $producto['precio']; ?></span>
                                </div>
                                <p class="lead"><?php echo $producto['descripcion']; ?></p>
                                <div for="tipo_torta">Tipo de Torta: <?php echo $producto['tipo_torta']; ?></div>
                                <div class="d-flex">
                                    <?php echo ($producto['disponible']) ? 'Disponible' : 'No disponible'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mb-2">
                        <a href="productos.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>
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