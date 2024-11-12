<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // El nombre del servidor o IP
$db = 'tienda_online'; // Nombre de la base de datos
//TODO reemplazar por el usuario y contraseña que sean
$user = 'root'; // Usuario de la base de datos 
$pass = ''; // Contraseña de la base de datos

// Crear la conexión
$conn = new mysqli($host, $user, $pass, $db);

// Comprobar si hay errores en la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

?>