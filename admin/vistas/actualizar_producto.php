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

$title = "Wonderland | Productos";

include '../includes/config.php';

include '../includes/productos/leer_producto.php';

include "../includes/productos/actualizar_producto.php";

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
                    <h1 class="mt-4">Productos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Administrar Productos</li>
                    </ol>
                    <?php if (isset($mensaje) && $mensaje): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?=$mensaje?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-users"></i>
                            Actualizar Producto
                        </div>
                        <div class="card-body">
                            <form method="POST" action="" class="p-2" enctype="multipart/form-data">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">

                                <div class="form-group mb-3">
                                    <label for="nombre_producto">Nombre del Producto:</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $producto['nombre_producto']; ?>" name="nombre_producto"
                                        id="nombre_producto" required>
                                </div>

                                <div class="mb-3">
                                    <img id="preview" src="#" alt="Vista previa de la imagen"
                                        style="display: none; margin-top: 10px; max-width: 100%; height: auto;" />
                                    <label for="formFile" class="form-label">Fotografia del Producto:</label>
                                    <input class="form-control" type="file" id="formFile" onchange="previewImage(event)"
                                        name="imagen" accept="image/*">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="descripcion">Descripción:</label>
                                    <textarea class="form-control" name="descripcion"
                                        id="descripcion"><?php echo $producto['descripcion']; ?></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tipo_torta">Tipo de Torta:</label>
                                    <select name="tipo_torta" required class="form-select">
                                        <option value="entera"
                                            <?php echo ($producto['tipo_torta'] == 'entera') ? 'selected' : ''; ?>>
                                            Entera</option>
                                        <option value="mediana"
                                            <?php echo ($producto['tipo_torta'] == 'mediana') ? 'selected' : ''; ?>>
                                            Mediana</option>
                                        <option value="porción"
                                            <?php echo ($producto['tipo_torta'] == 'porción') ? 'selected' : ''; ?>>
                                            Porción</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="precio">Precio:</label>
                                    <input type="number" class="form-control" value="<?php echo $producto['precio']; ?>"
                                        step="0.01" name="precio" required>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="disponible"
                                            name="disponible" value="1"
                                            <?php echo ($producto['disponible']) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="disponible">
                                            Disponible
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Actualizar Producto <i
                                                class="fa-solid fa-check"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-right mb-2">
                        <a href="productos.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>
                            Volver
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