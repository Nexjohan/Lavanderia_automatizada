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

// Procesamiento para eliminar la categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Eliminar los servicios asociados a la categoría
        $delete_servicios_sql = "DELETE FROM servicios WHERE categoria_id=?";
        $delete_servicios_stmt = $conn->prepare($delete_servicios_sql);
        $delete_servicios_stmt->bind_param("i", $id);
        
        if ($delete_servicios_stmt->execute()) {
            // Luego de eliminar los servicios, eliminar la categoría
            $delete_categoria_sql = "DELETE FROM categorias WHERE id=?";
            $delete_categoria_stmt = $conn->prepare($delete_categoria_sql);
            $delete_categoria_stmt->bind_param("i", $id);
            
            if ($delete_categoria_stmt->execute()) {
                echo "<script>
                    alert('Categoría eliminada exitosamente.');
                    window.location.href = 'visualizar_categorias.php';
                </script>";
            } else {
                echo "Error al eliminar la categoría: " . $conn->error;
            }
            $delete_categoria_stmt->close();
        } else {
            echo "Error al eliminar los servicios: " . $conn->error;
        }

        $delete_servicios_stmt->close();
    } else {
        echo "ID de categoría no proporcionado.";
    }
}

// Cerrar conexión
$conn->close();
?>
