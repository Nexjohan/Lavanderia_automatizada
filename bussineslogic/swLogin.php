<?php
include ('../dataAccess/dataAccesslogic/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['correo']) && isset($_POST['password'])) {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);

    $user = $objUser->login($correo, $password);
    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        $response = array('success' => true, 'user' => $user);
    } else {
        $response = array('success' => false, 'message' => 'Credenciales incorrectas');
    }
    echo json_encode($response);
    exit;
}

?>
