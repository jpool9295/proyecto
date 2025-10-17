<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(200);
  exit;
}

require_once "conexion.php"; // Usa tu archivo de conexión existente

// Leer el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['nombre']) || empty($data['correo']) || empty($data['mensaje'])) {
  http_response_code(400);
  echo json_encode(["error" => "Faltan datos obligatorios"]);
  exit;
}

try {
  $stmt = $pdo->prepare("INSERT INTO contacto (nombre, correo, mensaje) VALUES (?, ?, ?)");
  $stmt->execute([$data['nombre'], $data['correo'], $data['mensaje']]);
  echo json_encode(["success" => true, "message" => "Mensaje guardado correctamente"]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(["error" => "Error al guardar el mensaje: " . $e->getMessage()]);
}
?>
