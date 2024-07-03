<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavandería Automatizada - Visualizar Categorías</title>
    <link href="../css/tailwind.css" rel="stylesheet">
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

    <div class="relative bg-gray-100 bg-opacity-0 py-12">
        <div class="container mx-auto py-12">
            <div class="bg-white rounded-lg shadow-lg p-6 mx-auto max-w-3xl">
                <div class="bg-blue-500 p-4 rounded-lg mb-6">
                    <h1 class="text-2xl font-bold text-center">Lavandería Automatizada</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
                    $sql = "SELECT id, nombre, descripcion, imagen FROM categorias";
                    $result = $conn->query($sql);

                    // Iterar sobre los resultados de la consulta
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <div class="bg-gray-200 rounded-lg p-4 hover:bg-gray-300">
                                <a href="servicios_categoria.php?id=' . htmlspecialchars($row['id']) . '" class="text-xl font-bold mb-2 block">' . htmlspecialchars($row['nombre']) . '</a>
                                <img src="' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre']) . '" class="w-full h-48 object-cover rounded-md mb-2">
                                <p class="text-gray-700">' . htmlspecialchars($row['descripcion']) . '</p>
                                
                                <!-- Botones Modificar y Eliminar -->
                                <div class="flex justify-between mt-2">
                                    <form action="modificar_categoria.php" method="POST">
                                        <input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Modificar</button>
                                    </form>
                                    <form action="eliminar_categoria.php" method="POST" onsubmit="return confirmDeletion(event, ' . htmlspecialchars($row['id']) . ');">
                                        <input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">
                                        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-3 rounded">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                            ';
                        }
                    } else {
                        echo '<p class="text-center text-gray-700">No hay categorías disponibles.</p>';
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="bg-blue-600 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Lavandería Automatizada. Todos los derechos reservados.</p>
            <nav class="space-x-4 mt-2">
                <a href="#privacy" class="hover:text-gray-200">Política de Privacidad</a>
                <a href="#terms" class="hover:text-gray-200">Términos y Condiciones</a>
                <a href="#contact" class="hover:text-gray-200">Contacto</a>
            </nav>
        </div>
    </footer>

    <script>
        function confirmDeletion(event, id) {
            event.preventDefault();
            if (confirm("¿Desea eliminar esta categoría?")) {
                const form = event.target;
                form.submit();
            }
        }
    </script>
</body>
</html>
