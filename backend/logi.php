<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Buscar al usuario por su nombre de usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Comparar contraseña (si usas encriptación, usar password_verify)
        if ($contraseña === $data['contraseña']) {
            // Guardar datos en la sesión
            $_SESSION['usuario_id'] = $data['id'];
            $_SESSION['usuario'] = $data['usuario'];
            $_SESSION['nombre'] = $data['nombre'];
            $_SESSION['apellido'] = $data['apellido'];
            $_SESSION['correo'] = $data['correo'];
            $_SESSION['dni'] = $data['dni'];

            // Redirigir al perfil
            header("Location: perfil.php");
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location='login.html';</script>";
    }
}

$conn->close();
?>
