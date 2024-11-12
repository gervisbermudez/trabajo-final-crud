<?php
session_start();
// Configuración de la base de datos
$host = 'localhost';
$database = 'tienda_online';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consulta para obtener el usuario por correo electrónico
$sql = "SELECT id_cliente, nombre, apellido, email, password FROM cliente WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verificar la contraseña usando password_verify
    if (password_verify($password, $user['password'])) {
        // Contraseña correcta, iniciar sesión
        $_SESSION['id_cliente'] = $user['id_cliente'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['email'] = $user['email'];

        header("Location: productos.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Correo no encontrado.</div>";
}

$stmt->close();
$conn->close();
