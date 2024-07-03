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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Obtener la categoría actual
    $sql = "SELECT nombre, descripcion FROM categorias WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nombre, $descripcion);
    $stmt->fetch();
    $stmt->close();

    // Mostrar el formulario para modificar la categoría
    if (isset($nombre) && isset($descripcion)) {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modificar Categoría</title>
            <link href="../css/tailwind.css" rel="stylesheet">
            <style>
                /* Clase personalizada para el color celeste pastel */
                .bg-celeste-pastel {
                    background-color: #a0d6e4;
                }
            </style>
        </head>
        <body class="bg-celeste-pastel">
            <!-- Header con enlaces -->
            <header class="bg-blue-600 text-white py-4">
                <div class="container mx-auto flex justify-between items-center">
                    <a href="../index.html" class="text-xl font-bold hover:text-gray-200">Menú Principal</a>
                    <nav class="space-x-4">
                        <a href="#enlace1" class="hover:text-gray-200">Enlace 1</a>
                        <a href="#enlace2" class="hover:text-gray-200">Enlace 2</a>
                    </nav>
                </div>
            </header>
            <div class="container mx-auto py-12">
                <div class="bg-white rounded-lg shadow-lg p-6 mx-auto max-w-3xl">
                    <h1 class="text-2xl font-bold mb-6 text-center">Modificar Categoría</h1>
                    <form action="actualizar_categoria.php" method="POST">
                        <input type="hidden" name="id" value="' . htmlspecialchars($id) . '">
                        <div class="mb-4">
                            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                            <input type="text" name="nombre" value="' . htmlspecialchars($nombre) . '" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Descripción:</label>
                            <textarea name="descripcion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>' . htmlspecialchars($descripcion) . '</textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
                    </form>
                </div>
            </div>
            <script>
                // Función para mostrar el modal de éxito y redirigir después de 2 segundos
                function showSuccessModal() {
                    alert("Categoría actualizada con éxito");
                    setTimeout(function() {
                        window.location.href = "visualizar_categoria.php";
                    }, 2000);
                }

                // Verificar si se debe mostrar el modal de éxito
                if (window.location.search.includes("success=true")) {
                    showSuccessModal();
                }
            </script>
        </body>
        </html>
        ';
    }
}

$conn->close();
?>
