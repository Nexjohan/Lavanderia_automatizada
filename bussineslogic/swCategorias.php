<?php
include ('../dataAccess/dataAccessLogic/Categoria.php');

// Eliminar categoría
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = intval($_GET['id']);
    $objConexion = new ConexionDB();
    $objCategoria = new Categoria($objConexion);

    $objCategoria->setId($id);
    $objCategoria->eliminarCategoria();
    $response = array('success' => true, 'message' => 'Categoría eliminada correctamente');
    echo json_encode($response);
    exit();
}

// Añadir categoría
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $directorio="imagenes/";
    $nombreArchivo=$_FILES['imagen']['name'];
    $rutaTemporal=$_FILES['imagen']['tmp_name'];

    $rutaDefinitiva=$directorio.$nombreArchivo;

   

    if(!file_exists($directorio)){
        mkdir($directorio,0777);
    }

    move_uploaded_file($rutaTemporal,$rutaDefinitiva);



    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen = $rutaDefinitiva; // Aquí deberías manejar la lógica de subir y guardar la imagen si es necesario


    $objConexion = new ConexionDB();
    $objCategoria = new Categoria($objConexion);

    $objCategoria->setNombre($nombre);
    $objCategoria->setDescripcion($descripcion);
    $objCategoria->setImagen($imagen);
    $objCategoria->registrarCategoria();
    $response = array('success' => true, 'message' => 'Categoría agregada correctamente');
    echo json_encode($response);
    exit;
}

// Listar categorías
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $objConexion = new ConexionDB();
    $objCategoria = new Categoria($objConexion);
    $array = $objCategoria->listarCategoria();
    echo json_encode($array);
    exit;
}

// Editar categoría
else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id']);
    $nombre = $data['nombre'];
    $descripcion = $data['descripcion'];
    $imagen = $data['imagen'];


    $objConexion = new ConexionDB();
    $objCategoria = new Categoria($objConexion);

    $objCategoria->setId($id);
    $objCategoria->setNombre($nombre);
    $objCategoria->setDescripcion($descripcion);
    $objCategoria->setImagen($imagen);

    $objCategoria->editarCategoria();
    $response = array('success' => true, 'message' => 'Categoría actualizada correctamente');
    echo json_encode($response);
    exit;
}
?>
