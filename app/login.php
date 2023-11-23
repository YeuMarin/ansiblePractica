<?php
// Configuración de la base de datos
$servidor = "localhost";
$usuario_db = "root";
$contra_db = "";
$nombre_db = "usuarios";

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuario_db, $contra_db, 
$nombre_db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contraseña = $_POST["contra"];

    $sql = "SELECT id, nombre FROM usuarios WHERE correo = '$correo' 
AND contraseña = '$contra'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();
        session_start();
        $_SESSION["id"] = $fila["id"];
        $_SESSION["nombre"] = $fila["nombre"];
        header("Location: inicio.php"); // Redirige a la página de 
inicio
    } else {
        $mensaje_error = "Credenciales incorrectas. Inténtalo de 
nuevo.";
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="">
        <label>Correo Electrónico:</label>
        <input type="text" name="correo" required><br><br>
        <label>Contraseña:</label>
        <input type="password" name="contra" required><br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <a href="registrar.php">Registrate</a>
    <?php if (isset($mensaje_error)) { echo $mensaje_error; } ?>
</body>
</html>
