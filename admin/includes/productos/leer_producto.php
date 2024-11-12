<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM producto WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
}