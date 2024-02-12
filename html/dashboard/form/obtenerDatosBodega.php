<?php
// obtenerDatosBodega.php
header('Content-Type: application/json');

// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prototipo";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validar y sanear el input
    $nombreBodega = isset($_POST['bodega']) ? $_POST['bodega'] : '';

    // Realizar la consulta para obtener las sumatorias
    // Nota: Asegúrate de que los nombres de las columnas y tablas sean correctos
    $sql = "SELECT 
                SUM(Valor_Total) AS suma_valor_total,
                SUM(Existencia_en_Inventario) AS suma_existencia, 
                SUM(Valor_INV_Auditoria) AS suma_valor_auditoria
            FROM " . $nombreBodega; // Asegúrate de que esta concatenación sea segura

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($resultado);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$conn = null;
?>
