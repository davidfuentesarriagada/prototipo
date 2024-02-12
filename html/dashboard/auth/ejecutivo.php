<?php
session_start(); // Iniciar sesión (asegúrate de tener esto en la parte superior del archivo)
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION['rol'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión (login.html)
    header("Location: login.html");
    exit();
}

// Obtener el nombre del usuario desde las variables de sesión de PHP
$nombreUsuario = $_SESSION['usuario'];

// Si el usuario tiene el rol de administrador o ejecutivo, mostrar el contenido de la página
if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'ejecutivo') {
    // Aquí puedes incluir el contenido que debe estar disponible tanto para administradores como para ejecutivos
    echo '<script>alert("Bienvenido, ' . $nombreUsuario . '. Aquí puedes realizar tareas de administración y ejecutivas.");</script>';
    echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 1000);</script>";
} else {
    // Si el usuario no tiene permiso, mostrar un mensaje de alerta y redirigir a index.php
    echo '<script>alert("Acceso denegado. No tienes permiso para acceder a esta página.");</script>';
    echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 1000);</script>";
}
?>
