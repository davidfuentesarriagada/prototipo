<?php
// datos_producto.php

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prototipo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del producto de la solicitud GET
if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    // Preparar la consulta SQL para obtener los datos del producto
    $sql = "SELECT * FROM `repuestos2` WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("i", $idProducto);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el producto
    if ($result->num_rows > 0) {
        // Obtener los datos del producto y enviar en formato JSON
        $producto = $result->fetch_assoc();
        echo json_encode($producto);
    } else {
        // Enviar un mensaje de error si el producto no se encuentra
        echo json_encode(array("error" => "Producto no encontrado"));
    }

    // Cerrar sentencia
    $stmt->close();
} else {
    // Enviar un mensaje de error si no se proporciona el ID del producto
    echo json_encode(array("error" => "ID del producto no especificado"));
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
