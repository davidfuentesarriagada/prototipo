<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prototipo";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Recuperar los datos del formulario
$codigo_producto = $_POST['codigo_producto'] ?? '';
$nombre_y_detalles = $_POST['nombre_y_detalles'] ?? '';
$existencia_en_inventario = isset($_POST['existencia_en_inventario']) ? intval($_POST['existencia_en_inventario']) : 0;
$valor_unidad = isset($_POST['valor_unidad']) ? floatval($_POST['valor_unidad']) : 0.0;

// Agregar los campos faltantes
$invent_cobra = isset($_POST['invent_cobra']) ? floatval($_POST['invent_cobra']) : 0;
$auditoria_hvj = isset($_POST['auditoria_hvj']) ? floatval($_POST['auditoria_hvj']) : 0;

// Calcular el valor total
$valor_total = round($existencia_en_inventario * $valor_unidad, 2);
$diferencia = round((floatval($_POST['invent_cobra']) ?? 0.0) - (floatval($_POST['auditoria_hvj']) ?? 0.0), 2);

$valor_inv_auditoria = round($valor_unidad * $auditoria_hvj);
$observaciones_ubicacion = $_POST['observaciones_ubicacion'];


$valor_total_formateado = number_format($valor_total, 2, ',', '.');
$valor_inv_auditoria_formateado = number_format($valor_inv_auditoria, 2, ',', '.');

// Consulta SQL para insertar los datos en la tabla
$sql = "INSERT INTO `bodega-3rp` (codigo_producto, nombre_y_detalles, existencia_en_inventario, valor_unidad, valor_total, valor_inv_auditoria, observaciones_ubicacion, `invent_cobra`, `AUDITORIA HVJ`, DIFERENCIA)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la consulta
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la consulta: " . $conn->error);
}

// Vincular los parámetros y ejecutar la consulta
$stmt->bind_param("ssiidssssd", $codigo_producto, $nombre_y_detalles, $existencia_en_inventario, $valor_unidad, $valor_total, $valor_inv_auditoria, $observaciones_ubicacion, $invent_cobra, $auditoria_hvj, $diferencia);

if ($stmt->execute()) {
    // Inserción exitosa
    echo '<script>alert("Los datos se han insertado correctamente en la base de datos.");</script>';
    echo "<script>setTimeout(function() { window.location.href = 'http://localhost/prototipo/html/dashboard/table/table-data.php'; }, 2000);</script>";
} else {
    // Error en la inserción
    echo '<script>alert("Error al insertar datos en la base de datos: ' . $stmt->error . '");</script>';
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$conn->close();
?>
