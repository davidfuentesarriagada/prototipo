<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $idUsuario = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $numero_telefonico = $_POST['numero_telefonico'];
    $contraseña = $_POST['contraseña']; // Cambié el nombre de la variable para que coincida con el formulario
    $rol = $_POST['rol'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $edad = $_POST['edad'];

    $servername = "localhost";
    $username = "root";
    $password_bd = "";
    $database = "prototipo";

    $conn = new mysqli($servername, $username, $password_bd, $database);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta SQL para actualizar los datos del usuario
    $query = "UPDATE usuarios SET 
        nombres = ?, 
        apellidos = ?, 
        email = ?, 
        numero_telefonico = ?, 
        contraseña = ?, 
        rol = ?, 
        imagen_perfil = ?, 
        fecha_nacimiento = ?, 
        direccion = ?, 
        edad = ? 
        WHERE id = ?";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Enlaza los parámetros de la consulta con los valores del formulario
    $stmt->bind_param(
        "ssssssssssi",
        $nombres,
        $apellidos,
        $email,
        $numero_telefonico,
        $contraseña, // Utilizo el nombre corregido aquí
        $rol,
        $imagen_perfil,
        $fecha_nacimiento,
        $dirección,
        $edad,
        $idUsuario
    );

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Éxito al modificar el usuario
        echo '<div class="alert alert-success" role="alert">Usuario modificado exitosamente</div>';
    } else {
        // Error al modificar el usuario
        echo '<div class="alert alert-danger" role="alert">Error al modificar el usuario: ' . $stmt->error . '</div>';
    }

    $stmt->close();

    // No es necesario redirigir aquí, el mensaje se muestra en la misma página.
}
?>
