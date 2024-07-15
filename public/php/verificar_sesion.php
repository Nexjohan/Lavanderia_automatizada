<?php
// Verificar si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Conectar a la base de datos y realizar la consulta para verificar el usuario
    $servername = "localhost:3307";
    $username = "root";
    $password_db = "";
    $dbname = "lavanderia_automatizada";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado, redirigir según el rol
        $usuario = $result->fetch_assoc();
        $rol = $usuario['rol'];

        if ($rol == 'admin') {
            header('Location: ../index.html');
            exit;
        } elseif ($rol == 'user') {
            header('Location: pagina_usuario.php');
            exit;
        }
    } else {
        // Usuario no encontrado, redirigir de vuelta a login.php con un parámetro de error
        header('Location: login.php?error=1');
        exit;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
