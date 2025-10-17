<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Conexión a MySQL (ajusta credenciales según tu docker-compose)
$pdo = new PDO("mysql:host=db;dbname=mi_data;charset=utf8", "tienda_user", "tienda123");

$input = json_decode(file_get_contents("php://input"), true);
if (!$input || empty($input['carrito']) || empty($input['total'])) {
    echo json_encode(["error" => "Datos inválidos"]);
    exit;
}

$carrito = $input['carrito'];
$total = $input['total'];

try {
    $pdo->beginTransaction();

    // Simulación: sin login todavía
    $id_usuario = null;

    // Insertar pedido
    $stmt = $pdo->prepare("INSERT INTO pedidos (id_usuario, total) VALUES (?, ?)");
    $stmt->execute([$id_usuario, $total]);
    $id_pedido = $pdo->lastInsertId();

$stmtItem = $pdo->prepare("INSERT INTO pedido_items (id_pedido, nombre_producto, cantidad, precio)
                           VALUES (?, ?, ?, ?)");

foreach ($carrito as $item) {
    $stmtItem->execute([
        $id_pedido,
        $item['nombre'],   // nombre del producto que viene del carrito JS
        $item['cantidad'],
        $item['precio']
    ]);
}

    $pdo->commit();
    echo json_encode(["success" => true, "message" => "Compra guardada correctamente"]);

} catch (Exception $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>