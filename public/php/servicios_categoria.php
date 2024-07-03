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

// Obtener el ID de la categoría de la URL (si se ha pasado)
$categoria_id = isset($_GET['id']) ? $_GET['id'] : null;

// Consulta SQL para obtener los servicios de la categoría seleccionada
if ($categoria_id) {
    $sql = "SELECT id, nombre, descripcion, precio, imagen FROM servicios WHERE categoria_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Consulta SQL para obtener el nombre de la categoría
    $sql_categoria = "SELECT nombre FROM categorias WHERE id = ?";
    $stmt_categoria = $conn->prepare($sql_categoria);
    $stmt_categoria->bind_param("i", $categoria_id);
    $stmt_categoria->execute();
    $result_categoria = $stmt_categoria->get_result();
    $categoria = $result_categoria->fetch_assoc();
}

// Procesamiento del formulario para agregar un nuevo servicio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre_servicio = $_POST['nombre_servicio'];
    $descripcion_servicio = $_POST['descripcion_servicio'];
    $precio_servicio = $_POST['precio_servicio'];

    // Procesar la imagen
    $imagen_servicio = $_FILES['imagen_servicio'];
    $imagen_nombre = $imagen_servicio['name'];
    $imagen_temporal = $imagen_servicio['tmp_name'];
    $imagen_ruta = 'uploads/' . $imagen_nombre; // Ruta donde se almacenará la imagen

    // Mover la imagen a la carpeta de uploads
    move_uploaded_file($imagen_temporal, '../' . $imagen_ruta);

    // Preparar la consulta SQL para insertar el servicio
    $sql_insert = "INSERT INTO servicios (nombre, descripcion, precio, categoria_id, imagen) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ssdis", $nombre_servicio, $descripcion_servicio, $precio_servicio, $categoria_id, $imagen_ruta);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo '<script>alert("Servicio agregado correctamente.");</script>';
        // Redirigir o realizar otras acciones después de la inserción
        // Por ejemplo, puedes redirigir a la misma página para actualizar la lista de servicios
        header("Location: servicios_categoria.php?id=" . $categoria_id);
    } else {
        echo '<script>alert("Error al agregar el servicio: ' . $conn->error . '");</script>';
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
    <title>Servicios de <?php echo isset($categoria['nombre']) ? htmlspecialchars($categoria['nombre']) : ''; ?></title>
    <!-- Incluir Tailwind CSS desde archivo local -->
    <link href="../css/tailwind.css" rel="stylesheet">

    <style>
        .hidden {
            display: none;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            text-align: center;
            position: relative;
            border-radius: 8px;
        }

        .modal-buttons {
            margin-top: 10px;
        }

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

    <div class="container mx-auto py-12">
        <div class="bg-white bg-opacity-100 rounded-lg shadow-lg p-6 mx-auto max-w-3xl">
            <a href="visualizar_categorias.php" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 mx-2">Volver a Categorías</a>
            <h1 class="text-2xl font-bold mb-6 text-center">Servicios de <?php echo isset($categoria['nombre']) ? htmlspecialchars($categoria['nombre']) : ''; ?></h1>

            <!-- Grid para mostrar los servicios -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                // Iterar sobre los resultados de la consulta si existen
                if (isset($result) && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <div class="bg-gray-200 rounded-lg p-4 hover:bg-gray-300 relative">
                            <h2 class="text-xl font-bold mb-2">' . htmlspecialchars($row['nombre']) . '</h2>
                            <p class="text-gray-700">' . htmlspecialchars($row['descripcion']) . '</p>
                            <p class="text-gray-700 font-bold">Precio: $' . htmlspecialchars($row['precio']) . '</p>
                            <img src="' . htmlspecialchars($row['imagen']) . '" class="my-2 mx-auto max-w-xs" alt="Imagen del servicio">
                            <div class="flex justify-between mt-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm" onclick="editService(' . $row['id'] . ')">Modificar</button>
<button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded text-sm" onclick="openModal(' . $row['id'] . ')">Eliminar</button>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '<p class="text-center text-gray-700">No hay servicios disponibles.</p>';
                }
                ?>
            </div>

            <!-- Botón para agregar un nuevo servicio -->
            <button id="toggleForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Agregar Servicio</button>

            <!-- Formulario para agregar un nuevo servicio (inicialmente oculto) -->
            <div id="formContainer" class="mt-4 hidden">
                <h2 class="text-xl font-bold mb-4">Agregar Nuevo Servicio</h2>
                <form action="" method="POST" class="bg-gray-200 p-4 rounded-lg" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                    <div class="mb-4">
                        <label for="nombre_servicio" class="block text-gray-700 font-bold mb-2">Nombre del Servicio:</label>
                        <input type="text" id="nombre_servicio" name="nombre_servicio" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion_servicio" class="block text-gray-700 font-bold mb-2">Descripción del Servicio:</label>
                        <textarea id="descripcion_servicio" name="descripcion_servicio" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="precio_servicio" class="block text-gray-700 font-bold mb-2">Precio del Servicio:</label>
                        <input type="number" id="precio_servicio" name="precio_servicio" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01" required>
                    </div>
                    <div class="mb-4">
                        <label for="imagen_servicio" class="block text-gray-700 font-bold mb-2">Imagen del Servicio:</label>
                        <input type="file" id="imagen_servicio" name="imagen_servicio" accept="image/*" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Servicio</button>
                </form>
            </div>

            <!-- Modal para confirmar eliminación -->
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <h2 class="text-xl font-bold mb-4">¿Estás seguro de eliminar este servicio?</h2>
                    <div class="modal-buttons">
                    <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded text-sm" id="deleteBtn">Eliminar</button>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded text-sm" onclick="closeModal()">Cancelar</button>
                    </div>
                </div>
            </div>

            <script>
                // Función para mostrar u ocultar el formulario de agregar servicio
                document.getElementById('toggleForm').addEventListener('click', function () {
                    document.getElementById('formContainer').classList.toggle('hidden');
                });

                // Función para abrir el modal de eliminación
                function openModal(serviceId) {
                    var modal = document.getElementById('deleteModal');
                    modal.style.display = 'block';

                    // Botón para eliminar con confirmación
                    var deleteBtn = document.getElementById('deleteBtn');
                    deleteBtn.onclick = function () {
                        // Redireccionar a la página de eliminación (aquí deberías implementar la lógica de eliminación en PHP)
                        window.location.href = 'eliminar_servicio.php?id=' + serviceId;
                    };
                }

                // Función para cerrar el modal
                function closeModal() {
                    var modal = document.getElementById('deleteModal');
                    modal.style.display = 'none';
                }

                // Función para editar un servicio (debes implementar esta función)
                function editService(serviceId) {
                    // Redireccionar a la página de edición con el ID del servicio
                    window.location.href = 'editar_servicio.php?id=' + serviceId;
                }

                // Validaciones de formulario
                function validarFormulario() {
                    // Obtener referencias a los campos del formulario
                    var nombreServicio = document.getElementById('nombre_servicio');
                    var descripcionServicio = document.getElementById('descripcion_servicio');
                    var precioServicio = document.getElementById('precio_servicio');
                    var imagenServicio = document.getElementById('imagen_servicio');

                    // Expresión regular para validar que no haya símbolos
                    var regexSinSimbolos = /^[a-zA-Z0-9\s]+$/;

                    // Validar nombre del servicio
                    if (nombreServicio.value.trim() === '') {
                        alert('Por favor, ingrese el nombre del servicio.');
                        return false;
                    }
                    if (!regexSinSimbolos.test(nombreServicio.value)) {
                        alert('El nombre del servicio no debe contener símbolos.');
                        return false;
                    }

                    // Validar descripción del servicio
                    if (descripcionServicio.value.trim() === '') {
                        alert('Por favor, ingrese la descripción del servicio.');
                        return false;
                    }
                    if (!regexSinSimbolos.test(descripcionServicio.value)) {
                        alert('La descripción del servicio no debe contener símbolos.');
                        return false;
                    }

                    // Validar precio del servicio
                    if (precioServicio.value.trim() === '') {
                        alert('Por favor, ingrese el precio del servicio.');
                        return false;
                    }

                    // Validar que el precio sea un número válido
                    var precio = parseFloat(precioServicio.value);
                    if (isNaN(precio) || precio <= 0) {
                        alert('Por favor, ingrese un precio válido.');
                        return false;
                    }

                    // Validar que se haya seleccionado una imagen
                    if (imagenServicio.files.length === 0) {
                        alert('Por favor, seleccione una imagen para el servicio.');
                        return false;
                    }

                    // Si todas las validaciones pasan, permitir el envío del formulario
                    return true;
                }
            </script>
        </div>
    </div>
</body>

</html>
