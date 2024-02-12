<?php
// editar_producto.php

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
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $codigo_producto = $_POST['codigo_producto'];
    $nombre_y_detalles = $_POST['nombre_y_detalles'];
    $Existencia_en_Inventario = $_POST['Existencia_en_Inventario'];
    $valor_unidad = $_POST['valor_unidad'];
    $Valor_Total = $_POST['Valor_Total'];
    $Observaciones_UBICACION = $_POST['Observaciones_UBICACION'];
    $invent_cobra = $_POST['invent_cobra'];
    $AUDITORIA_HVJ = $_POST['AUDITORIA_HVJ'];
    $diferencia = $_POST['diferencia'];
    $valor_inv_auditoria = $_POST['valor_inv_auditoria'];

    // La consulta SQL de actualización
    $sql = "UPDATE `aceros_historicos` SET 
                `codigo_producto` = ?, 
                `nombre_y_detalles` = ?, 
                `Existencia_en_Inventario` = ?, 
                `valor_unidad` = ?, 
                `Valor_Total` = ?, 
                `Observaciones_UBICACION` = ?, 
                `invent_cobra` = ?, 
                `AUDITORIA_HVJ` = ?, 
                `diferencia` = ?, 
                `valor_inv_auditoria` = ?
            WHERE `id` = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssdddsdddii", $codigo_producto, $nombre_y_detalles, $Existencia_en_Inventario, $valor_unidad, $Valor_Total, $Observaciones_UBICACION, $invent_cobra, $AUDITORIA_HVJ, $diferencia, $valor_inv_auditoria, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Registro actualizado con éxito";
    } else {
        echo "No se pudo actualizar el registro o no hubo cambios";
    }

    $stmt->close();
} else {
    die("Método de solicitud no válido");
}

$conn->close();
?>