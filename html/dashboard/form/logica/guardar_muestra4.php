<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de la conexión a la base de datos (debes completar con tus propios valores)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "prototipo";

    // Obtener los valores del formulario
    $unidadesSeleccionadasAdm = $_POST["unidadesSeleccionadasAdm"];
    $unidadesSeleccionadasAuditoria = $_POST["unidadesSeleccionadasAuditoria"];
    $unidadesNoSeleccionadas = $_POST["unidadesNoSeleccionadas"];

    // Crear una conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Sentencia SQL para insertar los valores en la tabla
    $sql = "INSERT INTO unidad_de_muestras4 (unidades_seleccionadas_adm, unidades_seleccionadas_auditoria, unidades_no_seleccionadas) 
            VALUES ('$unidadesSeleccionadasAdm', '$unidadesSeleccionadasAuditoria', '$unidadesNoSeleccionadas')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Muestra guardada correctamente."); window.location.href = "http://localhost/prototipo/html/dashboard/table/BODEGA-35-AUTOMAT.php";</script>';
    } else {
        echo '<script>alert("Error al guardar la muestra: ' . $conn->error . '");</script>';
    }


    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
