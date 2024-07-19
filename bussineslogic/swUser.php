<?php
include ('../dataAccess/dataAccessLogic/User.php');

// Eliminar usuario
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = intval($_GET['id']);
    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);

    $objUser->setId($id);
    $objUser->eliminarUsuario();
    $response = array('success' => true, 'message' => 'Usuario eliminado correctamente');
    echo json_encode($response);
    exit();
}

// Añadir usuario
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);

    //$objUser->setId($id);
    $objUser->setNombre($nombre);
    $objUser->setCorreo($correo);
    $objUser->setPassword($password);
    $objUser->setRol($rol);
    $objUser->registrarUsuario();
    //$response = array('success' => true, 'message' => 'Usuario agregado correctamente');
    //echo json_encode($response);
    exit;
}

// Listar usuarios
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);
    $array = $objUser->listarUsuario();
    echo json_encode($array);
    exit;
}

// Editar usuario
else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = ($data['id']);
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $password = $data['password'];
    $rol = $data['rol'];

    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);

    $objUser->setId($id);
    $objUser->setNombre($nombre);
    $objUser->setCorreo($correo);
    $objUser->setPassword($password);
    $objUser->setRol($rol);
    $objUser->editarUsuario();
    $response = array('success' => true, 'message' => 'Usuario actualizado correctamente');
    echo json_encode($response);
    exit;
}
?>
