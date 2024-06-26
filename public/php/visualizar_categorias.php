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

// Consulta SQL para obtener categorías
$sql = "SELECT id, nombre, descripcion, fecha_hora FROM categorias";
$result = $conn->query($sql);

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavandería Automatizada - Visualizar Categorías</title>
    <!-- Incluir Tailwind CSS desde archivo local -->
    <link href="../css/tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <img src="../img/fondo1.jfif" class="fixed inset-0 w-screen h-screen object-cover z-0" alt="Background Image">
    <div class="relative bg-gray-100 bg-opacity-0 py-12">
        <div class="container mx-auto py-12">
            <div class="bg-white bg-opacity-50 rounded-lg shadow-lg p-6 mx-auto max-w-3xl">
                <h1 class="text-2xl font-bold mb-6 text-center">Lavandería Automatizada</h1>

                <!-- Grid para mostrar las categorías -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php
                    // Iterar sobre los resultados de la consulta
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <div class="bg-gray-200 rounded-lg p-4 hover:bg-gray-300">
                                <h2 class="text-xl font-bold mb-2">' . htmlspecialchars($row['nombre']) . '</h2>
                                <p class="text-gray-700">' . htmlspecialchars($row['descripcion']) . '</p>
                                <p class="text-gray-500 text-sm">Fecha y hora: ' . htmlspecialchars($row['fecha_hora']) . '</p>
                            </div>
                            ';
                        }
                    } else {
                        echo '<p class="text-center text-gray-700">No hay categorías disponibles.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
