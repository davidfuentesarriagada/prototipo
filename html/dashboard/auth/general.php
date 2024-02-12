<?php
session_start(); // Iniciar sesión (asegúrate de tener esto en la parte superior del archivo)
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION['rol'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión (login.html)
    header("Location: login.html");
    exit();
}

if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'general')) {
    // Si el usuario no tiene el rol de administrador ni el rol de general, mostrar un mensaje de acceso denegado
    echo '<h1>Acceso denegado</h1>';
    echo '<p>No tienes permiso para acceder a esta página.</p>';
    echo '<p><a href="index.php">Volver a la página de inicio</a></p>';
    exit(); // Salir del script para evitar que el contenido de la página se muestre después del mensaje de acceso denegado
}

// Obtener el nombre del usuario desde las variables de sesión de PHP
$nombreUsuario = $_SESSION['usuario']; // Corregido para usar $_SESSION['usuario']

// Mostrar un mensaje de bienvenida en un alert
echo '<script>alert("Bienvenido, ' . $nombreUsuario . '.\nAquí puedes realizar tareas de administración y generales.");</script>';

// Redireccionar a otra página después de mostrar el mensaje de bienvenida
echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 1000);</script>";
?>
