<?php
include ('../dataAccess/dataAccessLogic/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $usuario_id = $data['usuario_id'];
    $total = $data['total'];
    $detalles = $data['detalles'];

    $objConexion = new ConexionDB();
    $conn = $objConexion->getConexion();

    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO pedido (usuario_id, total) VALUES (?, ?)");
        $stmt->execute([$usuario_id, $total]);
        $pedido_id = $conn->lastInsertId();

        $stmtDetalle = $conn->prepare("INSERT INTO detalle_pedido (pedido_id, servicio_id, cantidad) VALUES (?, ?, ?)");
        foreach ($detalles as $detalle) {
            $stmtDetalle->execute([$pedido_id, $detalle['id'], $detalle['cantidad']]);
        }

        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollBack();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['usuario_id'])) {
    $usuario_id = intval($_GET['usuario_id']);

    $objConexion = new ConexionDB();
    $conn = $objConexion->getConexion();

    $stmt = $conn->prepare("SELECT * FROM pedido WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($pedidos as &$pedido) {
        $stmtDetalle = $conn->prepare("SELECT s.nombre, d.cantidad, s.precio FROM detalle_pedido d INNER JOIN servicios s ON d.servicio_id = s.id WHERE d.pedido_id = ?");
        $stmtDetalle->execute([$pedido['id']]);
        $pedido['detalles'] = $stmtDetalle->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($pedidos);
    exit();
}
?>
