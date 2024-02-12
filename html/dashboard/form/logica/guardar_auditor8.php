<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de la conexión a la base de datos (debes completar con tus propios valores)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "prototipo";

    // Obtener los valores del formulario
    $hechoPor = $_POST["hecho_por"];
    $fecha = $_POST["fecha"];
    $revisadoPor = $_POST["revisado_por"];
    $fechaRevision = $_POST["fecha_revision"];
    $bodega = $_POST["bodega"];

    // Crear una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Sentencia SQL para insertar los valores en la tabla "auditores"
    $sql = "INSERT INTO auditores (Hecho_por, Fecha, Revisado_por, Fecha_revision, bodega) 
            VALUES ('$hechoPor', '$fecha', '$revisadoPor', '$fechaRevision', '$bodega')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Auditor guardado correctamente."); window.location.href = "http://localhost/prototipo/html/dashboard/table/BODEGA-10-SERV-HID.php";</script>';
    } else {
        echo '<script>alert("Error al guardar el auditor: ' . $conn->error . '"); window.location.href = "http://localhost/prototipo/html/dashboard/table/BODEGA-10-SERV-HID.php";</script>';
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
