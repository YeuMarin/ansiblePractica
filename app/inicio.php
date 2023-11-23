<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php"); // Redirige a la página de inicio de sesión si el usuario no está autenticado
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página de Inicio</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION["nombre"]; ?>!</h2>
    <p>Esta es tu página de inicio.</p>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
</body>
</html>
