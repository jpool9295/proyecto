<?php
$servername = "db";              // 👈 nombre del servicio MySQL en docker-compose.yml
$username = "tienda_user";       // 👈 el usuario que definiste en docker-compose.yml
$password = "tienda123";         // 👈 la contraseña que definiste
$dbname = "mi_data";             // 👈 el nombre real de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
