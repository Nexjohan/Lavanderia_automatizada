<?php
include 'conexion.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$codigo_admin = isset($_POST['codigo_admin']) ? $_POST['codigo_admin'] : '';
$rol = $_POST['rol'];

// Verificar si el correo ya existe
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: registro_de_usuarios.php?error=correo_duplicado");
    exit();
} else {
    // Asignar rol de admin si el código es correcto
    if ($rol === 'admin' && $codigo_admin !== "Nexar") {
        echo "Código de administrador incorrecto.";
    } else {
        // Insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, correo, password, rol) VALUES ('$nombre', '$correo', '$password', '$rol')";

        if ($conn->query($sql) === TRUE) {
            header("Location: registro_de_usuarios.php?registro=exitoso");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>