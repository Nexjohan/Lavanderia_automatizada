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
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $servicio_id = $_POST['servicio_id'];
    $categoria_id = $_POST['categoria_id'];
    $nombre_servicio = $_POST['nombre_servicio'];
    $descripcion_servicio = $_POST['descripcion_servicio'];
    $precio_servicio = $_POST['precio_servicio'];

    // Procesar la imagen si se ha proporcionado
    if (!empty($_FILES['imagen_servicio']['name'])) {
        $imagen_servicio = $_FILES['imagen_servicio'];
        $imagen_nombre = $imagen_servicio['name'];
        $imagen_temporal = $imagen_servicio['tmp_name'];
        $imagen_ruta = 'uploads/' . $imagen_nombre; // Ruta donde se almacenará la imagen
        move_uploaded_file($imagen_temporal, '../' . $imagen_ruta);
    } else {
        // Si no se proporciona una nueva imagen, mantener la imagen existente en la base de datos
        // Recuperar la ruta de imagen actual desde la base de datos (no implementado aquí, asume que ya está en la base de datos)
        $imagen_ruta = ''; // Asignar la ruta actual de la imagen
    }

    // Preparar la consulta SQL para actualizar el servicio
    $sql_update = "UPDATE servicios SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssdsi", $nombre_servicio, $descripcion_servicio, $precio_servicio, $imagen_ruta, $servicio_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a la página de visualización de servicios con el ID de categoría
        header("Location: servicios_categoria.php?id=" . urlencode($categoria_id));
        exit(); // Asegurar que el script se detenga después de la redirección
    } else {
        // Mostrar mensaje de error en caso de fallo
        echo '<script>
                alert("Hubo un error al actualizar el servicio.");
                window.location.href = "servicios_categoria.php?id=' . urlencode($categoria_id) . '";
              </script>';
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

// Cerrar conexión (si es necesario)
$conn->close();
?>