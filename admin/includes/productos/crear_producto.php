<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $rootPath = $_SERVER['DOCUMENT_ROOT'];

        $uploadDir = __DIR__ . '/../../../public/img/uploads/';

        // Verifica que el directorio exista, si no, créalo
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Crea el directorio con permisos de escritura recursivos
        }

        // Genera un nuevo nombre de archivo único
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid('img_', true) . '.' . $extension;

        // Construye la ruta completa para el archivo a guardar
        $targetFilePath = $uploadDir . $newFileName;
        $relativePath = '/public/img/uploads/' . $newFileName;

        // Mueve el archivo al directorio de destino
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetFilePath)) {
            // echo "Imagen subida con éxito.";
            // Guarda $targetFilePath en la base de datos como el path de la imagen
            $nombre_producto = $_POST['nombre_producto'];
            $descripcion = $_POST['descripcion'];
            $tipo_torta = $_POST['tipo_torta']; // 'entera', 'mediana', 'porción'
            $precio = $_POST['precio'];
            $disponible = isset($_POST['disponible']) ? 1 : 0; // Checkbox para disponibilidad

            $sql = "INSERT INTO producto (nombre_producto, descripcion, tipo_torta, precio, disponible, imagen) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssdis", $nombre_producto, $descripcion, $tipo_torta, $precio, $disponible, $relativePath); // "sssdi" string, string, string, decimal, integer

            if ($stmt->execute()) {
                $mensaje = "Producto creado con éxito";
            } else {
                $mensaje = "Error al crear producto: " . $conn->error;
            }

            $stmt->close();
        }
    }

}