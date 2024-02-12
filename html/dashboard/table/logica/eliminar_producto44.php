<?php
// eliminar_producto.php

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

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // La consulta SQL de eliminación
    $sql = "DELETE FROM `servicios_hidraulicos2` WHERE `id` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Producto eliminado con éxito";
    } else {
        echo "No se pudo eliminar el producto o no se encontró";
    }

    $stmt->close();
} else {
    die("Método de solicitud no válido");
}

$conn->close();
?>
