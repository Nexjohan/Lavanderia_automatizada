<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    // Validación básica
    if (empty($nombre) || empty($correo) || empty($password) || empty($rol)) {
        // Manejar error de datos faltantes
        echo "Error: Todos los campos son obligatorios.";
        exit;
    }

    // Ejemplo de validación de correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Error: El correo electrónico no es válido.";
        exit;
    }

    // Ejemplo de inserción en la base de datos
    $sql = "INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $correo, $password, $rol);

    if ($stmt->execute()) {
        // Registro exitoso, mostrar mensaje de confirmación
        $_SESSION['registro_exitoso'] = true;
        header("Location: ../index.html"); // Redirigir al menú principal u otra página deseada
        exit;
    } else {
        // Error en la ejecución de la consulta SQL
        echo "Error al registrar el usuario: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
