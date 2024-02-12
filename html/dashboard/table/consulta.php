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

// Consulta SQL para obtener los datos de la tabla
$sql = "SELECT  EXISTENCIA_EN_INVENTARIO, VALOR_TOTAL, VALOR_INV_AUDITORIA FROM bodega-30rp";

// Ejecutar la consulta
$result = $conn->query($sql);

// Obtener los resultados como un array asociativo
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Devolver los resultados como JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión
$conn->close();
?>
