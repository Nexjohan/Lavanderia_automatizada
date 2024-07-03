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

// Verificar si se ha pasado un ID de servicio por GET
if (isset($_GET['id'])) {
    $servicio_id = $_GET['id'];

    // Consulta SQL para obtener los datos del servicio
    $sql = "SELECT id, nombre, descripcion, precio, imagen FROM servicios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $servicio_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Obtener los datos del servicio
        $servicio = $result->fetch_assoc();
    } else {
        // Si no se encuentra el servicio, puedes redirigir o manejar el error de alguna otra manera
        echo "Servicio no encontrado.";
        exit;
    }

    // Consulta SQL para obtener el ID de la categoría del servicio
    $sql_categoria = "SELECT categoria_id FROM servicios WHERE id = ?";
    $stmt_categoria = $conn->prepare($sql_categoria);
    $stmt_categoria->bind_param("i", $servicio_id);
    $stmt_categoria->execute();
    $result_categoria = $stmt_categoria->get_result();
    $categoria = $result_categoria->fetch_assoc();
    $categoria_id = $categoria['categoria_id'];
} else {
    echo "ID de servicio no especificado.";
    exit;
}

// Cerrar conexión (si es necesario)
$stmt->close();
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
    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>

        .bg-celeste-pastel {
            background-color: #a0d6e4;
        }
    </style>
</head>

<body class="bg-celeste-pastel">
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="../index.html" class="text-xl font-bold hover:text-gray-200">Menú Principal</a>
            <nav class="space-x-4">
                <a href="#enlace1" class="hover:text-gray-200">Enlace 1</a>
                <a href="#enlace2" class="hover:text-gray-200">Enlace 2</a>
            </nav>
        </div>
    </header>
<body class="bg-celeste-pastel">
    <div class="container mx-auto py-12">
        <div class="bg-white bg-opacity-100 rounded-lg shadow-lg p-6 mx-auto max-w-3xl">
            <h1 class="text-2xl font-bold mb-6 text-center">Editar Servicio</h1>
            
            <!-- Formulario para editar el servicio -->
            <form action="actualizar_servicio.php" method="POST" class="bg-gray-200 p-4 rounded-lg" enctype="multipart/form-data">
                <input type="hidden" name="servicio_id" value="<?php echo $servicio['id']; ?>">
                <input type="hidden" name="categoria_id" value="<?php echo $categoria_id; ?>">
                <div class="mb-4">
                    <label for="nombre_servicio" class="block text-gray-700 font-bold mb-2">Nombre del Servicio:</label>
                    <input type="text" id="nombre_servicio" name="nombre_servicio" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo htmlspecialchars($servicio['nombre']); ?>" required>
                </div>
                <div class="mb-4">
                    <label for="descripcion_servicio" class="block text-gray-700 font-bold mb-2">Descripción del Servicio:</label>
                    <textarea id="descripcion_servicio" name="descripcion_servicio" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required><?php echo htmlspecialchars($servicio['descripcion']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="precio_servicio" class="block text-gray-700 font-bold mb-2">Precio del Servicio:</label>
                    <input type="number" id="precio_servicio" name="precio_servicio" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01" value="<?php echo $servicio['precio']; ?>" required>
                </div>
                <div class="mb-4">
                    <label for="imagen_servicio" class="block text-gray-700 font-bold mb-2">Imagen del Servicio:</label>
                    <input type="file" id="imagen_servicio" name="imagen_servicio" accept="image/*" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Selecciona una imagen solo si deseas cambiarla.</p>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Cambios</button>
                <a href="servicios_categoria.php?id=<?php echo $categoria_id; ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>