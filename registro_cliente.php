<?php
session_start();
session_destroy();

// Configuración de la base de datos
$host = 'localhost'; // El nombre del servidor o IP
$database = 'tienda_online'; // Nombre de la base de datos
$user = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$password = $_POST['password'];

// Hash de la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertar los datos en la base de datos
$sql = "INSERT INTO cliente (nombre, apellido, email, telefono, direccion, password)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nombre, $apellido, $email, $telefono, $direccion, $hashed_password);

if ($stmt->execute()) {
    echo "<div class='alert alert-success'>Cliente registrado exitosamente.</div>";
    session_start();
    $_SESSION['client_logged_in'] = true;
    $id_cliente = $conn->insert_id;
    $_SESSION['id_cliente'] = $id_cliente;
    $_SESSION['nombre'] = $nombre;

    header('Location: index.php');
    exit;

} else {
    echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
