<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Categoría CRUD</title>
    <link href="../css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md mb-8 relative">
        <h2 class="text-2xl font-bold mb-6 text-center">Lavanderia Automatizada Categorías</h2>
        
        <form action="guardar_categoria.php" method="POST" enctype="multipart/form-data" id="categoriaForm" class="space-y-4">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
                <input type="text" id="nombre" name="nombre" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <p id="nombreError" class="text-red-600 text-sm mt-1"></p>
            </div>
            
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea id="descripcion" name="descripcion" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                <p id="descripcionError" class="text-red-600 text-sm mt-1"></p>
            </div>

            <div>
                <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <p id="imagenError" class="text-red-600 text-sm mt-1"></p>
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Guardar</button>
                <a href="../index.html" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 mx-2">Menú Principal</a>
            </div>
        </form>
        
        <div id="message" class="mt-4 text-center"></div>
    </div>

    <script>
        document.getElementById('categoriaForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const nombre = document.getElementById('nombre').value;
            const descripcion = document.getElementById('descripcion').value;
            const imagen = document.getElementById('imagen').files[0];

            let isValid = true;

            if (nombre.length < 3) {
                document.getElementById('nombreError').textContent = 'El nombre debe tener al menos 3 caracteres.';
                isValid = false;
            } else {
                document.getElementById('nombreError').textContent = '';
            }

            if (descripcion.length < 10) {
                document.getElementById('descripcionError').textContent = 'La descripción debe tener al menos 10 caracteres.';
                isValid = false;
            } else {
                document.getElementById('descripcionError').textContent = '';
            }

            if (imagen && !['image/jpeg', 'image/png', 'image/gif'].includes(imagen.type)) {
                document.getElementById('imagenError').textContent = 'La imagen debe ser un archivo JPEG, PNG o GIF.';
                isValid = false;
            } else {
                document.getElementById('imagenError').textContent = '';
            }

            if (!isValid) {
                return;
            }

            const formData = new FormData(this);
            fetch('guardar_categoria.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').textContent = data;
                if (data.includes('exitosamente')) {
                    document.getElementById('message').classList.add('text-green-600');
                    document.getElementById('categoriaForm').reset();
                } else {
                    document.getElementById('message').classList.add('text-red-600');
                }
            })
            .catch(error => {
                document.getElementById('message').textContent = 'Error al guardar la categoría.';
                document.getElementById('message').classList.add('text-red-600');
            });
        });
    </script>
</body>
</html>
