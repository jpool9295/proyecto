<?php
// 🔓 Permitir CORS (comunicación entre puertos)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Manejar preflight OPTIONS (necesario para Chrome)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$servername = "db";
$username = "tienda_user";
$password = "tienda123";
$dbname = "mi_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Error de conexión con la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Capturar variables del formulario
  $nombre = $_POST['nombre'] ?? '';
  $apellido = $_POST['apellido'] ?? '';
  $correo = $_POST['correo'] ?? '';
  $usuario = $_POST['usuario'] ?? '';
  $password = $_POST['password'] ?? '';
  $dni = $_POST['dni'] ?? '';

  // Validar que no estén vacíos
  if (empty($nombre) || empty($apellido) || empty($correo) || empty($usuario) || empty($password)) {
    echo "❌ Error: Todos los campos son obligatorios.";
    exit;
  }

  // Encriptar la contraseña
  $hash = password_hash($password, PASSWORD_DEFAULT);

  // Preparar consulta segura
  $sql = "INSERT INTO usuarios (nombre, apellido, correo, usuario, password, dni) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
    echo "❌ Error al preparar la consulta: " . $conn->error;
    exit;
  }

  $stmt->bind_param("ssssss", $nombre, $apellido, $correo, $usuario, $hash, $dni);

  if ($stmt->execute()) {
    echo "✅ Usuario registrado correctamente.";
  } else {
    // Mensaje más claro según el error SQL
    if ($conn->errno === 1062) {
      echo "⚠️ Ya existe un usuario o correo registrado con esos datos.";
    } else {
      echo "❌ Error al registrar: " . $stmt->error;
    }
  }

  $stmt->close();
}

$conn->close();
?>
