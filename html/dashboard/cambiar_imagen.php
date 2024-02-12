<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
        echo "ID de usuario no definido en la sesión.";
        exit();
    }

    $id_usuario = $_SESSION['id'];

    // Directorio donde se guardarán las imágenes de perfil
    $directorioDestino = "prototipo/html/assets/images/fotos/";

    // Obtener información sobre el archivo subido
    $nombreArchivo = $_FILES['nuevaImagen']['name'];
    $tipoArchivo = $_FILES['nuevaImagen']['type'];
    $tamanioArchivo = $_FILES['nuevaImagen']['size'];
    $archivoTemporal = $_FILES['nuevaImagen']['tmp_name'];

    // Verificar si el archivo es una imagen
    if (!preg_match('/^image/', $tipoArchivo)) {
        echo "El archivo no es una imagen válida.";
        exit();
    }

    // Generar un nombre único para el archivo
    $nombreUnico = uniqid() . "_" . $nombreArchivo;
    $rutaCompleta = $directorioDestino . $nombreUnico;

    // Mover el archivo temporal al directorio de destino
    if (move_uploaded_file($archivoTemporal, $rutaCompleta)) {
        // Actualizar la ruta de la imagen en la base de datos
        $servername = "localhost";
        $username = "root";
        $password_bd = "";
        $database = "prototipo";

        $conn = new mysqli($servername, $username, $password_bd, $database);

        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        $query = "UPDATE usuarios SET imagen_perfil = '$rutaCompleta' WHERE id = $id_usuario";
        if ($conn->query($query) === TRUE) {
            $_SESSION['imagen_perfil'] = $rutaCompleta;
            echo '<script>alert("Imagen de perfil actualizada correctamente.");</script>';
            echo '<script>window.location.href = "perfil.php";</script>';
        } else {
            echo '<script>alert("Error al actualizar la imagen de perfil.");</script>';
            echo '<script>window.location.href = "perfil.php";</script>';
        }

        $conn->close();
    } else {
        echo '<script>alert("Error al subir la imagen.");</script>';
        echo '<script>window.location.href = "perfil.php";</script>';
    }
}
?>
