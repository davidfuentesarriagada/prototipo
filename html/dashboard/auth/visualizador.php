<?php
session_start();

if (!isset($_SESSION['rol'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión (login.html)
    header("Location: login.html");
    exit();
}

if ($_SESSION['rol'] !== 'visualizador') {
    // Si el usuario no tiene el rol de visualizador, redirigirlo a otra página (por ejemplo, acceso_denegado.html)
    header("Location: acceso_denegado.html");
    exit();
}

// Obtener el nombre del usuario desde las variables de sesión de PHP
$nombreUsuario = $_SESSION['nombres']; // Corregido para usar $_SESSION['usuario']

// Mostrar el mensaje de bienvenida con el nombre del usuario usando JavaScript
echo '<script>alert("Bienvenido, ' . $nombreUsuario . '. Aquí puedes realizar tareas de visualización.");</script>';

// Redireccionar a index.php después de 1 segundo
echo "<script>setTimeout(function() { window.location.href = 'http://localhost/prototipo/html/dashboard/index.php'; }, 1000);</script>";
?>

