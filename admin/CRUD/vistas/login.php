<?php
session_start();

// Simulación de autenticación. Aquí puedes verificar contra una base de datos de usuarios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Autenticación simulada. Cambiar por validación contra la base de datos
    if ($username == 'admin' && $password == '1234') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error_message = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Panel de Administración</title>
</head>
<body>

<h1>Iniciar Sesión</h1>

<?php
if (isset($error_message)) {
    echo "<p style='color:red;'>$error_message</p>";
}
?>

<form method="POST" action="">
    <label for="username">Usuario:</label>
    <input type="text" name="username" required><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Iniciar sesión">
</form>

</body>
</html>