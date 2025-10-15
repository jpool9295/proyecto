<?php
$servername = "localhost";
$username = "root";
$password = ""; // o la contraseña que tengas en tu phpMyAdmin
$dbname = "tienda";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$ubicacion = $_POST['ubicacion'];
$dni = $_POST['dni'];
$metodo_pago = $_POST['metodo_pago'];

// Insertar en la base de datos
$sql = "INSERT INTO pedidos (nombre, telefono, ubicacion, dni, metodo_pago)
        VALUES ('$nombre', '$telefono', '$ubicacion', '$dni', '$metodo_pago')";

if ($conn->query($sql) === TRUE) {
  echo "✅ Pedido guardado correctamente.";
} else {
  echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
