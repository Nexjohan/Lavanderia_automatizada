<?php
include ('../dataAccess/dataAccessLogic/Servicio.php');

// Eliminar servicio
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = intval($_GET['id']);
    $objConexion = new ConexionDB();
    $objServicio = new Servicio($objConexion);

    $objServicio->setId($id);
    $objServicio->eliminarServicio();
    $response = array('success' => true, 'message' => 'Servicio eliminado correctamente');
    echo json_encode($response);
    exit();
}

// Añadir servicio
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria_id'];
    $fecha_hora = $_POST['fecha_hora'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];

    $objConexion = new ConexionDB();
    $objServicio = new Servicio($objConexion);

    $objServicio->setId($id);
    $objServicio->setNombre($nombre);
    $objServicio->setDescripcion($descripcion);
    $objServicio->setCategoriaId($categoria_id);
    $objServicio->setFechaHora($fecha_hora);
    $objServicio->setPrecio($precio);
    $objServicio->setImagen($imagen);
    $objServicio->registrarServicio();
    $response = array('success' => true, 'message' => 'Servicio agregado correctamente');
    echo json_encode($response);
    exit;
}

// Listar servicios
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $objConexion = new ConexionDB();
    $objServicio = new Servicio($objConexion);
    $array = $objServicio->listarServicio();
    echo json_encode($array);
    exit;
}

// Editar servicio
else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id']);
    $nombre = $data['nombre'];
    $descripcion = $data['descripcion'];
    $categoria_id = $data['categoria_id'];
    $fecha_hora = $data['fecha_hora'];
    $precio = $data['precio'];
    $imagen = $data['imagen'];

    $objConexion = new ConexionDB();
    $objServicio = new Servicio($objConexion);

    $objServicio->setId($id);
    $objServicio->setNombre($nombre);
    $objServicio->setDescripcion($descripcion);
    $objServicio->setCategoriaId($categoria_id);
    $objServicio->setFechaHora($fecha_hora);
    $objServicio->setPrecio($precio);
    $objServicio->setImagen($imagen);
    $objServicio->editarServicio();
    $response = array('success' => true, 'message' => 'Servicio actualizado correctamente');
    echo json_encode($response);
    exit;
}
?>
