
<?php
// Verificar si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $fecha_nacimineto = $_POST["fecha_nacimiento"];
    $edad = $_POST["edad"];
    $direccion = $_POST["direccion"];
    $numero_telefonico = $_POST["numero_telefonico"];
    $contraseña = $_POST["contraseña"];
    $rol = "usuario"; // Asigna un rol por defecto, puedes cambiarlo según tus necesidades

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "prototipo";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (nombres, apellidos, email, numero_telefonico,fecha_nacimiento, edad, direccion, contraseña, rol)
            VALUES ('$nombres', '$apellidos', '$email', '$numero_telefonico', '$fecha_nacimineto', '$edad', '$direccion', '$contraseña', '$rol')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Registro exitoso. ¡Ahora puedes iniciar sesión!");</script>';
      echo '<script>window.location.href = "http://localhost/prototipo/html/dashboard/auth/login.html";</script>';
      exit; // Salir para evitar ejecución adicional del código
  } else {
      echo '<script>alert("Error al registrar el usuario: ' . $conn->error . '");</script>';
  }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
