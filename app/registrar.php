<?php
// Configuración de la base de datos
$servidor = "localhost";
$usuario_db = "root";
$contraseña_db = "";
$nombre_db = "usuarios";

// Conexión a la base de datos
$conexion = new mysqli($servidor, $usuario_db, $contraseña_db, 
$nombre_db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contraseña = $_POST["contra"];

    // Validar datos (aquí puedes agregar más validaciones según tus 
requerimientos)

    if (empty($nombre) || empty($correo) || empty($contra)) {
        $mensaje_error = "Todos los campos son obligatorios.";
    } else {
        // Insertar usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, contraseña) 
VALUES ('$nombre', '$correo', '$contraseña')";

        if ($conexion->query($sql) === TRUE) {
            $mensaje_exito = "Usuario registrado con éxito. Ahora 
puedes iniciar sesión.";
        } else {
            $mensaje_error = "Error al registrar el usuario: " . 
$conexion->error;
        }
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="post" action="">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        <label>Correo Electrónico:</label>
        <input type="email" name="correo" required><br><br>
        <label>Contraseña:</label>
        <input type="password" name="contra" required><br><br>
        <input type="submit" value="Registrar">
    </form>
    <?php if (isset($mensaje_exito)) { echo $mensaje_exito; } ?>
    <?php if (isset($mensaje_error)) { echo $mensaje_error; } ?>
</body>
</html>
