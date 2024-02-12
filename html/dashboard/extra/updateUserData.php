<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prototipo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if(isset($_POST['id'])) {
    // Recoger los datos del formulario
    $userId = $_POST['id'];
    $nombres = $_POST['nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $email = $_POST['email'] ?? '';
    $numero_telefonico = $_POST['numero_telefonico'] ?? '';
    $rol = $_POST['rol'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $edad = $_POST['edad'] ?? '';

    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para actualizar los datos
    $stmt = $conn->prepare("UPDATE usuarios SET nombres = ?, apellidos = ?, email = ?, numero_telefonico = ?, rol = ?, fecha_nacimiento = ?, direccion = ?, edad = ? WHERE id = ?");
    $stmt->bind_param("sssssssii", $nombres, $apellidos, $email, $numero_telefonico, $rol, $fecha_nacimiento, $direccion, $edad, $userId);

    // Ejecutar la consulta
    if($stmt->execute()) {
        echo "Datos actualizados con éxito";
    } else {
        echo "Error al actualizar los datos";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>