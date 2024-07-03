<?php
// Conexión a la base de datos
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "lavanderia_automatizada";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado el ID del servicio a eliminar
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $servicio_id = $_GET['id'];

    // Consulta SQL para eliminar el servicio
    $sql_delete = "DELETE FROM servicios WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $servicio_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo '<script>alert("Servicio eliminado correctamente.");</script>';
        // Redirigir o realizar otras acciones después de la eliminación
        // Por ejemplo, puedes redirigir a la página de servicios de la categoría
        header("Location: servicios_categoria.php?id=" . $categoria_id);
    } else {
        echo '<script>alert("Error al eliminar el servicio: ' . $conn->error . '");</script>';
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>
