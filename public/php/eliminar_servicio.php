<?php
// Conexión a la base de datos (reutiliza tu código de conexión)
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
// Verificar si se ha pasado el ID del servicio por GET
if (isset($_GET['id'])) {
    $servicio_id = $_GET['id'];

    // Consultar la categoría del servicio que se va a eliminar
    $sql_categoria = "SELECT categoria_id FROM servicios WHERE id = ?";
    $stmt_categoria = $conn->prepare($sql_categoria);
    $stmt_categoria->bind_param("i", $servicio_id);
    $stmt_categoria->execute();
    $result_categoria = $stmt_categoria->get_result();

    if ($result_categoria->num_rows > 0) {
        $row = $result_categoria->fetch_assoc();
        $categoria_id = $row['categoria_id'];

        // Preparar la consulta SQL para eliminar el servicio
        $sql_delete = "DELETE FROM servicios WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $servicio_id);

        // Ejecutar la consulta
        if ($stmt_delete->execute()) {
            // Redirigir a la página de visualización de servicios con el ID de categoría
            header("Location: servicios_categoria.php?id=" . urlencode($categoria_id));
            exit(); // Asegurar que el script se detenga después de la redirección
        } else {
            // Mostrar mensaje de error en caso de fallo
            echo '<script>
                    alert("Hubo un error al eliminar el servicio.");
                    window.location.href = "servicios_categoria.php?id=' . urlencode($categoria_id) . '";
                  </script>';
        }

        // Cerrar la consulta preparada de eliminación
        $stmt_delete->close();
    } else {
        // Manejar el caso donde no se encuentra la categoría del servicio
        echo '<script>
                alert("No se encontró la categoría del servicio.");
                window.location.href = "visualizar_categorias.php"; // Redirigir a una página adecuada
              </script>';
    }

    // Cerrar consulta preparada de categoría
    $stmt_categoria->close();
}

// Cerrar conexión (si es necesario)
$conn->close();
?>
