<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?php echo $_SESSION['usuario']; ?></title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']; ?> 👋</h1>
    <p><b>Usuario:</b> <?php echo $_SESSION['usuario']; ?></p>
    <p><b>Correo:</b> <?php echo $_SESSION['correo']; ?></p>
    <p><b>DNI:</b> <?php echo $_SESSION['dni']; ?></p>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
