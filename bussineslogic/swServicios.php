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

    $directorio = "imagenes/";
    $nombreArchivo = $_FILES['imagen']['name'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];

    $rutaDefinitiva = $directorio . $nombreArchivo;

    if (!file_exists($directorio)) {
        mkdir($directorio, 0777);
    }

    move_uploaded_file($rutaTemporal, $rutaDefinitiva);

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria_id'];
    $precio = $_POST['precio'];
    $imagen = $rutaDefinitiva; // Aquí deberías manejar la lógica de subir y guardar la imagen si es necesario

    $objConexion = new ConexionDB();
    $objServicio = new Servicio($objConexion);

    $objServicio->setNombre($nombre);
    $objServicio->setDescripcion($descripcion);
    $objServicio->setCategoriaId($categoria_id);
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
    $imagen = $data['imagen'];

    $objConexion = new ConexionDB();
    $objServicio = new Servicio($objConexion);

    $objServicio->setId($id);
    $objServicio->setNombre($nombre);
    $objServicio->setDescripcion($descripcion);
    $objServicio->setImagen($imagen);

    $objServicio->editarServicio();
    $response = array('success' => true, 'message' => 'Servicio actualizado correctamente');
    echo json_encode($response);
    exit;
}
?>
