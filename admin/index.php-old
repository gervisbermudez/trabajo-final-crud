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

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: auto;
        overflow: hidden;
    }

    header {
        background: #333;
        color: #fff;
        padding-top: 30px;
        min-height: 70px;
        border-bottom: #ccc 3px solid;
    }

    header a {
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 16px;
    }

    ul {
        padding: 0;
        list-style: none;
    }

    ul li {
        display: inline;
        padding: 0 10px;
    }

    ul li a {
        color: white;
    }

    h1 {
        margin: 20px 0;
        font-size: 24px;
    }

    .actions {
        margin-top: 20px;
    }

    .actions a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #333;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .actions a:hover {
        background-color: #444;
    }
    </style>
</head>

<body>

    <header>
        <div class="container">
            <h1>Panel de Administración</h1>
            <ul>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </header>

    <div class="container">
        <h1>Bienvenido al Panel de Administración</h1>

        <p>Utilice los siguientes enlaces para gestionar las diferentes secciones de la tienda:</p>

        <div class="actions">
            <!-- Enlace para gestionar clientes -->
            <a href="clientes.php">Gestionar Clientes</a><br><br>

            <!-- Enlace para gestionar productos -->
            <a href="leer_producto.php">Gestionar Productos</a><br><br>

            <!-- Enlace para gestionar pedidos -->
            <a href="pedidos.php">Gestionar Pedidos</a>
        </div>
    </div>

</body>

</html>
