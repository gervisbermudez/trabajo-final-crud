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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $monto_total = $_POST['monto_total'];
    $estado = $_POST['estado']; // 'pendiente' o 'completado'

    $sql = "INSERT INTO Pedido (monto_total, estado) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $monto_total, $estado); // "d" para decimal, "s" para string

    if ($stmt->execute()) {
        $mensaje = "Cliente creado con éxito";
    } else {
        $mensaje = "Error al crear cliente: " . $conn->error;
    }

    $stmt->close();
}

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
                                    <label for="monto_total">Monto</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" name="monto_total" step="0.01"
                                            aria-label="Monto" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="estado">Estado:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" value="pendiente"
                                            id="estado1">
                                        <label class="form-check-label" for="estado1">
                                            Pendiente
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="estado" value="completado"
                                            id="estado2">
                                        <label class="form-check-label" for="estado2">
                                            Completado
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Crear Pedido</button>
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
</body>

</html>