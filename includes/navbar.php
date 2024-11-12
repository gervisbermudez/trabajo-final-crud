<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("HTTP/1.0 403 Forbidden");
    exit("Acceso directo no permitido.");
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid align-items-center">
        <a class="navbar-brand" href="index.php">
            <img src="public/img/logo_wonderland.png" alt="logo de la web">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link" href="#Sucursales">Sucursales</a></li>
                <li class="nav-item"><a class="nav-link" href="productos.php">Tienda</a></li>
                <li class="nav-item"><a class="nav-link" href="quienes-somos.php">Quiénes somos</a></li>
                <li class="nav-item"><a class="nav-link" href="FAQ.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>

                <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_cliente'])):
    $nombre_usuario = $_SESSION['nombre'];
    ?>
	                <li class="nav-item dropdown">
	                    <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" role="button"
	                        data-bs-toggle="dropdown" aria-expanded="false">
	                        <?php echo htmlspecialchars($nombre_usuario); ?>
	                    </a>
	                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
	                        <li><a class="dropdown-item" href="perfil.php">Mi Perfil</a></li>
	                        <li>
	                            <hr class="dropdown-divider">
	                        </li>
	                        <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
	                    </ul>
	                </li>
	                <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>