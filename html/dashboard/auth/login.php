<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $password_bd = "";
    $database = "prototipo";

    $conn = new mysqli($servername, $username, $password_bd, $database);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Preparar la consulta con una sentencia preparada para evitar la inyección SQL
    $query = "SELECT * FROM usuarios WHERE email = ? AND contraseña = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Usuario y contraseña válidos, obtener los datos del usuario
        $row = $result->fetch_assoc();
        $rol = $row['rol'];
        $nombre_de_usuario = $row['nombres']; // Asignar el nombre de usuario
        $last_name = $row['apellidos']; // Asignar el apellido del usuario
        $imagen_perfil = $row['imagen_perfil'];
        $id_usuario = $row['id'];
        $email = $row['email'];
        $fono = $row['numero_telefonico'];
        $fecha_nacimiento = $row["fecha_nacimiento"];
        $edad = $row["edad"];
        $direccion = $row["direccion"];

        // Iniciar la sesión y almacenar datos del usuario
        session_start();
        $_SESSION['rol'] = $rol;
        $_SESSION['nombres'] = $nombre_de_usuario;
        $_SESSION['id'] = $id_usuario;
        $_SESSION['apellidos'] = $last_name;
        $_SESSION['email'] = $email;
        $_SESSION['numero_telefonico'] = $fono;
        $_SESSION['fecha_nacimiento'] =  $fecha_nacimiento;
        $_SESSION['edad'] =  $edad;
        $_SESSION['direccion'] = $direccion;

        if (!empty($imagen_perfil)) {
            $_SESSION['imagen_perfil'] = $imagen_perfil;
        } else {
            $_SESSION['imagen_perfil'] = "html/assets/images/fotos/default.jpg";
        }

        // Redirigir según el rol del usuario
        switch ($rol) {
            case 'administrador':
                header("Location: http://localhost/prototipo/html/dashboard/auth/administrador.php");
                exit();
            case 'visualizador':
                header("Location: http://localhost/prototipo/html/dashboard/auth/visualizador.php");
                exit();
            case 'ejecutivo':
                header("Location: http://localhost/prototipo/html/dashboard/auth/ejecutivo.php");
                exit();
            case 'general':
                header("Location: http://localhost/prototipo/html/dashboard/auth/general.php");
                exit();
            default:
                echo "<script>alert('Rol de usuario desconocido');</script>";
        }
    } else {
        // Usuario o contraseña incorrectos, mostrar mensaje de error
        echo '<script>alert("Usuario o contraseña incorrectos");</script>';
        echo "<script>setTimeout(function() { window.location.href = 'http://localhost/prototipo/html/dashboard/auth/login.html'; }, 1000);</script>";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>

