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

// Verificar si se ha enviado el ID del servicio a editar
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $servicio_id = $_GET['id'];

    // Consulta SQL para obtener los detalles del servicio
    $sql = "SELECT id, nombre, descripcion, precio FROM servicios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $servicio_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $servicio = $result->fetch_assoc();
    } else {
        echo "No se encontró el servicio.";
        exit; // Puedes manejar el error de otra forma según tu aplicación
    }
} else {
    echo "ID de servicio no proporcionado.";
    exit; // Puedes manejar el error de otra forma según tu aplicación
}

// Procesamiento del formulario para actualizar el servicio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos actualizados del formulario
    $nombre_servicio = $_POST['nombre_servicio'];
    $descripcion_servicio = $_POST['descripcion_servicio'];
    $precio_servicio = $_POST['precio_servicio'];

    // Preparar la consulta SQL para actualizar el servicio
    $sql_update = "UPDATE servicios SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssdi", $nombre_servicio, $descripcion_servicio, $precio_servicio, $servicio_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo '<script>alert("Servicio actualizado correctamente.");</script>';
        // Redirigir o realizar otras acciones después de la actualización
        // Por ejemplo, puedes redirigir a la página de servicios de la categoría
        header("Location: servicios_categoria.php?id=" . $categoria_id);
    } else {
        echo '<script>alert("Error al actualizar el servicio: ' . $conn->error . '");</script>';
    }

    // Cerrar la consulta preparada
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Servicio</title>
    <!-- Incluir Tailwind CSS desde archivo local -->
    <link href="../css/tailwind.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Editar Servicio
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($servicio['id']); ?>">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="nombre_servicio" class="sr-only">Nombre del Servicio</label>
                        <input id="nombre_servicio" name="nombre_servicio" type="text" value="<?php echo htmlspecialchars($servicio['nombre']); ?>" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Nombre del Servicio">
                    </div>
                    <div>
                        <label for="descripcion_servicio" class="sr-only">Descripción del Servicio</label>
                        <textarea id="descripcion_servicio" name="descripcion_servicio" rows="3" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Descripción del Servicio"><?php echo htmlspecialchars($servicio['descripcion']); ?></textarea>
                    </div>
                    <div>
                        <label for="precio_servicio" class="sr-only">Precio del Servicio</label>
                        <input id="precio_servicio" name="precio_servicio" type="number" step="0.01" value="<?php echo htmlspecialchars($servicio['precio']); ?>" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Precio del Servicio">
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
